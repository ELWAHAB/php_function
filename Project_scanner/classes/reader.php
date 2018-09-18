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
    }

    public function add_dir($patch = ""){
        mkdir($patch, 0700);
   }

    public function del_file($patch = ""){
         unlink($patch);
    }

    public function del_dir($patch = ""){
        rmdir($patch);
    }

    public function del_item($hash = ""){

        $sql = DB::query( "DELETE FROM scan WHERE hash = $hash ");
        DB::query($sql) or die;
    }

    public function add_item($array = array()){
        $hash = $array[0];
        $patch = $array[1];
        $type = $array[2];
        $last_edit = $array[3];
        $size = $array[4];
        $last_scan = $array[5];

        $query = "INSERT INTO scan(hash, patch, type, last_edit, size, last_scan)   VALUES ('$hash', '$patch', '$type', '$last_edit', '$size', '$last_scan')";
        DB::query($query);
    }

    public function update_list($update = array(), $id){

        $hash = $update[0];
        $patch = $update[1];
        $type = $update[2];
        $last_edit = $update[3];
        $size = $update[4];
        $last_scan = $update[5];

        $query = "UPDATE scan SET hash='$hash', patch ='$patch', type='$type', last_edit='$last_edit', size='$size', last_scan='$last_scan' WHERE id='$id' ";
        DB::query($query);
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
            $content = file_get_contents($patch);
            file_put_contents($patch, $content);

            $this->update_list($update, (int)$id_count);
        } else {
            $this->add_file($patch);
            $this->add_item($update);
        }
    }
}
?>