<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:42
 */

$controller = new Controller();

$controller->synchronizerBD();
//$controller->patchs = "../FTP/proSto/rrererer/bdjdj/skjjnd/dsds/dsd/sfsfs.txt";
//$controller->existDir("../FTP/example/rrererer/bdjdj/skjjnd/dsds/dsd/sfsfs.txt");
//$controller->delete_not_exists_file();

/*$server = $controller->getListFileSERVER();

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
}*/
/*foreach ($server as $s) {
    $patch = str_replace("../SERVER","",$s['patch']);

    $transit = $controller->findItemByPatchSERVER($ftp,$patch);


    if($transit) {
        $comp = $controller->compare($transit,$s);
        if(!$comp) {
            $reader->updateItem($s);
            $ftpFile = $transit['patch'];
            $serverFile = $s['patch'];
            if(!is_dir($serverFile)) {
                file_put_contents(
                    $ftpFile,
                    file_get_contents($serverFile));
            }
        }
    } else {
        $reader->add_item($s);
        $serverFile = $s['patch'];
        $ftpFile = str_replace("../SERVER","../FTP",$serverFile);

        if(!is_dir($serverFile)) {
            file_put_contents(
                $ftpFile,
                file_get_contents($serverFile));
        } else {
            $reader->add_dir($ftpFile);
        }


    }
}*/
class Controller{

    public $list_not_exists_file;
    public $list_not_exists_dir;

    public function getListFileFTP(){
        $scan = new Scanner("../FTP");
        $list_file = $scan ->get_list_files();
        return $list_file;
    }

    public function getListFileSERVER(){
        $reader = new Reader();
        $list_file =  $reader->getBD();
        return $list_file;
    }

    public function delete_not_exists_file(){
        $list_FTP = $this->getListFileFTP();
        $reader = new Reader();
        $list_BD = $reader->getBD();
        //find all not exists file and dir
        foreach ($list_BD as $key => $value_BD){
            $flag = false;

            foreach ($list_FTP as $value_FTP){
               if ($value_FTP['patch'] == $value_BD['patch']){
                    $flag = true;
                }
            }
            if ( !$flag){
                if ((boolean) $value_BD['type']) {
                    $this->list_not_exists_file[] = $value_BD;
                }else{
                    $this->list_not_exists_dir[] = $value_BD;
            }
            }
        }
        //delete all not exists files
        if ($this->list_not_exists_file !== null){
        foreach ($this->list_not_exists_file as $value_BD){
            $delete_file = str_replace("../FTP","../SERVER",$value_BD['patch']);
            $reader->del_file($delete_file);
            $reader->del_item( (int) $value_BD['id']);
        }
        }
        //delete all not exists dir
        if ($this->list_not_exists_dir !== null) {
            foreach ($this->list_not_exists_dir as $value_BD){
                $delete_file = str_replace("../FTP","../SERVER",$value_BD['patch']);
                $reader->del_dir($delete_file);
                $reader->del_item( (int) $value_BD['id']);
            }
        }
    }

    public function findItemByPatchFTP($items = array(), $patch = "") {

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

    public function compare($item1 = array(), $item2 = array()) {
       $item1['patch'] = str_replace("../FTP", "",$item1['patch']);
       $item2['patch'] = str_replace("../FTP", "",$item2['patch']);
        foreach ($item1 as $key => $value) {
            if($item2[$key] != $value) return false;
        }

        return true;
    }

    public function synchronizerBD(){
        $reader = new Reader();
        $server = $this->getListFileSERVER();
        $ftp = $this->getListFileFTP();
        foreach ($ftp as $f) {
            $patch = str_replace("../FTP","",$f['patch']);
            $transit = $this->findItemByPatchFTP($server,$patch);
            if($transit) {
                $comp = $this->compare($transit,$f);
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

                $ftpFile = $f['patch'];
                $serverFile = str_replace("../FTP","../SERVER",$ftpFile);
                if(!is_dir($serverFile)) {
                   $this->existDir($serverFile);
                    file_put_contents(
                        $serverFile,
                        file_get_contents($ftpFile));
                }
                $reader->add_item($f);
            }
        }
        $list_BD = $reader->getBD();
        if ($list_BD !== null) {
            $this->delete_not_exists_file();
        }
    }





    public function existDir($patchs){
        $dir = dirname($patchs);
        if (!is_dir($dir)){
            mkdir($dir, 0777, true);
        }
        return true;
    }
}
//echo "../FTP/pppjp/rrererer/sfsfs.txt";
?>