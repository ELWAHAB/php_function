<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */

$read = new Reader();

$list = array('11','dsddf','1','1909-00-00', '12', '1910-00-00');

//$read -> add_item($list);

//$read -> del_item('11');

//$read -> add_dir('../new');

//$read -> del_dir('../new');

//$read -> add_file('../rrr.sql');

//$read -> del_file('../rrr.sql');


class Reader{

    public function add_file($patch = ""){
             fopen($patch, 'w');
    }

    public function add_dir($patch = ""){

        mkdir($patch, 0700);
   }

    public function del_file($patch = ""){
         unlink($patch);
    }

    public function del_dir($patch = ""){
        rmdir($patch);
    }

    public function del_item($hash = ""){

        $sql = DB::query( "DELETE FROM scan WHERE hash = $hash ");
        DB::query($sql) or die;

    }

    public function add_item($array){

        $teg = array('hash', 'patch', 'type', 'last_edit', 'size', 'last_scan' );

      $query = "INSERT INTO scan (hash, patch, type, last_edit, size, last_scan )   VALUES ('$array[0]','$array[1]', '$array[2]', '$array[3]','$array[4]','$array[5]')";
        DB::query($query);

        /*for ($i = 0; $i < 6; $i++){
            $query = "INSERT INTO scan ($teg[$i])   VALUES ('$array[$i]')";
            DB::query($query);
        }*/

       /* $query = "INSERT INTO scan ('$teg')   VALUES ('$array')";
        DB::query($query);*/


    }
}


?>