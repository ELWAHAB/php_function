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

    function __construct($direct = "../local_dir" ){
        $this->direct = $direct;
    }

    public function scanning( $direct ){
        $scan = scandir($direct);

             foreach ($scan as $item){
                if ( ($item != ".") & ($item != "..")){
                    if (is_dir($direct . "/" . $item)){
                        $this->scanning($direct."/".$item);
                        $this->list_file[]['type'] = 0;
                }
                else{
                     $this->file_details($direct . "/" . $item);
                    $this->list_file[]['type'] = 1;
                }
                }
            }
    }

    public function file_details($patch){
        $this->list_file[]['patch']= $patch;
        $this->list_file[]['last_edit'] = filemtime($patch) ;
        $this->list_file[]['size']= filesize($patch);
        $this->list_file[]['last_scan']= time();
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