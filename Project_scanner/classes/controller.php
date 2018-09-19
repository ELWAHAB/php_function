<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:42
 */

$contr = new Controller();
$list =$contr->writeBD();
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
    public $list;

    public function getListFileFTP(){
        $scan = new Scanner("../local_dir");
        $list_file = $scan ->get_list_files();
        return $list_file;
    }

    public function writeBD(){
        $list_file = $this->getListFileFTP();

        foreach ($list_file as $item){
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
                        $this->list = array($this->hash, $this->patch, $this->type, $this->last_edit, $this->size, $this->last_scan);

                        $this->set_list($this->list);
                        $this->list = null;
                        break;
                }
            }
        }
    }


    public function set_list($list){
        $reader = new Reader();
        $reader->rd($list);
    }


}
?>