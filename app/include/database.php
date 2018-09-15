<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 15.09.2018
 * Time: 15:18
 */

$link = mysqli_connect('localhost', 'root','','example');

if (mysqli_connect_errno()){
    echo "Ошибка подключения к базе даних  (".mysqli_connect_errno()."): ".mysqli_connect_error();
    exit();
}

?>