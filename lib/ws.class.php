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
        $this->pratica = $pr;
        
        
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
        
        $params = $this->projectParams[$table]["params"];
        foreach($params as $key){
            $data[$key]=($d[$key])?($d[$key]):(null);
        }
        
        $sql = $this->createQuery($this->projectParams[$table]["table"]);
        $res = $this->execInsQuery($sql, $data,$this->projectParams[$table]["sequence"]);
        if ($res["success"]){
            $pr = $this->execSelQuery("avvioproc", $res["id"], 0);
            $this->debug($this->debugDir."RESULT.debug",$pr);
            $this->result["success"] = 1;
            $this->result["id"] = $res["id"];  
            $this->result["numero"] = $pr["result"]["numero"];
            $this->result["message"] = "OK";
        }
        else{
            $this->result["success"] = 0; 
            $this->result["messages"] = $res["error"];
        }
        $this->result["time"]=  microtime() - $tstart;
        return $this->result;
    }
    function aggiungiRecord($pr,$d,$table){
        $tstart=  microtime();
        //$this->debug($this->debugDir.strtoupper($table).".debug", $d);
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
            $this->result["error"] = NULL;
        }
        else{
            $this->result["success"] = 0; 
            $this->result["message"] = NULL;
            $this->result["error"] = $res["message"];
            $this->result["id"] = NULL;
        }
        $this->result["time"]=  microtime() - $tstart;
        return $this->result;
    }
    
    public function aggiungiAllegato($pr,$d){
        $r = $this->aggiungiRecord($pr,$d,"allegati");
        if($r["id"]){
            $fAllegati=$d["files"];
            $result = Array(
                "success"=>1,
                "errors" => Array(),
                "messages" => Array(),
                "id" => $r["id"],
                "cont" => 0,
                "err" => 0
            );
            $cont = $err = 0;
            for($i=0;$i<count($fAllegati);$i++){
                $allegato = $fAllegati[$i];
                $allegato["allegato"] = $r["id"];
                $r1=$this->aggiungiRecord($pr,$allegato,"file_allegati");
                if($r1["success"]){
                    $text = $allegato["file"];
                    $dir = $this->allegatiDir.DIRECTORY_SEPARATOR;
                    
                    $f =  fopen($dir.$allegato["nome_file"], 'w');
                    if (!fwrite($f,  $text)){
                        $err += 1;
                        $err_message = "Impossibili scrivere il file ".$dir.$allegato["nome_file"];
                        $this->debug($this->debugDir."FILE-ERROR.debug", $err_message);
                        $this->result["errors"][] =  $err_message;
                    }
                    else{
                        $cont += 1;
                    }
                    fclose($f);
                }
                else{
                    $err += 1;
                    $result["errors"][] = $r1["error"]; 
                }
            }
        }
        else{
            $result = Array(
                "success"=>0,
                "errors" => Array($r["error"]),
                "messages" => Array(),
                "id" => NULL,
                "cont" => 0,
                "err" => 0
            );
        }
        
        $result["err"] = $err;
        $result["cont"] = $cont;
        $this->debug($this->debugDir."RESULT-ALLEGATO-".$d["documento"].".debug", $result,'w');
        return $result;
    }
    function aggiungiIL($pr,$d){
        $ris = $this->execSelQuery("lavori",$pr,1);
        if(count($ris["result"])==0){
            $result = $this->aggiungiRecord($pr, $d, "lavori");
        }
        else{
            $stmt = $this->dbh->prepare($sql);
            $sql = "UPDATE pe.lavori SET note = trim(coalesce(note,'') ||' '|| ?),il = ? WHERE pratica = ?;";
            if($stmt->execute(Array($note,$d["il"],$pr))){
                $result = Array("success"=>1,"id"=>$ris["result"][0]["id"],"message"=>"");
            }
            else{
                $errors=$stmt->errorInfo();
                $this->debug(utils::debugDir."error-SQL.debug", $errors);
                $result = Array("success"=>0,"id"=>NULL,"message"=>$errors);
            }
        }
        return $result;
    }
    function aggiungiFL($pr,$d){
        $ris = $this->execSelQuery("lavori",$pr,1);
                if(count($ris["result"])==0){
            $result = $this->aggiungiRecord($pr, $d, "lavori");
        }
        else{
            $stmt = $this->dbh->prepare($sql);
            $sql = "UPDATE pe.lavori SET note = trim(coalesce(note,'') ||' '|| ?),fl = ? WHERE pratica = ?;";
            if($stmt->execute(Array($note,$d["fl"],$pr))){
                $result = Array("success"=>1,"id"=>$ris["result"][0]["id"],"message"=>"");
            }
            else{
                $errors=$stmt->errorInfo();
                $this->debug(utils::debugDir."error-SQL.debug", $errors);
                $result = Array("success"=>0,"id"=>NULL,"message"=>$errors);
            }
        }
        return $result;
    }
    function trovaProcedimento($n){
        $sql = "SELECT pratica FROM pe.avvioproc WHERE numero=?;";
        $stmt = $this->dbh->prepare($sql);
        if($stmt->execute(Array($n))){
            $id = $stmt->fetchColumn();
            if ($id)
                return Array("success"=>1,"id"=>$id,"message"=>"");
            else {
                return Array("success"=>1,"id"=>NULL,"message"=>"Nessuna pratica trovata con numero $n");
            }
        }
        else{
            $errors=$stmt->errorInfo();
            $this->debug(utils::debugDir."error-SQL.debug", $errors);
            return Array("success"=>0,"id"=>NULL,"message"=>$errors);
        }
    }
    private function elencoSoggetti($pr,$t=""){
        if (!$t or !in_array($t,Array("richiedente","concessionario","proprietario","direttore","progettista","esecutore")) ){
            $sql = "SELECT * FROM pe.soggetti WHERE pratica = ? AND coalesce(voltura,0)=0";
            $stmt = $this->db->prepare($sql);
            if ($stmt->execute(Array($pr))){
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                $res = Array();
            }
        }
        else{
            $sql = "SELECT * FROM pe.soggetti WHERE pratica = ? AND $t = 1 AND coalesce(voltura,0)=0";
            $stmt = $this->db->prepare($sql);
            if ($stmt->execute(Array($pr))){
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else{
                $res = Array();
            }
        }
        return $res;
    }
    
    function infoProcedimento(){
        $pr = $this->pratica;
        $proc = $this->execSelQuery("avvioproc", $pr, 0);
        //  ----- RICHIEDENTI -----
        $rich = $this->elencoSoggetti($pr, "richiedente");
        //  ----- PROGETTISTI -----
        $prog = $this->elencoSoggetti($pr, "progettista");
        //  ----- DIRETTORE LAVORI ---
        $dirlav = $this->elencoSoggetti($pr, "direttore");
        //  ----  ESECUTORE LAVORI ---
        $esec = $this->elencoSoggetti($pr, "esecutore");
        
        
        if ($proc["success"]){
            return Array(
                "success"=>1,
                "message"=>"",
                "result"=>Array(
                    "procedimento"=>$proc["result"],
                    "richiedenti"=>$rich,
                    "progettisti"=>$prog,
                    "direttore_lavori"=>$dirlav,
                    "esecutori"=>$esec,
                    "catasto_urbano"=>Array(),
                    "catasto_terreni"=>Array(),
                    "indirizzi"=>Array()
                )
            );
        }
        else 
            return Array(
                "success"=>0,
                "message"=>"Errore",
                "result"=>Array()
            );
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
    
    function elencoDestUso(){
        $res = $this->execSelQuery("e_destuso", NULL, 1);
        $result=Array();
        if($res["success"]){
            foreach($res["result"] as $k=>$v){
                $result[]=Array("value"=>$v["id"],"label"=>$v["destuso"]);
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
        foreach($this->projectParams[$table]["fields"] as $f){
            $keys[]=$f;
            $values[]=":$f";
        }
        $keys[] = "tmsins";
        $values[] = ":tmsins"; 
        $keys[] = "uidins";
        $values[] = ":uidins"; 
        $sql = "INSERT INTO %s.%s(%s) VALUES(%s)";
        $sql = sprintf($sql,$this->schema,$table,implode(",",$keys),implode(",",$values));
        return $sql;    
        
    }
    function execInsQuery($sql,$prms,$seq=""){
        $prms = $this->parseData($prms);
        $stmt = $this->dbh->prepare($sql);
        $prms["tmsins"] = time();
        $prms["uidins"] = -1;
        if (!$stmt->execute($prms)){
            $errors=$stmt->errorInfo();
            $this->debug(utils::debugDir."error-SQL.debug", $errors);
            $this->debug(utils::debugDir."error-data-SQL.debug", $prms);
            return Array("success" => 0,"errors" => $errors[2], "id" => NULL);
        }
        else{
            $id = NULL;
            if ($seq){
                $id = $this->dbh->lastInsertId($seq);
            }
            return Array("success" => 1,"errors" => NULL, "id" => $id);
            
        }
    }
    function execSelQuery($table,$v,$mode=0,$schema=''){
        if (!$schema) {
            $schema = $this->schema;
        }
        if (!$mode){
            $sql = sprintf("SELECT * FROM %s.%s WHERE id=%s;",$schema,$table,$v);
            
        } 
        else{
            if ($v){
                $sql = sprintf("SELECT * FROM %s.%s WHERE pratica=%s;",$schema,$table,$v);
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
            $errors=$stmt->errorInfo();
            $this->debug(utils::debugDir."error-SQL.debug", $errors);
            return Array("success"=>0,"result"=>NULL);
        }
    }
    function parseData($d){
        $result = Array();
        foreach($d as $k=>$v){
            if ($v[0]=='"' && $v[-1]=='') $v=  substr ($v, 1, strlen($v)-2);
            if (in_array($k,Array("proprietario","concessionario","richiedente","progettista","direttore","esecutore","sicurezza","collaudatore")) && ($v=='null' || !$v)) $v='0';
	    if ($v =='null') $v = NULL;
            $result[$k] = $v;
        }
        return $result;
    }
}
