<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:42
 */

$controller = new Controller();

$controller->synchronizerBD();
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

    public function delete_not_exists_file(){
        $list_FTP = $this->getListFileFTP();
        $reader = new Reader();
        $list_BD = $reader->getBD();

        foreach ($list_BD as $key => $value_BD){

            $flag = false;

            foreach ($list_FTP as $value_FTP){
               if ($value_FTP['patch'] == $value_BD['patch']){
                    $flag = true;
                }
            }
            if ( !$flag){
                $delete_file = str_replace("../FTP","../SERVER",$value_BD['patch']);
                if ((boolean)$value_BD['type']){

                    $reader->del_file($delete_file);
                }else{
                    $reader->del_dir($delete_file);
                }
                $reader->del_item($value_BD['id']);
            }

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

    public function compare($item1 = array(), $item2 = array()) {
       $item1['patch'] = str_replace(array("../SERVER","../FTP"), array("",""),$item1['patch']);
       $item2['patch'] = str_replace(array("../SERVER","../FTP"), array("",""),$item2['patch']);
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


        $this->delete_not_exists_file();
    }
}
?>