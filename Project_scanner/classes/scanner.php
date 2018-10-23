<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */

$scan = new Scanner();

$scan->scanDir();

class Scanner{
    private $list_file ;
    private $direct;
    public $index = 0;
    public $flag = true;

    function __construct($direct = "../FTP" ){
        $this->direct = $direct;
    }


    public function scanDir(){
        $iter = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->direct, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
// при блоке прав чтения не отвалится
            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied" (>>на которую у него нет прав на чтение)
        );

        echo "<hr>"."<hr>";
        $this->getFileName($this->direct);
        $paths = array($this->direct);
        foreach ($iter as $path => $dir) {
            if ($dir->isDir()) {
                $str = str_replace("\\","/",$path);
//                echo "<hr/>".$str."<hr/>";
                $this->getFileName($str);
                $paths[] = $str;
            }
        }
        print_r($paths);
//        echo "<hr>";
//        var_dump($paths);
    }

    public function getFileName($patch){
        $dir = new DirectoryIterator($patch);

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
//                var_dump($fileinfo->getFilename());
                echo "<br>".($fileinfo->isDir()?"Yes":"No");
//                echo "<br>  ".$fileinfo." 111<br>";
                if ($fileinfo->isDir()){
                    $this->list_file[$this->index]['type'] = 0;
                }else{
                    $this->list_file[$this->index]['type'] = 1;
                }
                echo $this->list_file[$this->index]['type'];
                $path = $patch."/".$fileinfo;
                echo $path."<hr>";
//                $this->file_details($this->index, $fileinfo);
//                  $this->index++;
            }

        }
    }


        public function file_details($index = 0, $patch){
        if(!is_dir($patch)) {
            $this->list_file[$index]['hash']= md5(file_get_contents($patch));
        } else {
            $this->list_file[$index]['hash']= md5($patch);
        }
        $this->list_file[$index]['patch']= $patch;
        $this->list_file[$index]['last_edit'] = filemtime($patch) ;
        $this->list_file[$index]['size']= filesize($patch);
        $this->list_file[$index]['last_scan']= time();
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

//    public function get_list_files(){
//        $this->scanning($this->direct);
//        return $this->list_file;
//    }

}
?>