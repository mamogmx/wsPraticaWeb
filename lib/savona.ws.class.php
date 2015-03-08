<?php

require_once "ws.class.php";
class wsApp extends ws{
    function __construct($dsn,$pr=NULL,$params) {
        self::$dbh = new PDO($dsn);
        self::$result = Array("success"=>NULL,"message"=>NULL,"id"=>NULL,"time"=>NULL);
        self::$pratica=$pr;
        self::$projectParams = $params;
        self::debug(self::debugDir."PARAMETRI.debug",self::$projectParams);
        self::init();
    }
    function init(){
        $dir = Array("data","savona","pe","praticaweb","documenti","pe");
        self::$baseDir = DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,$dir).DIRECTORY_SEPARATOR;
        
        if (self::$pratica){
            self::setDirAllegati(self::$pratica);
        }
    }
    static function setDirAllegati($pr) {
        $arrDir = Array();
        $res=self::execSelQuery("avvioproc", $pr);
        if($res["success"]){
            $info = $res["result"];
            $anno=$info["anno"];
            $protocollo=$info["protocollo"];
            $arrDir[] = $anno;
            $d = sprintf("%s-%s",$protocollo,  substr($anno, 2, 2));
            $arrDir[] = $d;
            $arrDir[] = "allegati";
            $dir = self::$baseDir.implode(DIRECTORY_SEPARATOR,$arrDir);
            self::$allegatiDir = $dir;
        }
        
    }
}
