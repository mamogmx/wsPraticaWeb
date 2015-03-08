<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ws
 *
 * @author mamo
 */
class ws {
    static $pratica;
    static $dbh;
    static $result;
    static $projectParams;
    static $allegatiDir;
    static $baseDir;
    const schema = "pe";
    const debugDir = "../debug/";
    
    function __construct($dsn,$pr=NULL) {
        self::$dbh = new PDO($dsn);
        self::$result = Array("success"=>NULL,"message"=>NULL,"id"=>NULL,"time"=>NULL);
        self::$pratica=$pr;
        self::init();
    }
    function __destruct() {
        
    }
    function init(){
        
    }
    static function setDirAllegati($pr){
        
    }
    static function makeDir($dir){
        $arrDir = explode(DIRECTORY_SEPARATOR,$dir);
        $dirAllegati = array_pop($arrDir);
        $dirPratica = array_pop($arrDir);
        $dirAnno = array_pop($arrDir);
        if (!is_dir(self::$baseDir.$dirAnno)) mkdir(self::$baseDir.$dirAnno);
        if (!is_dir(self::$baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica)) mkdir(self::$baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica);
        if (!is_dir(self::$baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica.DIRECTORY_SEPARATOR.$dirAllegati)) mkdir(self::$baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica.DIRECTORY_SEPARATOR.$dirAllegati);
        
        
        
    }
    static function createDirAllegati(){
        if (self::$allegatiDir){
            self::makeDir(self::$allegatiDir);
        }
        elseif(self::$pratica){
            self::setDirAllegati(self::$pratica);
            self::makeDir(self::$allegatiDir);
        }
        else{
            
        }
    }
    static function aggiungiPratica($d){
        $table = "avvioproc";
        $tstart=  microtime();
        $params = self::$projectParams[$table]["params"];
        foreach($params as $key){
            $data[$key]=($d[$key])?($d[$key]):(null);
        }
        
        $sql = self::createQuery(self::$projectParams[$table]["table"]);
        $res = self::execInsQuery($sql, $data,self::$projectParams[$table]["sequence"]);
        if ($res["success"]){
            self::$result["success"] = 1;
            self::$result["id"] = $res["id"];  
            self::$result["message"] = "OK";
        }
        else{
            self::$result["success"] = 0; 
            self::$result["message"] = $res["errors"];
        }
        self::$result["time"]=  microtime() - $tstart;
        return self::$result;
    }
    static function aggiungiRecord($pr,$d,$table){
        $tstart=  microtime();
        $params = self::$projectParams[$table]["params"];
        foreach($params as $key){
            $data[$key]=($d[$key])?($d[$key]):(null);
        }
        $data["pratica"] = $pr;
        
        $sql = self::createQuery(self::$projectParams[$table]["table"]);
        $res = self::execInsQuery($sql, $data,self::$projectParams[$table]["sequence"]);
        if ($res["success"]){
            self::$result["success"] = 1;
            self::$result["id"] = $res["id"];  
            self::$result["message"] = "OK";
        }
        else{
            self::$result["success"] = 0; 
            self::$result["message"] = $res["errors"];
        }
        self::$result["time"]=  microtime() - $tstart;
        return self::$result;
    }
    
    public function aggiungiAllegato($pr,$d){
        
    }
    static function elencoTipiPratica(){
        $res = self::execSelQuery("e_tipopratica", NULL, 1);
        $result=Array();
        if($res["success"]){
            foreach($res["result"] as $k=>$v){
                $result[]=Array("value"=>$v["id"],"label"=>$v["nome"]);
            }
        }
        return $result;
    }
    static function elencoAllegati(){
        $res = self::execSelQuery("e_tipopratica", NULL, 1);
        $result=Array();
        if($res["success"]){
            foreach($res["result"] as $k=>$v){
                $label=($v["descrizione"])?($v["descrizione"]):($v["nome"]);
                if ($v["online"]) $result[]=Array("value"=>$v["id"],"label"=>$label);
            }
        }
        return $result;
    }
    static function rand_str($length = 8, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'){
        // Length of character list
        $chars_length = (strlen($chars) - 1);

        // Start our string
        $string = $chars{rand(0, $chars_length)};

        // Generate random string
        for ($i = 1; $i < $length; $i = strlen($string))
        {
            // Grab a random character from our list
            $r = $chars{rand(0, $chars_length)};

            // Make sure the same two characters don't appear next to each other
            if ($r != $string{$i - 1}) $string .=  $r;
        }

        // Return the string
        return $string;
    }
    static function now(){
        return date('d/m/Y h:i:s', time());
    }
    static function debug($file,$data,$mode='a+'){
        $now=self::now();
        $f=fopen($file,$mode);
	ob_start();
        echo "------- DEBUG DEL $now -------\n";
	print_r($data);
	$result=ob_get_contents();
	ob_end_clean();
	fwrite($f,$result."\n-------------------------\n");
	fclose($f);
    }
    static function createQuery($table){
        foreach(self::$projectParams["table"]["fields"] as $f){
            $keys[]=$f;
            $values[]=":$f";
        }
        $sql = "INSERT INTO %s.%s(%s) VALUES(%s)";
        $sql = sprintf($sql,self::schema,$table,implode(",",$keys),implode(",",$values));
        return $sql;    
        
    }
    static function execInsQuery($sql,$prms,$seq=""){
        $stmt = self::$dbh->prepare($sql);
        if (!$stmt->execute($prms)){
            $errors=$stmt->errorInfo();
            self::debug(utils::debugDir."error-SQL.debug", $errors);
            return Array("success" => 0,"errors" => $errors[2], "pk" => NULL);
        }
        else{
            $id = NULL;
            if ($seq){
                $id = self::$dbh->lastInsertId($seq);
            }
            return Array("success" => 1,"errors" => NULL, "pk" => $id);
            
        }
    }
    static function execSelQuery($table,$v,$mode=0,$schema=self::schema){
        if (!$mode){
            $sql = sprintf("SELECT * FROM %s.%s WHERE id=?;",$schema,$table,$v);
            
        } 
        else{
            if ($v){
                $sql = sprintf("SELECT * FROM %s.%s WHERE pratica=?;",$schema,$table,$v);
            }
            else{
                $sql = sprintf("SELECT * FROM %s.%s;",$schema,$table);
            }
        }
        $stmt = self::$dbh->prepare($sql);
        if($stmt->execute()){
            $res = (!$mode)?($stmt->fetch(PDO::FETCH_ASSOC)):($stmt->fetchAll(PDO::FETCH_ASSOC));
            return Array("success"=>1,"result"=>$res);
        }
        else{
            return Array("success"=>0,"result"=>NULL);
        }
    }
}
