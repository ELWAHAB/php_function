<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 09.09.2018
 * Time: 01:34
 */
require_once("Xml2JSON.php");

$url = "library/XmlToJSON/example.xml";

$xml2JsoN = new Xml2JSON($url);

$arrayJSON = $xml2JsoN->xmlToJSON($url);

print_r($arrayJSON);

?>