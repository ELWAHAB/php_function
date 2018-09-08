<?php
/*
 * @class create than go with xml to JSON
 */
class  Xml2JSON{
    private $url;

    public function __construct($url)
    {
        $this -> $url = $url;
    }


    /*
     * general function
    * @url - силка на xml файл
    * @return - $xmlJSON - файл уже переведений в JSON array
    */
    public function xmlToJSON( $url)
    {
        $xmlObject = simplexml_load_file($this -> $url);
        $xmlArr = array();

        $xmlArr[] = $this->xml2array($xmlObject, $xmlArr);

        $xmlJSON = json_encode($xmlArr, JSON_NUMERIC_CHECK);

        return ($xmlJSON);
    }


    /*@xmlOject - xml обєкт витягний з xml - file
    *@out - масив у який записуються дані з xml-file
    * @return - $out - масив уже записаний з усіма даними
    * У функції використовується рекурсія, для того щоб звернутись до масивів, які в собі містять масиви.
    */
    public function xml2array($xmlObject, $out = array())
    {
        foreach ((array)$xmlObject as $index => $node) {
            $out[$index] = (is_object($node)) ? $this->xml2array($node) : $node;
        }
        return $out;
    }
}
?>