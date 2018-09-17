<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */

$ob = new hui("vadik");
$arr = array();
$ob->f("vadik",$arr);
$ob->g($arr);
echo $ob->g($arr);

class Scanner
{
    public $s;
    public $filetime;
    public $strDate;
    private $arr;
    private $dir;
    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    public function f($dir, &$arr){
        $d = scandir($this->dir);
        foreach ($d as $q) {
            if ($q != "." & $q != "..") {
                if (is_dir($this->dir . "/" . $q)) {
                    $this->f($this->dir . "/" . $q, $arr);
                } else {
                    $arr[] = $this->dir . "/" . $q;
                }
            }
        }
    }

    public function g($arr)
    {
        foreach ($arr as $a) {
            $s = filesize($a);
            $filetime = filemtime($a);
            $strDate = date("Y-m-d H:i:s", $filetime);
            echo $s;
            echo $strDate;
            echo $filetime;
        }
    }
}
?>