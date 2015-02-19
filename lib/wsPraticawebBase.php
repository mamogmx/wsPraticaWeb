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
/*
$server->addComplexType('procedimento','complexType','struct','all','',Array(
    "tipo"=>Array("name"=>"tipo","type"=>"tns:tipopratica"),
    "intervento"=>Array("name"=>"tipo","type"=>"tns:tipointervento"),
    
));*/

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
        "sezione"=>Array("name"=>"via","type"=>"xsd:string"),
        "foglio"=>Array("name"=>"civico","type"=>"xsd:string"),
        "mappale"=>Array("name"=>"interno","type"=>"xsd:string")
        
    )
);

$server->wsdl->addComplexType('indirizzi','simpleType','array','all','',Array("indirizzo"=>Array("name"=>"indirizzo","type"=>"tns:indirizzo")));
$server->wsdl->addComplexType('soggetti','simpleType','array','all','',Array("soggetti"=>Array("name"=>"soggetto","type"=>"tns:soggetto")));
$server->wsdl->addComplexType('particelleterreni','simpleType','array','all','',Array("particella"=>Array("name"=>"particella","type"=>"tns:particella")));
$server->wsdl->addComplexType('particelleurbano','simpleType','array','all','',Array("particella"=>Array("name"=>"particella","type"=>"tns:particella")));


$server->wsdl->schemaTargetNamespace = 'urn:praticaweb';



$server->register('aggiungiPratica',
    Array(
        "tipo"=>"tns:tipopratica",
        "intervento"=>"tns:tipointervento",
        "oggetto"=>"xsd:string",
        "note"=>"xsd:string",
        "data_presentazione"=>"xsd:string",
        "numero_protocollo"=>"xsd:string",
        "data_protocollo"=>"xsd:string",
        "responsabile_procedimento"=>"xsd:string"
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

function aggiungiPratica($tipo,$intervento,$oggetto,$note,$data_pres,$prot,$data_prot,$resp_proc){
    $dbh=new PDO(DSN);
    $schema="pe";
    $data = Array("tipo"=>$tipo,"intervento"=>$intervento,"oggetto"=>$oggetto,"note"=>$note,"data_presentazione"=>$data_pres,"protocollo"=>$prot,"data_prot"=>$data_prot,"resp_proc"=>$resp_proc);
    
    utils::debug(utils::debugDir."aggiungiPratica.debug", $data);
    $result=Array();
    $sql="INSERT INTO $schema.avvioproc(tipo,intervento,oggetto,note,data_presentazione,protocollo,data_prot,resp_proc) values(:tipo,:intervento,:oggetto,:note,:data_presentazione,:protocollo,:data_prot,:resp_proc)";
    //$dbh->beginTransaction();
    $stmt=$dbh->prepare($sql);
   
    if (!$stmt->execute($data))
        $errors=$stmt->errorInfo();
    else{
        $pratica=$dbh->lastInsertId("pe.avvioproc_id_seq");
        $sql="UPDATE pe.avvioproc SET pratica=id WHERE id =$pratica;";
        $dbh->query($sql);
        
        $sql="SELECT * FROM pe.avvioproc WHERE pratica=:pratica";
        
        $stmt=$dbh->prepare($sql);
        
        $stmt->execute(Array("pratica"=>$pratica));
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    /*for($i=0;$i<count($soggetti);$i++){
        $res=aggiungiSoggetto($pratica,$soggetti[$i]);
    }*/
    
    
    if ($errors){
        //$dbh->rollBack();
        $result=Array("success"=>"-1","message"=>$errors[2]);
    }
    else{
        
        
        //$dbh->commit();
        $result = Array("success"=>1,"message"=>"OK","pratica"=>$pratica,"numero_pratica"=>$res["numero"]);
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
function aggiungiParticellaTerreni($pratica,$particella_terreni){
    $result=Array();
    $sql="INSERT INTO $schema.cterreni(foglio,mappale,sezione,sub) VALUES(:foglio,:mappale,:sezione,:sub);";
    return $result;
}
function rimuoviParticellaTerreni($pratica,$particella_terreni){
    $result=Array();
    return $result;
}
function aggiungiParticellaUrbano($pratica,$particella_urbano){
    $result=Array();
    $sql="INSERT INTO $schema.cterreni(foglio,mappale,sezione,sub) VALUES(:foglio,:mappale,:sezione,:sub);";
    return $result;
}
function rimuoviParticellaUrbano($pratica,$particella_urbano){
    $result=Array();
    return $result;
}
function aggiungiIndirizzo($pratica,$indirizzo){
    $result=Array();
    $sql="INSERT INTO $schema.indirizzi(civico,interno,via) VALUES(:civico,:interno,:via);";
    return $result;
}
function rimuoviIndirizzo($pratica,$indirizzo){
    $result=Array();
    return $result;
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>