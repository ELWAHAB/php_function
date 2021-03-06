<?php
/**
 * Created by PhpStorm.
 * User: Andruha
 * Date: 16.09.2018
 * Time: 01:41
 */
class Scanner{
    private $list_file ;
    private $direct;
    public $index = 0;

    public $listAllDir;

    function __construct($direct = "../FTP" ){
        $this->direct = $direct;
    }

    // нові функції через ітератори для запису масив даних про файли

    // ------------- 3 -й варіант роботи з ітераторами -------------------------
    // ----- Працює ------
     public function scanning($direct){
        $recursDir = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($direct,
            RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
            RecursiveIteratorIterator::CATCH_GET_CHILD);

        foreach ($recursDir as $item){
            $path = str_replace("\\","/",$item);

            if ($item->isDir()){
                $this->file_details($this->index, $path);
                $this->list_file[$this->index]['type'] = 0;
                $this->index++;
            }else{
                $this->file_details($this->index, $path);
                $this->list_file[$this->index]['type'] = 1;
                $this->index++;
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



    // ------------- 2-й варіант роботи з ітераторами ---------------------------
    // ----- Працює ------

/*    public function scanning($direct){
        $dir = new DirectoryIterator($direct);

        foreach ($dir as $key => $directoryIterator){
            if (!$directoryIterator->isDot()){
                $str = str_replace("\\", "/",$directoryIterator->getPathname() );
//                echo $str;
//                echo "<br>";

                if ($directoryIterator->isDir()){
                    $this->scanning($str);
                    $this->file_details($this->index, $str, $directoryIterator);
                    $this->list_file[$this->index]['type'] = 0;
                    $this->index++;
                }else{
                    $this->file_details($this->index, $str, $directoryIterator);
                    $this->list_file[$this->index]['type'] = 1;
                    $this->index++;
                }
            }
        }
    }

    public function file_details($index = 0, $patch, DirectoryIterator $directoryIterator){

        if(!$directoryIterator->isDir()) {
            $this->list_file[$index]['hash']= md5(file_get_contents($patch));
        } else {
            $this->list_file[$index]['hash']= md5($patch);
        }
        $this->list_file[$index]['patch']= $patch;
        $this->list_file[$index]['last_edit'] = $directoryIterator->getMTime();
        $this->list_file[$index]['size']= $directoryIterator->getSize();
        $this->list_file[$index]['last_scan']= time();
    }*/


    // ------------- 1-й варіант роботи з ітераторами ---------------------------

 /*   public function scanning($direct){
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
    }

    //функція для запису у масив файлів, які знаходяться в поточній директорії
    public function getFileName($patch)
    {
        $dir = new DirectoryIterator($patch);

        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {



                $path = str_replace("\\","/",$fileinfo->getPathname());
                if (!($fileinfo->isDir())) {
                    $this->list_file[$this->index]['hash'] = md5(file_get_contents($path));
                } else {
                    $this->list_file[$this->index]['hash'] = md5($path);
                }
                $this->list_file[$this->index]['patch'] = $path;
                $this->list_file[$this->index]['last_edit'] = $fileinfo->getMTime();
                $this->list_file[$this->index]['size'] =  $fileinfo->getSize();
                $this->list_file[$this->index]['last_scan'] = time();

// вказуємо тип файлу: 0 - dir / 1 - file
                if ($fileinfo->isDir()) {
                    $this->list_file[$this->index]['type'] = 0;
                    $this->index++;
                } else {
                    $this->list_file[$this->index]['type'] = 1;
                    $this->index++;
                }


                echo $path. "<hr>";


            }

        }
        var_dump($this->list_file);
    }*/


    // старі функції через сканування директорії для запису масив даних про файли
    //---------------------------------------------------------------------------
    /*public function scanning( $direct ){
        $scan = scandir($direct);
             foreach ($scan as $item){
                if ( ($item != ".") & ($item != "..")){
                    if (is_dir($direct . "/" . $item)){
                        $this->scanning($direct."/".$item);
                        $this->file_details($this->index, $direct . "/" . $item);
                        $this->list_file[$this->index]['type'] = 0;
                        $this->index++;
                }
                else{
                     $this->file_details($this->index, $direct . "/" . $item);
                     $this->list_file[$this->index]['type'] = 1;
                     $this->index++;
                }
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
    }*/


    // наступні дві функції потрібні в любому випадку незалежно від того, чи працюємо із ітераторами чи рекурсією
    public function set_direct($direct){
        $this->direct = $direct;
    }

    public function get_list_files(){
        $this->scanning($this->direct);
        return $this->list_file;
    }

}
?>