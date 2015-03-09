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
    var $pratica;
    var $dbh;
    var $result;
    var $projectParams;
    var $allegatiDir;
    var $baseDir;
    var $schema = "pe";
    var $debugDir = "../debug/";
    
    function __construct($dsn,$pr=NULL) {
        $this->dbh = new PDO($dsn);
        $this->result = Array("success"=>NULL,"message"=>NULL,"id"=>NULL,"time"=>NULL);

        
        
    }
    function __destruct() {
        
    }
    function init(){
        
    }
    function setDirAllegati($pr){
        
    }
    function makeDir($dir){
        $arrDir = explode(DIRECTORY_SEPARATOR,$dir);
        $dirAllegati = array_pop($arrDir);
        $dirPratica = array_pop($arrDir);
        $dirAnno = array_pop($arrDir);
        if (!is_dir($this->baseDir.$dirAnno)) mkdir($this->baseDir.$dirAnno);
        if (!is_dir($this->baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica)) mkdir($this->baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica);
        if (!is_dir($this->baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica.DIRECTORY_SEPARATOR.$dirAllegati)) mkdir($this->baseDir.$dirAnno.DIRECTORY_SEPARATOR.$dirPratica.DIRECTORY_SEPARATOR.$dirAllegati);
        
        
        
    }
    function createDirAllegati(){
        if ($this->allegatiDir){
            $this->makeDir($this->allegatiDir);
        }
        elseif($this->pratica){
            $this->setDirAllegati($this->pratica);
            $this->makeDir($this->allegatiDir);
        }
        else{
            
        }
    }
    function aggiungiPratica($d){
        $table = "avvioproc";
        $tstart=  microtime();
        //self::debug(self::debugDir."PARAMS.debug",self::$projectParams);
        $this->debug($this->debugDir."PROCEDIMENTO.debug",$d);
        $params = $this->projectParams[$table]["params"];
        foreach($params as $key){
            $data[$key]=($d[$key])?($d[$key]):(null);
        }
        
        $sql = $this->createQuery($this->projectParams[$table]["table"]);
        $res = $this->execInsQuery($sql, $data,$this->projectParams[$table]["sequence"]);
        if ($res["success"]){
            $this->result["success"] = 1;
            $this->result["id"] = $res["id"];  
            $this->result["message"] = "OK";
        }
        else{
            $this->result["success"] = 0; 
            $this->result["message"] = $res["errors"];
        }
        $this->result["time"]=  microtime() - $tstart;
        return $this->result;
    }
    function aggiungiRecord($pr,$d,$table){
        $tstart=  microtime();
        $params = $this->projectParams[$table]["params"];
        foreach($params as $key){
            $data[$key]=($d[$key])?($d[$key]):(null);
        }
        $data["pratica"] = $pr;
        
        $sql = $this->createQuery($this->projectParams[$table]["table"]);
        $res = $this->execInsQuery($sql, $data,$this->projectParams[$table]["sequence"]);
        if ($res["success"]){
            $this->result["success"] = 1;
            $this->result["id"] = $res["id"];  
            $this->result["message"] = "OK";
        }
        else{
            $this->result["success"] = 0; 
            $this->result["message"] = $res["errors"];
        }
        $this->result["time"]=  microtime() - $tstart;
        return $this->result;
    }
    
    public function aggiungiAllegato($pr,$d){
        
    }
    function elencoTipiPratica(){
        $res = $this->execSelQuery("e_tipopratica", NULL, 1);
        $result=Array();
        if($res["success"]){
            foreach($res["result"] as $k=>$v){
                $result[]=Array("value"=>$v["id"],"label"=>$v["nome"]);
            }
        }
        return $result;
    }
    
    function elencoVie(){
        $res = $this->execSelQuery("pe_vie", NULL, 1,'civici');
        $result=Array();
        if($res["success"]){
            foreach($res["result"] as $k=>$v){
                $result[]=Array("value"=>$v["id"],"label"=>$v["nome"]);
            }
        }
        return $result;
    }
    
    function elencoAllegati(){
        $res = $this->execSelQuery("e_documenti", NULL, 1);
        $result=Array();
        if($res["success"]){
            foreach($res["result"] as $k=>$v){
                $label=($v["descrizione"])?($v["descrizione"]):($v["nome"]);
                if ($v["online"]) $result[]=Array("value"=>$v["id"],"label"=>$label);
            }
        }
        return $result;
    }
    function rand_str($length = 8, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890'){
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
    function now(){
        return date('d/m/Y h:i:s', time());
    }
    function debug($file,$data,$mode='a+'){
        $now=$this->now();
        $f=fopen($file,$mode);
	ob_start();
        echo "------- DEBUG DEL $now -------\n";
	print_r($data);
	$result=ob_get_contents();
	ob_end_clean();
	fwrite($f,$result."\n-------------------------\n");
	fclose($f);
    }
    function createQuery($table){
        foreach($this->projectParams["table"]["fields"] as $f){
            $keys[]=$f;
            $values[]=":$f";
        }
        $sql = "INSERT INTO %s.%s(%s) VALUES(%s)";
        $sql = sprintf($sql,$this->schema,$table,implode(",",$keys),implode(",",$values));
        return $sql;    
        
    }
    function execInsQuery($sql,$prms,$seq=""){
        $stmt = $this->dbh->prepare($sql);
        if (!$stmt->execute($prms)){
            $errors=$stmt->errorInfo();
            $this->debug(utils::debugDir."error-SQL.debug", $errors);
            return Array("success" => 0,"errors" => $errors[2], "pk" => NULL);
        }
        else{
            $id = NULL;
            if ($seq){
                $id = $this->dbh->lastInsertId($seq);
            }
            return Array("success" => 1,"errors" => NULL, "pk" => $id);
            
        }
    }
    function execSelQuery($table,$v,$mode=0,$schema=''){
        if ($schema) $schema = $this->schema;
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
        $stmt = $this->dbh->prepare($sql);
        if($stmt->execute()){
            $res = (!$mode)?($stmt->fetch(PDO::FETCH_ASSOC)):($stmt->fetchAll(PDO::FETCH_ASSOC));
            return Array("success"=>1,"result"=>$res);
        }
        else{
            return Array("success"=>0,"result"=>NULL);
        }
    }
}
