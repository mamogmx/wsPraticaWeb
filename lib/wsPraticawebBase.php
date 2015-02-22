<?php
require_once DIR."lib/nusoap/nusoap.php";
require_once DIR.'lib/utils.php';

$dbh=new PDO(DSN);
$schema="iol";
$server = new nusoap_server; 
$server->soap_defencoding = 'UTF-8';
$server->configureWSDL('praticaweb', 'http://webservice.gisweb.it/wspraticaweb/savona.wsPraticaweb.php?wsdl');


$server->wsdl->addSimpleType('tipopratica','xsd:string','SimpleType','scalar',array_keys($tipoPratica));
$server->wsdl->addSimpleType('tipointervento','xsd:string','SimpleType','scalar',array_keys($tipoIntervento));

$server->wsdl->addComplexType('procedimento','complexType','struct','all','',Array(
    "anno" => Array("name"=>"anno","type"=>"xsd:int"),
    "aut_amb" => Array("name"=>"aut_amb","type"=>"xsd:string"),
    "cartella" => Array("name"=>"cartella","type"=>"xsd:string"),
    "categoria" => Array("name"=>"categoria","type"=>"xsd:string"),
    "com_resp" => Array("name"=>"com_resp","type"=>"xsd:string"),
    "data_chiusura" => Array("name"=>"data_chiusura","type"=>"xsd:string"),
    "data_chiusura_pa" => Array("name"=>"data_chiusura_pa","type"=>"xsd:string"),
    "data_com_resp" => Array("name"=>"data_com_resp","type"=>"xsd:string"),
    "data_presentazione" => Array("name"=>"data_presentazione","type"=>"xsd:string"),
    "data_prot" => Array("name"=>"data_prot","type"=>"xsd:string"),
    "data_prot_int" => Array("name"=>"data_prot_int","type"=>"xsd:string"),
    "data_resp" => Array("name"=>"data_resp","type"=>"xsd:string"),
    "data_resp_ia" => Array("name"=>"data_resp_ia","type"=>"xsd:string"),
    "data_resp_it" => Array("name"=>"data_resp_it","type"=>"xsd:string"),
    "diritti_segreteria" => Array("name"=>"diritti_segreteria","type"=>"xsd:string"),
    "intervento" => Array("name"=>"intervento","type"=>"xsd:string"),
    "note" => Array("name"=>"note","type"=>"xsd:string"),
    "note_chiusura" => Array("name"=>"note_chiusura","type"=>"xsd:string"),
    "note_chiusura_pa" => Array("name"=>"note_chiusura_pa","type"=>"xsd:string"),
    "numero" => Array("name"=>"numero","type"=>"xsd:string"),
    "oggetto" => Array("name"=>"oggetto","type"=>"xsd:string"),
    "online" => Array("name"=>"online","type"=>"xsd:string"),
    "pagamento_diritti" => Array("name"=>"pagamento_diritti","type"=>"xsd:string"),
    "pratica" => Array("name"=>"pratica","type"=>"xsd:string"),
    "prog" => Array("name"=>"prog","type"=>"xsd:string"),
    "protocollo" => Array("name"=>"protocollo","type"=>"xsd:string"),
    "protocollo_int" => Array("name"=>"protocollo_int","type"=>"xsd:string"),
    "resp_ia" => Array("name"=>"resp_ia","type"=>"xsd:string"),
    "resp_it" => Array("name"=>"resp_it","type"=>"xsd:string"),
    "resp_proc" => Array("name"=>"resp_proc","type"=>"xsd:string"),
    "riduzione_diritti" => Array("name"=>"riduzione_diritti","type"=>"xsd:string"),
    "rif_aut_amb" => Array("name"=>"rif_aut_amb","type"=>"xsd:string"),
    "riferimento" => Array("name"=>"riferimento","type"=>"xsd:string"),
    "riferimento_to" => Array("name"=>"riferimento_to","type"=>"xsd:string"),
    "rif_pratica" => Array("name"=>"rif_pratica","type"=>"xsd:string"),
    "tipo" => Array("name"=>"tipo","type"=>"xsd:string")
));



$server->wsdl->addComplexType('soggetto','complexType','struct','all','',Array(
    "albo"=>Array("name"=>"albo","type"=>"xsd:string"),
    "albonumero"=>Array("name"=>"albonumero","type"=>"xsd:string"),
    "alboprov"=>Array("name"=>"alboprov","type"=>"xsd:string"),
    "app"=>Array("name"=>"app","type"=>"xsd:string"),
    "cap"=>Array("name"=>"cap","type"=>"xsd:string"),
    "capd"=>Array("name"=>"capd","type"=>"xsd:string"),
    "ccia"=>Array("name"=>"ccia","type"=>"xsd:string"),
    "cciaprov"=>Array("name"=>"cciaprov","type"=>"xsd:string"),
    "cedile"=>Array("name"=>"cedile","type"=>"xsd:string"),
    "cedileprov"=>Array("name"=>"cedileprov","type"=>"xsd:string"),
    "codfis"=>Array("name"=>"codfis","type"=>"xsd:string"),
    "cognome"=>Array("name"=>"cognome","type"=>"xsd:string"),
    "collaudatore"=>Array("name"=>"collaudatore","type"=>"xsd:int"),
    "collaudatore_ca"=>Array("name"=>"collaudatore_ca","type"=>"xsd:int"),
    "comunato"=>Array("name"=>"comunato","type"=>"xsd:string"),
    "comune"=>Array("name"=>"comune","type"=>"xsd:string"),
    "comuned"=>Array("name"=>"comuned","type"=>"xsd:string"),
    "comunicazioni"=>Array("name"=>"comunicazioni","type"=>"xsd:int"),
    "concessionario"=>Array("name"=>"concessionario","type"=>"xsd:int"),
    "datanato"=>Array("name"=>"datanato","type"=>"xsd:date"),
    "direttore"=>Array("name"=>"direttore","type"=>"xsd:boolean"),
    "economia_diretta"=>Array("name"=>"economia_diretta","type"=>"xsd:boolean"),
    "email"=>Array("name"=>"email","type"=>"xsd:string"),
    "esecutore"=>Array("name"=>"esecutore","type"=>"xsd:boolean"),
    "geologo"=>Array("name"=>"geologo","type"=>"xsd:boolean"),
    "inail"=>Array("name"=>"inail","type"=>"xsd:string"),
    "inailprov"=>Array("name"=>"inailprov","type"=>"xsd:string"),
    "indirizzo"=>Array("name"=>"indirizzo","type"=>"xsd:string"),
    "inps"=>Array("name"=>"inps","type"=>"xsd:string"),
    "inpsprov"=>Array("name"=>"inpsprov","type"=>"xsd:string"),
    "nome"=>Array("name"=>"nome","type"=>"xsd:string"),
    "note"=>Array("name"=>"note","type"=>"xsd:string"),
    "pec"=>Array("name"=>"pec","type"=>"xsd:string"),
    "piva"=>Array("name"=>"piva","type"=>"xsd:string"),
    "progettista"=>Array("name"=>"progettista","type"=>"xsd:boolean"),
    "progettista_ca"=>Array("name"=>"Progettista Cementi Armati","type"=>"xsd:boolean"),
    "proprietario"=>Array("name"=>"proprietario","type"=>"xsd:boolean"),
    "prov"=>Array("name"=>"prov","type"=>"xsd:string"),
    "provd"=>Array("name"=>"provd","type"=>"xsd:string"),
    "provnato"=>Array("name"=>"provnato","type"=>"xsd:string"),
    "ragsoc"=>Array("name"=>"ragsoc","type"=>"xsd:string"),
    "richiedente"=>Array("name"=>"richiedente","type"=>"xsd:int"),
    "sede"=>Array("name"=>"sede","type"=>"xsd:string"),
    "sesso"=>Array("name"=>"sesso","type"=>"xsd:string"),
    "sicurezza"=>Array("name"=>"sicurezza","type"=>"xsd:boolean"),
    "telefono"=>Array("name"=>"telefono","type"=>"xsd:string"),
    "titolo"=>Array("name"=>"titolo","type"=>"xsd:string"),
    "titolo_note"=>Array("name"=>"titolo_note","type"=>"xsd:string"),
    "titolod"=>Array("name"=>"titolod","type"=>"xsd:string"),
    "titolod_note"=>Array("name"=>"titolod_note","type"=>"xsd:string"),
    "voltura"=>Array("name"=>"voltura","type"=>"xsd:boolean")
    )
);

$server->wsdl->addComplexType('particella','complexType','struct','all','',Array(
        "sezione"=>Array("name"=>"sezione","type"=>"xsd:string"),
        "foglio"=>Array("name"=>"foglio","type"=>"xsd:string"),
        "mappale"=>Array("name"=>"mappale","type"=>"xsd:string"),
        "sub"=>Array("name"=>"sub","type"=>"xsd:string")
    )
);
$server->wsdl->addComplexType('indirizzo','complexType','struct','all','',Array(
        "via"=>Array("name"=>"via","type"=>"xsd:string"),
        "civico"=>Array("name"=>"civico","type"=>"xsd:string"),
        "interno"=>Array("name"=>"interno","type"=>"xsd:string")
        
    )
);

$server->wsdl->addComplexType('indirizzi','complexType','array','all','',Array("indirizzo"=>Array("name"=>"indirizzo","type"=>"tns:indirizzo")));
$server->wsdl->addComplexType('soggetti','simpleType','array','all','',Array("soggetti"=>Array("name"=>"soggetto","type"=>"tns:soggetto")));
$server->wsdl->addComplexType('particelleterreni','simpleType','array','all','',Array("particella"=>Array("name"=>"particella","type"=>"tns:particella")));
$server->wsdl->addComplexType('particelleurbano','simpleType','array','all','',Array("particella"=>Array("name"=>"particella","type"=>"tns:particella")));


$server->wsdl->schemaTargetNamespace = 'urn:praticaweb';



$server->register('aggiungiPratica',
    Array(
        "procedimento"=>"tns:procedimento",
        "indirizzi"=>"tns:indirizzi"
        
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "pratica"=>"xsd:int",
        "numero_pratica"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addPratica',
    'rpc',
    'encoded',
    'Metodo che aggiunge una istanza di pratica edilizia al software Praticaweb 2.0,restituisce la chiave primaria della pratica'
);

$server->register('aggiungiSoggetto',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tns:soggetto"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "idsoggetto"=>"xsd:int"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addSoggetto',
    'rpc',
    'encoded',
    'Metodo che aggiunge un soggetto ad pratica edilizia al software Praticaweb 2.0'
);
$server->register('aggiungiIndirizzo',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tns:indirizzo"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "idindirizzo"=>"xsd:int"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addIndirizzo',
    'rpc',
    'encoded',
    'Metodo che aggiunge un indirizzo ad pratica edilizia al software Praticaweb 2.0'
);
$server->register('aggiungiCatastoUrbano',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tns:particella"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "idpartic"=>"xsd:int"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addCatastoUrbano',
    'rpc',
    'encoded',
    'Metodo che aggiunge un CU ad pratica edilizia al software Praticaweb 2.0'
);
$server->register('aggiungiCatastoTerreni',
    Array(
        "pratica"=>"xsd:int",
        "soggetto"=>"tns:particella"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "idiparticella"=>"xsd:int"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addCatastoTerreni',
    'rpc',
    'encoded',
    'Metodo che aggiunge un CT ad pratica edilizia al software Praticaweb 2.0'
);
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
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>