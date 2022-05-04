<?php

namespace App\Classes;


class DownloadFile {


    private $conn, $login_result, $logData, $ftpUser, $ftpPass, $ftpHost, $retry, $ftpPasv, $ftpMode, $verbose, $logPath, $createMask;

    // --------------------------------------------------------------------

    /**
     * Construct method
     *
     * @param   array   keys[passive_mode(true|false)|transfer_mode(FTP_ASCII|FTP_BINARY)|reattempts(int)|log_path|verbose(true|false)|create_mask(default:0777)]
     * @return void
     */
    function __construct()
    {
        $this->retry = (isset($o['reattempts'])) ? $o['reattempts'] : 3;
        $this->ftpPasv = (isset($o['passive_mode'])) ? $o['passive_mode'] : true;
        $this->ftpMode = (isset($o['transfer_mode'])) ? $o['transfer_mode'] : FTP_BINARY;
        $this->verbose = (isset($o['verbose'])) ? $o['verbose'] : false;
        $this->logPath = (isset($o['log_path'])) ? $o['log_path'] : dirname(__FILE__).'\log'; 
        $this->createMask = (isset($o['create_mask'])) ? $o['create_mask'] : 0777;
    }

    // --------------------------------------------------------------------

    /**
     * Connection method
     *
     * @param   string  hostname
     * @param   string  username
     * @param   string  password
     * @return  void
     */
    public function conn($hostname, $username, $password)
    {   
        $this->ftpUser = $username;
        $this->ftpPass = $password;
        $this->ftpHost = $hostname;

        $this->initConn();
    }

    // --------------------------------------------------------------------

    /**
     * Init connection method - connect to ftp server and set passive mode
     *
     * @return  bool
     */
    function initConn()
    {
        $this->conn = ftp_connect($this->ftpHost);
        $this->login_result = ftp_login($this->conn, $this->ftpUser, $this->ftpPass);
        if($this->conn && $this->login_result)
        {
            ftp_pasv($this->conn, $this->ftpPasv);
            return true;
        }       
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Put method - upload files(folders) to ftp server
     *
     * @param   string  path to destionation file/folder on ftp
     * @param   string  path to source file/folder on local disk
     * @param   int only for identify reattempt, dont use this param
     * @return  bool
     */
    public function put($destinationFile, $sourceFile, $retry = 0)
    {   
        if(file_exists($sourceFile))
        { 
            if(!$this->isDir($sourceFile, true))
            {
                $this->createSubDirs($destinationFile);
                if(!ftp_put($this->conn, $destinationFile, $sourceFile, $this->ftpMode))
                {
                    $retry++;
                    if($retry > $this->retry)
                    {
                        $this->logData('Error when uploading file: '.$sourceFile.' => '.$destinationFile, 'error');
                        return false;
                    }
                    if($this->verbose) echo 'Retry: '.$retry."\n";
                    $this->reconnect();
                    $this->put($destinationFile, $sourceFile, $retry);
                }
                else
                {
                    $this->logData('Upload:'.$sourceFile.' => '.$destinationFile, 'ok');
                    return true;
                }
            }
            else
            {
                $this->recursive($destinationFile, $sourceFile, 'put');
            }
        }       
    }

    // --------------------------------------------------------------------

    /**
     * Get method - download files(folders) from ftp server
     *
     * @param   string  path to destionation file/folder on local disk
     * @param   string  path to source file/folder on ftp server
     * @param   int only for identify reattempt, dont use this param
     * @return  bool
     */
    public function get($destinationFile, $sourceFile, $retry = 0)
    {
        if(!$this->isDir($sourceFile, false))
        {
            if($this->verbose)echo $sourceFile.' => '.$destinationFile."\n";
            $this->createSubDirs($destinationFile, false, true);
            if(!ftp_get($this->conn, $destinationFile, $sourceFile, $this->ftpMode))
            {
                $retry++;
                if($retry > $this->retry)
                {
                    $this->logData('Error when downloading file: '.$sourceFile.' => '.$destinationFile, 'error');
                    return false;
                }
                if($this->verbose) echo 'Retry: '.$retry."\n";
                $this->reconnect();
                $this->get($destinationFile, $sourceFile, $retry);
            }
            else
            {
                $this->logData('Download:'.$sourceFile.' => '.$destinationFile, 'ok');
                return true;
            }
        }
        else
        {
            $this->recursive($destinationFile, $sourceFile, 'get');
        }
    }

    // --------------------------------------------------------------------

    /**
     * Make dir method - make folder on ftp server or local disk
     *
     * @param   string  path to destionation folder on ftp or local disk
     * @param   bool    true for local, false for ftp
     * @return  bool
     */
    public function makeDir($dir, $local = false)
    {
        if($local)
        {
            if(!file_exists($dir) && !is_dir($dir))return mkdir($dir, $this->createMask); else return true;
        }
        else
        {
            ftp_mkdir($this->conn,$dir);
            return ftp_chmod($this->conn, $this->createMask, $dir);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Cd up method - change working dir up
     *
     * @param   bool    true for local, false for ftp
     * @return  bool
     */
    public function cdUp($local)
    {
        return $local ? chdir('..') : ftp_cdup($this->conn);
    }

    // --------------------------------------------------------------------

    /**
     * List contents of dir method - list all files in specified directory
     *
     * @param   string  path to destionation folder on ftp or local disk
     * @param   bool    true for local, false for ftp
     * @return  bool
     */
    public function listFiles($file, $local = false)
    {
        if(!$this->isDir($file, $local))return false;
        if($local)
        {
            return scandir($file);
        }
        else
        {
            if(!preg_match('/\//', $file))
            {
                return ftp_nlist($this->conn, $file);
            }else
            {
                $dirs = explode('/', $file);
                foreach($dirs as $dir)
                {
                    $this->changeDir($dir, $local);
                }
                $last = count($dirs)-1;
                $this->cdUp($local);
                $list = ftp_nlist($this->conn, $dirs[$last]);
                $i = 0;
                foreach($dirs as $dir)
                {
                    if($i < $last) $this->cdUp($local);
                    $i++;
                }
                return $list;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Returns current working directory
     *
     * @param   bool    true for local, false for ftp
     * @return  bool
     */
    public function pwd($local = false)
    {
        return $local ? getcwd() : ftp_pwd($this->conn);
    }

    // --------------------------------------------------------------------

    /**
     * Change current working directory
     *
     * @param   string  dir name
     * @param   bool    true for local, false for ftp
     * @return  bool
     */
    public function changeDir($dir, $local = false)
    {
        return $local ? chdir($dir) : @ftp_chdir($this->conn, $dir);
    }

    // --------------------------------------------------------------------

    /**
     * Create subdirectories
     *
     * @param   string  path
     * @param   bool    
     * @param   bool    true for local, false for ftp
     * @param   bool    change current working directory back
     * @return  void
     */
    function createSubDirs($file, $last = false, $local = false, $chDirBack = true)
    {
        if(preg_match('/\//',$file))
        {
            $origin = $this->pwd($local);
            if(!$last) $file = substr($file, 0, strrpos($file,'/'));
            $dirs = explode('/',$file);
            foreach($dirs as $dir)
            {
                if(!$this->isDir($dir, $local))
                {
                    $this->makeDir($dir, $local);
                    $this->changeDir($dir, $local);
                }
                else
                {
                    $this->changeDir($dir, $local);
                }
            }
            if($chDirBack) $this->changeDir($origin, $local);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Recursion
     *
     * @param   string  destionation file/folder
     * @param   string  source file/folder
     * @param   string  put or get
     * @return  void
     */
    function recursive($destinationFile, $sourceFile, $mode)
    {
        $local = ($mode == 'put') ? true : false;
        $list = $this->listFiles($sourceFile, $local);
        if($this->verbose) echo "\n".'Folder: '.$sourceFile."\n";
        $this->logData(($mode=='get')?('Download:'):('Upload:').$sourceFile.' => '.$destinationFile, 'ok');       

        if($this->verbose) print_r($list);
        $x=0;
        $z=0;
        if(count($list)==2)// blank folder
        {
            if($mode == 'get')
                $this->makeDir($destinationFile, true);
            if($mode == 'put')
                $this->makeDir($destinationFile);
        }   
        foreach($list as $file)
        {
            if($file == '.' || $file == '..')continue;
            $destFile = $destinationFile.'/'.$file;
            $srcFile = $sourceFile.'/'.$file;
            if($this->isDir($srcFile,$local))
            {
                $this->recursive($destFile, $srcFile, $mode);
            }
            else
            {
                if($local)
                {
                    $this->put($destFile, $srcFile);
                }
                else
                {
                    $this->get($destFile, $srcFile);
                }
            } 
        }
    }

    // --------------------------------------------------------------------

    /**
     * Check if is dir
     *
     * @param   string  path to folder
     * @return  bool
     */
    public function isDir($dir, $local)
    {
        if($local) return is_dir($dir);
        if($this->changeDir($dir))return $this->cdUp(0);
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Save log data to array
     *
     * @param   string  data
     * @param   string  type(error|ok)
     * @return  void
     */
    function logData($data, $type)
    {
        $this->logData[$type][] = $data;
    }

    // --------------------------------------------------------------------

    /**
     * Get log data array
     *
     * @return  array
     */
    public function getLogData()
    {
        return $this->logData;
    }

    // --------------------------------------------------------------------

    /**
     * Save log data to file
     *
     * @return  void
     */
    public function logDataToFiles()
    {
        if(!$this->logPath) return false;
        $this->makeDir($this->logPath, true);
        $log = $this->getLogData();  
        $sep = "\n".date('y-m-d H:i:s').' ';
        if($log['error'] != "")
        {
            $logc = date('y-m-d H:i:s').' '.join($sep,$log['error'])."\n";
            $this->addToFile($this->logPath.'/'.$this->ftpUser.'-error.log',$logc);
        }
        if($log['ok'] != "")
        {
            $logc = date('y-m-d H:i:s').' '.join($sep,$log['ok'])."\n";
            $this->addToFile($this->logPath.'/'.$this->ftpUser.'-ok.log',$logc);
        }
    }

    // --------------------------------------------------------------------

    /**
     * Reconnect method
     *
     * @return  void
     */
    public function reconnect()
    {
        $this->closeConn();
        $this->initConn();
    }

    // --------------------------------------------------------------------

    /**
     * Close connection method
     *
     * @return  void
     */
    public function closeConn()
    {
        return ftp_close($this->conn);
    }

    // --------------------------------------------------------------------

    /**
     * Write to file
     *
     * @param   string  path to file
     * @param   string  text
     * @param   string  fopen mode
     * @return  void
     */
    function addToFile($file, $ins, $mode = 'a')
    {
        $fp = fopen($file, $mode);
        fwrite($fp,$ins);
        fclose($fp);
    }

    // --------------------------------------------------------------------

    /**
     * Destruct method - close connection and save log data to file
     *
     * @return  void
     */
    function __destruct()
    {       
        $this->closeConn();
        $this->logDataToFiles();
    }





    
    /* public function getSize($url) {
        // Assume failure.
        $result = -1;
        $curl = curl_init( $url );
        // Issue a HEAD request and follow any redirects.
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $curl, CURLOPT_NOBODY, true );
        curl_setopt( $curl, CURLOPT_HEADER, true );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $curl, CURLOPT_USERAGENT,  $_SERVER['HTTP_USER_AGENT']);
        $data = curl_exec( $curl );
        curl_close( $curl );
        if( $data ) {
            $content_length = "unknown";
            $status = "unknown";
            if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
            $status = (int)$matches[1];
            }
            if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
            $content_length = (int)$matches[1];
            }
            if( $status == 200 || ($status > 300 && $status <= 308) ) {
            $result = $content_length;
            }
        }
        return $result;
    }


    public function saveFile($url, $dir){
        $urlB = $url;	
        //remove the query string and get the file name
        if ($url = parse_url($url)) {
            $cleanUrl = $url['scheme'].$url['host'].$url['path'];
        }
        //get the pathinfo() of the url
        $cleanUrl = pathinfo($cleanUrl);
        //get the file name
        $name = $cleanUrl['basename'];
        //check if the directory exists and create a new directory if it does not
        if(!file_exists($dir)){
            mkdir($dir);
        }
        //check if the file exists and prepend a timestamp to its name if it does
        if(file_exists(dirname(__FILE__) . '/'.$dir.'/'.$name)){$name = time()."-".$name;}
        
        //create a new file where its contents will be dumped
        $fp = fopen (dirname(__FILE__) . '/'.$dir.'/'.$name, 'w+');
        
        //Here is the file we are downloading, replace spaces with %20
        $ch = curl_init(str_replace(" ","%20",$urlB));
        
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        //disable ssl cert verification to allow copying files from HTTPS NB: you can always fix your php 'curl.cainfo' setting so yo dont have to disable this 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // write curl response to file
        curl_setopt($ch, CURLOPT_FILE, $fp); 
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
        // get curl response
        $exec = curl_exec($ch); 
        
        curl_close($ch);
        fclose($fp);

        if($exec == true){
            $returnData[0] = true;
        }else{
                $returnData[0] =false;
            }
        $returnData[1] = $dir;	
        $returnData[2] = $url;
        $returnData[3] = $name;
        $returnData[4] = $dir.'/'.$name;
        return $returnData;
    }


    public function logDownload($returnData,$logFile){
        $dir = $returnData[1];
        if(isset($returnData[2]['query'])){
            $url = $returnData[2]['scheme'].'://'.$returnData[2]['host'].$returnData[2]['path'].'?'.$returnData[2]['query'];
        }else{
            $url = $returnData[2]['scheme'].'://'.$returnData[2]['host'].$returnData[2]['path'];
        }
        if(!file_exists($logFile)){
        $myfile = fopen($logFile, "w+") or die("Unable to open file!");	
        $txt =<<<EOD
        <?php
        \$i = 0; 
        EOD;
        fwrite($myfile, $txt);
        fclose($myfile);
        }
        $myfile = fopen($logFile, "a+") or die("Unable to open file!");
        $txt =<<<EOD
        \$url[\$i] = $url;
        \$dir[\$i] = $dir;
        EOD;
        fwrite($myfile, "\r\n".$txt);
        $ret = fclose($myfile); 
        return $ret;		
    } */
}