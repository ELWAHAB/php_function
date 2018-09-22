<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */

class Reader{

    public $update_array;

    public function add_file($patch = ""){
             fopen($patch, 'w');
    } //todo

    public function add_dir($patch = ""){
        mkdir($patch, 0755);
   }

    public function del_file($patch = ""){
         unlink($patch);
    }

    public function del_dir($patch = ""){
        $dirs = scandir($patch);
        foreach ($dirs as $dir) {
            if($dir != "." & $dir != "..") {
                $this->del_file($dir);
            }

        }
        rmdir($patch);
    }

    public function del_item( $id = 0){
        $sql = "DELETE  FROM scan WHERE id = '$id' ";
        DB::query($sql) or die("Проблемы Хьюстон");

    }

    public function add_item($array = array()){
        $hash      = $array['hash'];
        $patch     = $array['patch'];
        $type      = $array['type'];
        $last_edit = $array['last_edit'];
        $size      = $array['size'];
        $last_scan = $array['last_scan'];
        $query = "INSERT INTO scan(hash, patch, type, last_edit, size, last_scan)   VALUES ('$hash', '$patch', '$type', '$last_edit', '$size', '$last_scan')";
        DB::query($query);
    }

    public function update_list($item = array(), $id)
    {
        $data = "";
        foreach ($item as $key => $value) {
            $data .= $key . "='" . $value . "',";
        }
        $sql = "UPDATE scan SET " . mb_substr($data, 0, -1) . " WHERE id = " . $id;
        DB::query($sql);
    }

    public function getItemID($hash = "", $patch = "") {
        $sql = "SELECT id FROM scan WHERE hash = '$hash' AND patch = '$patch'";
        $result = DB::query($sql);
        return ($result->fetch_object())->id;
    }

    public function updateItem($item = array()) {
        $hash = $item['hash'];
        $patch = $item['patch'];
       $id = $this->getItemID($hash,$patch);

        if($id > 0) {
            $this->update_list($item, (int)$id);
        } else {
            $this->add_item($item);
        }
    }

    public function rd($update = array()){
        $hash = $update[0];
        $patch = $update[1];

        $query = "SELECT * FROM scan WHERE hash = '$hash' ";
        $sql = DB::query($query);

        if ($sql->num_rows !== 0) {
            $id = $sql->fetch_array();
            $id_count = null;

            foreach ($id as $key => $value) {
                if ($key == "id") {
                    $id_count = (int)$value;
                }
            }

            $this->update_list($update, (int)$id_count);
        } else {
            $this->add_file($patch);
            $this->add_item($update);
        }
    }

    public function getBD(){
        $query = "SELECT id,hash,patch,type,last_edit,size, last_scan  FROM scan";
        $sql = DB::query($query);
        return $sql;
    }
}
?>