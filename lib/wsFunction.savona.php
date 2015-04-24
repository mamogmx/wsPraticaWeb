<?php
require_once "../config/savona.config.php";
require_once DIR."lib/utils.php";

$dbh=new PDO(DSN);
$schema="iol";

function aggiungiPratica($procedimento,$indirizzi=[]){
    $dbh=new PDO(DSN);
    $schema="pe";
    $params = Array("tipo","intervento","oggetto","note","data_presentazione","protocollo","data_prot","resp_proc","online");
    //$data = Array("tipo"=>$tipo,"intervento"=>$intervento,"oggetto"=>$oggetto,"note"=>$note,"data_presentazione"=>$data_pres,"protocollo"=>$prot,"data_prot"=>$data_prot,"resp_proc"=>$resp_proc);
    foreach($params as $key){
        $data[$key]=($procedimento[$key])?($procedimento[$key]):(null);
    }
    
    utils::debug(utils::debugDir."aggiungiPratica.debug", $data);
    utils::debug(utils::debugDir."Indirizzi.debug", $indirizzi);

    $result=Array();
    $sql="INSERT INTO $schema.avvioproc(tipo,intervento,oggetto,note,data_presentazione,protocollo,data_prot,resp_proc,online) values(:tipo,:intervento,:oggetto,:note,:data_presentazione,:protocollo,:data_prot,:resp_proc,:online)";
    //$dbh->beginTransaction();
    $stmt=$dbh->prepare($sql);
   
    if (!$stmt->execute($data)){
        $errors=$stmt->errorInfo();
        utils::debug(utils::debugDir."error-aggiungiPratica.debug", $errors);
    }
    else{
        $pratica=$dbh->lastInsertId("pe.avvioproc_id_seq");
        //$sql="UPDATE pe.avvioproc SET pratica=id WHERE id =$pratica;";
        //$dbh->query($sql);
        
        $sql="SELECT * FROM pe.avvioproc WHERE pratica=:pratica";
        
        $stmt=$dbh->prepare($sql);
        
        $stmt->execute(Array("pratica"=>$pratica));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $numero_pratica = $res["numero"];
    }
    for($i=0;$i<count($indirizzi);$i++){
        $res=aggiungiIndirizzo($pratica,$indirizzi[$i]);
    }
    
    
    if ($errors){
        //$dbh->rollBack();
        $result=Array("success"=>"-1","message"=>$errors[2]);
    }
    else{
        //$dbh->commit();
        $result = Array("success"=>1,"message"=>"OK","pratica"=>$pratica,"numero_pratica"=>$numero_pratica);
    }
    return $result;
}
function aggiornaPratica($pratica,$tipo,$intervento,$oggetto,$note,$destinazione_uso){
    $result=Array();
    return $result;
}
/*----------------------------------------------------------------------------*/
/*             SOGGETTI                                                       */
/*----------------------------------------------------------------------------*/

function aggiungiSoggetto($pratica,$soggetto){
    $dbh=new PDO(DSN);
    $schema="pe";
    $result=Array();
    $soggetto["pratica"]=$pratica;
    $sql="INSERT INTO $schema.soggetti(pratica,albo,albonumero,alboprov,app,cap,capd,ccia,cciaprov,cedile,cedileprov,codfis,cognome,collaudatore,collaudatore_ca,comunato,comune,comuned,comunicazioni,concessionario,datanato,denunciante,direttore,economia_diretta,email,esecutore,geologo,idsogge,inail,inailprov,indirizzo,inps,inpsprov,nome,note,pec,piva,progettista,progettista_ca,proprietario,prov,provd,provnato,ragsoc,resp_abuso,richiedente,sede,sesso,sicurezza,telefono,titolo,titolod,titolod_note,titolo_note,voltura) VALUES(:pratica,:albo,:albonumero,:alboprov,:app,:cap,:capd,:ccia,:cciaprov,:cedile,:cedileprov,:codfis,:cognome,:collaudatore,:collaudatore_ca,:comunato,:comune,:comuned,:comunicazioni,:concessionario,:datanato,:denunciante,:direttore,:economia_diretta,:email,:esecutore,:geologo,:idsogge,:inail,:inailprov,:indirizzo,:inps,:inpsprov,:nome,:note,:pec,:piva,:progettista,:progettista_ca,:proprietario,:prov,:provd,:provnato,:ragsoc,:resp_abuso,:richiedente,:sede,:sesso,:sicurezza,:telefono,:titolo,:titolod,:titolod_note,:titolo_note,:voltura);";
    $stmt=$dbh->prepare($sql);
    if (!$stmt->execute($soggetto))
        $errors=$stmt->errorInfo();
    else{
        $idsoggetto=$dbh->lastInsertId("pe.soggetti_id_seq");
    }
    if ($errors){
        //$dbh->rollBack();
        $result=Array("success"=>"-1","message"=>$errors[2]);
    }
    else{
        
        
        //$dbh->commit();
        $result = Array("success"=>1,"message"=>"OK","idsoggetto"=>$idsoggetto);
    }
    return $result;
}
function aggiornaSoggetto($pratica,$soggetto){
    $result=Array();
    return $result;
}
function volturaSoggetto($pratica,$soggetto){
    $result=Array();
    return $result;
}
function rimuoviSoggetto($pratica,$soggetto){
    $result=Array();
    return $result;
}
/*----------------------------------------------------------------------------*/
/*              CATATSTO RERRENI                                              */
/*----------------------------------------------------------------------------*/

function aggiungiCatastoTerreni($pratica,$ct){
    $dbh=new PDO(DSN);
    $schema="pe";
    $params = Array("foglio","mappale");
    foreach($params as $key){
        $data[$key]=($ct[$key])?($ct[$key]):(null);
    }
    $data["pratica"]=$pratica;
    utils::debug(utils::debugDir."aggiungiTerreni.debug", $ct);
    $result=Array();
    $sql="INSERT INTO $schema.cterreni(pratica,foglio,mappale) VALUES(:pratica,:foglio,:mappale);";
    $stmt=$dbh->prepare($sql);
   
    if (!$stmt->execute($data)){
        $errors=$stmt->errorInfo();
        utils::debug(utils::debugDir."error-aggiungiTerreni.debug", $errors);
    }
    else{
        $idpartic=$dbh->lastInsertId("pe.cterreni_id_seq");
    }
    
    if ($errors){
        //$dbh->rollBack();
        $result=Array("success"=>"-1","message"=>$errors[2]);
    }
    else{
        $result = Array("success"=>1,"message"=>"OK","idpartic"=>$idpartic);
    }
    return $result;
}
function rimuoviParticellaTerreni($pratica,$particella_terreni){
    $result=Array();
    return $result;
}
/*----------------------------------------------------------------------------*/
/*                 CATASTO URBANO                                             */
/*----------------------------------------------------------------------------*/

function aggiungiCatastoUrbano($pratica,$ct){
    $dbh=new PDO(DSN);
    $schema="pe";
    $params = Array("foglio","mappale","sub");
    foreach($params as $key){
        $data[$key]=($ct[$key])?($ct[$key]):(null);
    }
    $data["pratica"]=$pratica;
    utils::debug(utils::debugDir."aggiungiTerreni.debug", $data);
    $result=Array();
    $sql="INSERT INTO $schema.curbano(pratica,foglio,mappale,sub) VALUES(:pratica,:foglio,:mappale,:sub);";
    $stmt=$dbh->prepare($sql);
   
    if (!$stmt->execute($data)){
        $errors=$stmt->errorInfo();
        utils::debug(utils::debugDir."error-aggiungiUrbano.debug", $errors);
    }
    else{
        $idpartic=$dbh->lastInsertId("pe.curbano_id_seq");
    }
    
    if ($errors){
        //$dbh->rollBack();
        $result=Array("success"=>"-1","message"=>$errors[2]);
    }
    else{
        $result = Array("success"=>1,"message"=>"OK","idpartic"=>$idpartic);
    }
    return $result;
}

function rimuoviParticellaUrbano($pratica,$particella_urbano){
    $result=Array();
    return $result;
}
/*----------------------------------------------------------------------------*/
/*                    INDIRIZZI                                               */
/*----------------------------------------------------------------------------*/
function aggiungiIndirizzo($pratica,$indirizzo){
    $dbh=new PDO(DSN);
    $schema="pe";
    $params = Array("via","civico","interno");
    foreach($params as $key){
        $data[$key]=($indirizzo[$key])?($indirizzo[$key]):(null);
    }
    $data["pratica"]=$pratica;
    utils::debug(utils::debugDir."aggiungiIndirizzo.debug", $data);
    $result=Array();
    $sql="INSERT INTO $schema.indirizzi(pratica,civico,interno,via) VALUES(:pratica,:civico,:interno,:via);";
    $stmt=$dbh->prepare($sql);
   
    if (!$stmt->execute($data)){
        $errors=$stmt->errorInfo();
        utils::debug(utils::debugDir."error-aggiungiIndirizzo.debug", $errors);
    }
    else{
        $idindirizzo=$dbh->lastInsertId("pe.soggetti_id_seq");
    }
    
    if ($errors){
        //$dbh->rollBack();
        $result=Array("success"=>"-1","message"=>$errors[2]);
    }
    else{
        $result = Array("success"=>1,"message"=>"OK","indirizzo"=>$idindirizzo);
    }
    return $result;
}
function rimuoviIndirizzo($pratica,$indirizzo){
    $result=Array();
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    ALLEGATI                                                */
/*----------------------------------------------------------------------------*/

function aggiungiAllegato($pratica,$documento){
    
}

?>

