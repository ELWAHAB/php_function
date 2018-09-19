<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:42
 */

$contr = new Controller();
$list =$contr->writeBD();


class Controller{

    public $hash;
    public $patch;
    public $type;
    public $last_edit;
    public $size;
    public $last_scan;
    public $list;

    public function getListFile(){
        $scan = new Scanner();
        $list_file = $scan ->get_list_files();
        return $list_file;
    }

    public function writeBD(){
        $list_file = $this->getListFile();

        for ($i = 0; $i<= count($list_file); $i++) {
            $j = $i % 6;
            foreach ($list_file[$i] as $value) {
                switch ($j) {
                    case 0:
                        $this->hash = $value;
                        break;
                    case 1:
                        $this->patch = $value;
                        break;
                    case 2:
                        $this->last_edit = $value;
                        break;
                    case 3:
                        $this->size = $value;
                        break;
                    case 4:
                        $this->last_scan = $value;
                        break;
                    case 5:
                        $this->type = $value;
                        $this->list = array($this->hash,$this->patch,$this->type,$this->last_edit,$this->size,$this->last_scan);
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