<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */

//$scan = new Scanner();
//
//$scan->scanDir();



class Scanner{
    private $list_file ;
    private $direct;
    public $index = 0;
    public $flag = true;

    function __construct($direct = "../FTP" ){
        $this->direct = $direct;
    }


    public function scanning($direct){
        $iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($direct, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
// при блоке прав чтения не отвалится
            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied" (>>на которую у него нет прав на чтение)
        );

        echo "<hr>"."<hr>";

        //записує в масив файли в головній директорії FTP
        $this->getFileName($direct);
        $paths = array($direct);
        foreach ($iter as $path => $dir) {
            if ($dir->isDir()) {
                $str = str_replace("\\","/",$path);
//                echo "<hr/>".$str."<hr/>";
                $this->getFileName($str);
                $paths[] = $str;
            }
        }
        print_r($paths);
        echo "<hr>";
        var_dump($this->list_file);
    }

    //функція для запису у масив файлів, які знаходяться в поточній директорії
    public function getFileName($patch)
    {
        $dir = new DirectoryIterator($patch);

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
            //    echo "<br>" . ($fileinfo->isDir() ? "Yes" : "No");

                $this->file_details($this->index, $fileinfo);

// вказуємо тип файлу: 0 - dir / 1 - file
                if ($fileinfo->isDir()) {
                    $this->list_file[$this->index]['type'] = 0;
                    $this->index++;
                } else {
                    $this->list_file[$this->index]['type'] = 1;
                    $this->index++;
                }
                echo $this->list_file[$this->index]['type'];
                $path = $patch . "/" . $fileinfo;
                echo $path . "<hr>";

            }

        }
    }


    public function file_details($index = 0, $patch)
    {
        if (!($patch->isDir())) {
            $this->list_file[$index]['hash'] = file_get_contents((string)$patch);
        } else {
            $this->list_file[$index]['hash'] = "hashDir/".$patch;
        }
        $this->list_file[$index]['patch'] = (string)$patch;
        $this->list_file[$index]['last_edit'] = $patch->getMTime();
        $this->list_file[$index]['size'] =  $patch->getSize();
        $this->list_file[$index]['last_scan'] = time();
    }

//    public function scanning( $direct ){
//        $scan = scandir($direct);
//             foreach ($scan as $item){
//                if ( ($item != ".") & ($item != "..")){
//                    if (is_dir($direct . "/" . $item)){
//                        $this->scanning($direct."/".$item);
//                        $this->file_details($this->index, $direct . "/" . $item);
//                        $this->list_file[$this->index]['type'] = 0;
//                        $this->index++;
//                }
//                else{
//                     $this->file_details($this->index, $direct . "/" . $item);
//                     $this->list_file[$this->index]['type'] = 1;
//                     $this->index++;
//                }
//                }
//            }
//    }

//    public function file_details($index = 0, $patch){
//        if(!is_dir($patch)) {
//            $this->list_file[$index]['hash']= md5(file_get_contents($patch));
//        } else {
//            $this->list_file[$index]['hash']= md5($patch);
//        }
//        $this->list_file[$index]['patch']= $patch;
//        $this->list_file[$index]['last_edit'] = filemtime($patch) ;
//        $this->list_file[$index]['size']= filesize($patch);
//        $this->list_file[$index]['last_scan']= time();
//    }

//    public function set_direct($direct){
//        $this->direct = $direct;
//    }

    public function get_list_files(){
        $this->scanning($this->direct);
        return $this->list_file;
    }

}
?>