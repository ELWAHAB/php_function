<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 02:07
 */

require_once ("DB.php");
require_once ("../classes/reader.php");
require_once ("../classes/scanner.php");
require_once ("../classes/controller.php");

$dirName = "create";

$dirFiles = scandir($dirName);

foreach ($dirFiles as $file){
    if (($file !='.') & ($file != '..')) {
        DB::createTable($file);
    }

}
   $reader = new Reader();
    $list_BD = $reader->getBD();

    if ($list_BD !== null) {
        $controller = new Controller();
        $controller->synchronizerBD();
     }

?>
