<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:42
 */

$controller = new Controller();

$reader = new Reader();

$server = $controller->getListFileSERVER();

$ftp = $controller->getListFileFTP();



foreach ($ftp as $f) {
    $patch = str_replace("../FTP","",$f['patch']);

    $transit = $controller->findItemByPatchFTP($server,$patch);


    if($transit) {
        $comp = $controller->compare($transit,$f);
        if(!$comp) {
            $reader->updateItem($f);
            $serverFile = $transit['patch'];
            $ftpFile = $f['patch'];
            if(!is_dir($ftpFile)) {
                file_put_contents(
                    $serverFile,
                    file_get_contents($ftpFile));
            }
        }
    } else {
        $reader->add_item($f);
        $ftpFile = $f['patch'];
        $serverFile = str_replace("../FTP","../SERVER",$ftpFile);

        if(!is_dir($ftpFile)) {
            file_put_contents(
                $serverFile,
                file_get_contents($ftpFile));
        } else {
            $reader->add_dir($serverFile);
        }


    }
}


/*

foreach ($server as $s) {
    $patch = str_replace("../SERVER","",$s['patch']);
    $transit = $controller->findItemByPatchSERVER($ftp,$patch);

    if(!$transit) {
        $id = $reader->getItemID($s['hash'],$s['patch']);
        $reader->del_item($id);
        $reader->del_file($s['patch']);
    }
}




*/




/*foreach ($list as $item){
    foreach ()
    var_dump($item);
    echo "<hr/>";
}*/



class Controller{

    public $hash;
    public $patch;
    public $type;
    public $last_edit;
    public $size;
    public $last_scan;
    public $listForBD;
    public $list_sort;

    public function getListFileFTP(){
        $scan = new Scanner("../FTP");
        $list_file = $scan ->get_list_files();
        return $list_file;
    }
    public function getListFileSERVER(){
        $scan = new Scanner("../SERVER");
        $list_file = $scan ->get_list_files();
        return $list_file;
    }
    public function sortFileList(){
        $list_FTP = $this->getListFileFTP();
        $list_SERVER = $this->getListFileSERVER();
        $index = 0;
        var_dump($list_FTP);
        echo "<hr/>";
        var_dump($list_SERVER);

        foreach ($list_SERVER as $keySERVER => $valueSERVER){
            $flag = false;

            foreach ($list_FTP as $keyFTP => $valueFTP){
                if ( ($keyFTP == 'hash') & ($keySERVER == 'hash') ){
                    if ($valueFTP == $valueSERVER){
                        $flag = true;
                    }
                }
            }
            if (!($flag)){
                 $this->list_sort[$index] = $keySERVER;
                 $index++;
            }
        }


    }

    public function writeBD(){
        $list_file = $this->getListFileFTP();

        foreach ($list_file as $item){
            $this->set_list($item);
            /*
            foreach ($item as $key => $value) {
                switch ($key) {
                    case $key == 'hash':
                        $this->hash = $value;
                        break;
                    case $key == 'patch':
                        $this->patch = $value;
                        break;
                    case $key == 'last_edit':
                        $this->last_edit = $value;
                        break;
                    case $key == 'size':
                        $this->size = $value;
                        break;
                    case $key == 'last_scan':
                        $this->last_scan = $value;
                        break;
                    case $key == 'type':
                        $this->type = $value;
                        $this->listForBD = array($this->hash, $this->patch, $this->type, $this->last_edit, $this->size, $this->last_scan);


                        $this->listForBD = null;
                        break;
                }
            }
            */
        }
    }

    public function findItemByPatchFTP($items = array(), $patch = "") {

        if(!$items || $items == null) {
            return false;
        }
        foreach ($items as $item) {
            $patch1 = str_replace("../SERVER","",$item['patch']);
            if($patch1 == $patch) {
                return $item;
            }
        }
        return false;
    }

    public function findItemByPatchSERVER($items = array(), $patch = "") {

        if(!$items || $items == null) {
            return false;
        }

        foreach ($items as $item) {
            $patch1 = str_replace("../FTP","",$item['patch']);
            if($patch1 == $patch) {
                return $item;
            }
        }
        return false;
    }


    public function set_list($list){
        $reader = new Reader();
        $reader->updateItem($list);
    }


    public function compare($item1 = array(), $item2 = array()) {
       $item1['patch'] = str_replace(array("../SERVER","../FTP"), array("",""),$item1['patch']);
       $item2['patch'] = str_replace(array("../SERVER","../FTP"), array("",""),$item2['patch']);
        foreach ($item1 as $key => $value) {
            if($item2[$key] != $value) return false;
        }

        return true;
    }


}
?>