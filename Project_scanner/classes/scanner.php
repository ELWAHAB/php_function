<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */

$ob = new Scanner("../local_dir");

$arr = array();
$ob->scanning( );
//$ob->files_details($arr);
//echo $ob->files_details($arr);

class Scanner
{
    public $size;
    public $filetime;
    public $strDate;
    private $list_file = array();
    private $direct;

    public function __construct($direct)
    {
       $this->direct = $direct;
    }

    public function scanning($direct = "", $list_file = array()){


        $this->list_file = $list_file;
        $scan = scandir($this->direct);
        var_dump($scan);
       /*foreach ($scan as $item) {
            if ( ($item != ".") & $item != "..") {
                if (is_dir($direct . "/" . $item)) {
                    $this->scanning($direct."/".$item, $this->list_file);
                } else {
                    $this->list_file[] = $direct . "/" . $item;
                }
            }
        }
        var_dump($this->list_file);*/
    }

    public function files_details($list_file)
    {
        foreach ($list_file as $a) {
            $size = filesize($a);
            $filetime = filemtime($a);
            $strDate = date("Y-m-d H:i:s", $filetime);
            var_dump($filetime);
            /*echo $size;
            echo $strDate;
            echo $filetime;*/

        }
    }
}
?>