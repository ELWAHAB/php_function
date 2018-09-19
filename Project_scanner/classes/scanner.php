<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */
class Scanner{
    private $list_file ;
    private $direct;
    public $index = 0;

    function __construct($direct = "../FTP" ){
        $this->direct = $direct;
    }

    public function scanning( $direct ){
        $scan = scandir($direct);
             foreach ($scan as $item){
                if ( ($item != ".") & ($item != "..")){
                    if (is_dir($direct . "/" . $item)){
                        $this->scanning($direct."/".$item);
                        $this->file_details($this->index, $direct . "/" . $item);
                        $this->list_file[$this->index]['type'] = 0;
                        $this->index++;
                }
                else{
                     $this->file_details($this->index, $direct . "/" . $item);
                    $this->list_file[$this->index]['type'] = 1;
                    $this->index++;
                }
                }
            }
    }
    public function file_details($index = 0, $patch){
        if(!is_dir($patch)) {
            $this->list_file[$index]['hash']= md5(file_get_contents($patch));
        } else {
            $this->list_file[$index]['hash']= md5($patch);
        }
        $this->list_file[$index]['patch']= $patch;
        $this->list_file[$index]['last_edit'] = filemtime($patch) ;
        $this->list_file[$index]['size']= filesize($patch);
        $this->list_file[$index]['last_scan']= time();
    }

    public function set_direct($direct){
        $this->direct = $direct;
    }

    public function get_list_files(){
        $this->scanning($this->direct);
        return $this->list_file;
    }

}
?>