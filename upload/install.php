<?php
$version = '1.2.0';
error_reporting(0);
ini_set('display_errors', 0);
set_time_limit(0);
ini_set('max_execution_time',0);
header('Content-Type: text/html; charset=utf-8');

if(extension_loaded('xdebug')) ini_set('xdebug.max_nesting_level', 100000);

$InstallData = ciInstaller::getPackageInfo();

if (!empty($_GET['ci'])) ciInstaller::doInstall();

//@TODO : add check installer version
echo '
<!DOCTYPE html>
<html>
<head>
    <title>ci Installer v'.$version.'</title>
    <meta charset="utf-8">
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Quicksand:300,400&subset=latin,cyrillic);article,aside,audio,b,body,canvas,dd,details,div,dl,dt,em,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,img,label,li,mark,menu,nav,ol,p,section,span,strong,summary,table,tbody,td,tfoot,th,thead,time,tr,u,ul,video{margin:0;padding:0;border:0;outline:0;vertical-align:baseline;background:0 0;font-size:100%}a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:0 0}table{border-collapse:collapse;border-spacing:0}td,td img{vertical-align:top}button,input,select,textarea{margin:0;font-size:100%}input[type=password],input[type=text],textarea{padding:0}input[type=checkbox]{vertical-align:bottom}input[type=radio]{vertical-align:text-bottom}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}html{overflow-y:scroll}body{color:#111;text-align:left;font:12px "Quicksand",sans-serif}button,input,select,textarea{font-family:"Quicksand",sans-serif}a,a:active,a:focus,a:hover,a:visited,button,input[type=button],input[type=submit],label{cursor:pointer}::selection{background:#84d5e8;color:#fff;text-shadow:none}html{position:relative;background:#f8f8f8 url(https://installer.Cimple-cms.com/img/base.png)}body{background:0 0;font-size:14px;line-height:22px;font-family:"Quicksand",sans-serif;text-shadow:0 1px 0 #fff}a{color:#0f7096}.button,button{color:#fff;display:inline-block;padding:15px;font-size:20px;text-decoration:none;border:5px solid #fff;border-radius:8px;background-color:#67a749;background-image:linear-gradient(to top,#67a749 0,#67a749 27.76%,#a1c755 100%);text-shadow:0 0 2px rgba(0,0,0,.64)}a.button{padding:5px 15px; float: right;}h1,h2,h3,h4,h5{font-family:"Quicksand",sans-serif;line-height:28px; font-weight:300;}h1{font-size:26px;font-weight: 300;}h2{font-size:22px}h3{font-size:18px}h4{font-size:16px}h5{font-size:14px}.header{-moz-box-sizing: border-box;float:left;width:100%;box-sizing:border-box;background:#fff;background:linear-gradient(to bottom,#fff,#f2f2f2);padding:20px;border-bottom:1px solid #fff}.header img{float:left;width:256px;margin: 0 20px 0 0}.header h1.main-heading{color:#137899;font-size:24px;line-height:30px; float: left;}.header-button-wrapper{float:right}.main-heading>span{display:none}.main-heading>sup{color:#ccc;font-weight:400}.content{float:left;padding:30px}.content h2{margin:0;line-height:20px}.content form{margin:10px 0 50px}.content form .column{float:left;box-sizing:border-box;width:500px;margin:20px 0}.column h3{display:inline-block;padding:0 0 5px;margin:0 0 20px;border-bottom:2px solid #000}.column label{float:left;width:100%;clear:both;padding:5px 0;font-size:16px}form button{float:left;width:200px;clear:both; margin-top:15px;}label>span{border-bottom:1px dotted #555}label>input{margin:0 5px 0 0}.footer{position:absolute;bottom:20px;right:20px;font-size:10px;color:#ccc}.footer a{color:#aaa}
    </style>
</head>
<body>
    <div class="header">
        <img src="tacaly.de/dev/cimple/logo.png">
        <h1 class="main-heading"><span>ci</span> Installer <sup>v'.$version.'</sup> </h1>
        <div class="header-button-wrapper">
            <!--<a href="#" class="button">New version</a>&nbsp;-->
        </div>
    </div>
</div>
<div class="content">
    <h2>Choose CI version for Install:</h2>
    <form>';
    $ItemGrid = array(); 
    foreach($InstallData as $ver=>$item){
        $ItemGrid[$item['tree']][$ver] = $item;
    }
    foreach($ItemGrid as $tree=>$item){
        echo '<div class="column">
            <!--h3>'.strtoupper($tree).'</h3-->';
            foreach($item as $version => $itemInfo){
                $checked = ($version == 'master') ? 'checked' : '';
                echo '<label><input type="radio" name="ci" value="'.$version.'" '.$checked.'> <span>'.$itemInfo['name'].'</span></label><br>';
            }
        echo '</div>';
    }
    
if(!ini_get('allow_url_fopen') )    echo '<h2>Cannot download the files - url_fopen is not enabled on this server.</h2>';
elseif(!ciInstaller::hasDirPerm()) echo '<h2>Cannot download the files - The directory does not have write permission.</h2>';
else                                echo '<br><button>Install &rarr;</button>';

echo '</form>
    <div class="footer">
        <p>Created by Tacaly <a href="https://tacaly.com/">link</a></p>
    </div>
</body>
</html>
';


class ciInstaller{
    static public function downloadFile ($url, $path) {
        $newfname = $path;
        $rs = file_get_contents($url);
        if($rs) $rs = file_put_contents($newfname,$rs);
        return $rs;
    }
    static public function moveFiles($src, $dest) {
        $path = realpath($src);
        $dest = realpath($dest);
        $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
        foreach($objects as $name => $object) {
            $startsAt = substr(dirname($name), strlen($path));
            self::mmkDir($dest.$startsAt);
            if ( $object->isDir() ) {
                self::mmkDir($dest.substr($name, strlen($path)));
            }

            if(is_writable($dest.$startsAt) && $object->isFile()) {
                rename((string)$name, $dest.$startsAt.'/'.basename($name));
            }
        }
    }
    static public function mmkDir($folder, $perm=0777) {
        if(!is_dir($folder)) {
            mkdir($folder, $perm);
        }
    }
    static public function doInstall() {
        
        $InstallData = SELF::getPackageInfo();
        
        if (empty($_GET['ci']) || !is_scalar($_GET['ci']) || !isset($InstallData[$_GET['ci']])) return;
        
        $rowInstall = $InstallData[$_GET['ci']];
        $base_dir = str_replace('\\','/',__DIR__);
        $temp_dir = str_replace('\\','/',__DIR__).'/_temp'.md5(time());
        //run unzip and install
        SELF::downloadFile($rowInstall['link'] ,'ci.zip');
        $zip = new ZipArchive;
        $res = $zip->open($base_dir.'/ci.zip');
        $zip->extractTo($temp_dir);
        $zip->close();
        unlink($base_dir.'/ci.zip');
        
        if ($handle = opendir($temp_dir)) {
            while (false !== ($name = readdir($handle))) {
                if ($name != '.' && $name != '..') $dir = $name;
            }
            closedir($handle);
        }
        
        SELF::moveFiles($temp_dir.'/'.$dir, $base_dir.'/');
        SELF::rmdirs($temp_dir);
        unlink(__FILE__);
        header('Location: '.$rowInstall['location']);
        exit;
    }
    static public function rmdirs($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object) && !is_link($dir."/".$object))
                        self::rmdirs($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            rmdir($dir);
        }
    }
    static public function getPackageInfo() {
        return array(
            '1.2.0' => array(
                'tree' => 'Cimple',
                'name' => 'Cimple CMS 1.2.0',
                'link' => 'https://github.com/ylacat/Cimple/archive/1.2.0.zip',
                'location' =>'install/index.php'
            ),
            '1.1.x' => array(
                'tree' => 'Cimple',
                'name' => 'Cimple CMS (1.4.x develop version)',
                'link' => 'https://github.com/ylacat/Cimple/archive/1.4.x.zip',
                'location' => 'install/index.php'
            ),
        );
    }
    static public function hasDirPerm() {
        
        $s = basename(__FILE__);
        $r = __DIR__.'/_index_tmp.php';
        if ($s !== 'install.php') return false;
        if (!@ copy(__FILE__,$r)) return false;
        if (!@ unlink(__FILE__))  return false;
        if (!@ copy($r,__FILE__)) return false;
        if (!@ unlink($r))        return false;
    
        return  true;
    }
}