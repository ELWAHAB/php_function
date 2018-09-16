<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 02:07
 */

require_once ("DB.php");
require_once ("../classes/reader.php");


$dirName = "create";

$dirFiles = scandir($dirName);

foreach ($dirFiles as $file){
    if (($file !='.') & ($file != '..')) {
        DB::createTable($file);
    }

}