<?php
require_once DIR."lib/nusoap/nusoap.php";

$server = new nusoap_server; 
$server->soap_defencoding = 'UTF-8';
$server->configureWSDL('praticaweb', 'http://webservice.gisweb.it/wspraticaweb/savona.wsPraticaweb.php?wsdl');

$server->wsdl->addComplexType('elemento','complexType','struct','all','',Array(
    "value"=>Array("name"=>"value","type"=>"xsd:int"),
    "label"=>Array("name"=>"label","type"=>"xsd:string")
));
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
    "cellulare"=>Array("name"=>"cellulare","type"=>"xsd:string"),
    "cittadinanza"=>Array("name"=>"cittadinanza","type"=>"xsd:string"),
    "civico"=>Array("name"=>"civico","type"=>"xsd:string"),
    "civicod"=>Array("name"=>"civicod","type"=>"xsd:string"),
    "codfis"=>Array("name"=>"codfis","type"=>"xsd:string"),
    "codfisd"=>Array("name"=>"codfisd","type"=>"xsd:string"),
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
    "fax"=>Array("name"=>"fax","type"=>"xsd:string"),
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

$server->wsdl->addComplexType('allegato','complexType','struct','all','',Array(
    "allegato" => Array("name"=>"allegato","type"=>"xsd:string"),
    "data_protocollo" => Array("name"=>"data_protocollo","type"=>"xsd:string"),
    "documento" => Array("name"=>"documento","type"=>"xsd:string"),
    "integrato" => Array("name"=>"integrato","type"=>"xsd:string"),
    "integrazione" => Array("name"=>"integrazione","type"=>"xsd:string"),
    "mancante" => Array("name"=>"mancante","type"=>"xsd:string"),
    "note" => Array("name"=>"note","type"=>"xsd:string"),
    "pratica" => Array("name"=>"pratica","type"=>"xsd:string"),
    "protocollo" => Array("name"=>"protocollo","type"=>"xsd:string"),
    "sostituito" => Array("name"=>"sostituito","type"=>"xsd:string"),
    "files" => Array("name" => "files","type" => "tns:file_allegati")
    )
);

$server->wsdl->addComplexType('file_allegato','complexType','struct','all','',Array(
    "allegato" => Array("name"=>"allegato","type"=>"xsd:int"),
    "data_prot_allegato" => Array("name"=>"data_prot_allegato","type"=>"xsd:string"),
    "file" => Array("name"=>"file","type"=>"xsd:base64Binary"),
    "form" => Array("name"=>"form","type"=>"xsd:string"),
    "nome_file" => Array("name"=>"nome_file","type"=>"xsd:string"),
    "note" => Array("name"=>"note","type"=>"xsd:string"),
    "ordine" => Array("name"=>"ordine","type"=>"xsd:string"),
    "pratica" => Array("name"=>"pratica","type"=>"xsd:string"),
    "prot_allegato" => Array("name"=>"prot_allegato","type"=>"xsd:string"),
    "size_file" => Array("name"=>"size_file","type"=>"xsd:string"),
    "stato_allegato" => Array("name"=>"stato_allegato","type"=>"xsd:string"),
    "tipo_file" => Array("name"=>"tipo_file","type"=>"xsd:string")
    )
);

$server->wsdl->addComplexType('parere','complextType','array','all','',Array(
    "data_rice" => Array("name"=>"data_rice","type"=>"xsd:string"),
    "data_ricezione_richiesta" => Array("name"=>"data_ricezione_richiesta","type"=>"xsd:string"),
    "data_rich" => Array("name"=>"data_rich","type"=>"xsd:string"),
    "data_ril" => Array("name"=>"data_ril","type"=>"xsd:string"),
    "data_soll" => Array("name"=>"data_soll","type"=>"xsd:string"),
    "ente" => Array("name"=>"ente","type"=>"xsd:string"),
    "istruttore" => Array("name"=>"istruttore","type"=>"xsd:string"),
    "note" => Array("name"=>"note","type"=>"xsd:string"),
    "numero_doc" => Array("name"=>"numero_doc","type"=>"xsd:string"),
    "parere" => Array("name"=>"parere","type"=>"xsd:string"),
    "pratica" => Array("name"=>"pratica","type"=>"xsd:string"),
    "prescrizioni" => Array("name"=>"prescrizioni","type"=>"xsd:string"),
    "prot_rice" => Array("name"=>"prot_rice","type"=>"xsd:string"),
    "prot_rich" => Array("name"=>"prot_rich","type"=>"xsd:string"),
    "prot_ril" => Array("name"=>"prot_ril","type"=>"xsd:string"),
    "prot_soll" => Array("name"=>"prot_soll","type"=>"xsd:string"),
    "resp_parere" => Array("name"=>"resp_parere","type"=>"xsd:string"),
    "testo" => Array("name"=>"testo","type"=>"xsd:string")
    )
);
$server->wsdl->addComplexType(
    'indirizzi',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array("indirizzo"=>
        Array(
            "name"=>"indirizzo",
            "type"=>"tns:indirizzo"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:indirizzo[]"
        )
    ),
    "tns:indirizzo"
);
$server->wsdl->addComplexType(
    'soggetti',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array(
        Array(
            "name"=>"soggetto",
            "type"=>"tns:soggetto"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:soggetto[]"
        )
    ),
    "tns:soggetto"
);
$server->wsdl->addComplexType(
    'particelleterreni',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array(
        Array(
            "name"=>"particella",
            "type"=>"tns:particella"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:particella[]"
        )
    ),
    "tns:particella"
);
$server->wsdl->addComplexType(
    'particelleurbano',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array(
        Array(
            "name"=>"particella",
            "type"=>"tns:particella"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:particella[]"
        )
    ),
    "tns:particella"
);

$server->wsdl->addComplexType(
    'allegati',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array( 
        Array(
            "name"=>"allegato",
            "type"=>"tns:allegato"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:allegato[]"
        )
    ),
    "tns:allegato"
);
$server->wsdl->addComplexType(
    'file_allegati',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array(
        Array(
            "name"=>"file_allegato",
            "type"=>"tns:file_allegato"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:file_allegato[]"
        )
    ),
    "tns:file_allegato"
);

$server->wsdl->addComplexType(
    'elenco',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array(
        Array(
            "name"=>"elemento",
            "type"=>"tns:elemento"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:elemento[]"
        )
    ),
    "tns:elemento"
);


$server->wsdl->schemaTargetNamespace = 'urn:praticaweb';


/* -------------------------------------------------------------------------- */
/*                    REGISTRAZIONE DEI METODI DEL WS                         */
/* -------------------------------------------------------------------------- */
$server->register('aggiungiPratica',
    Array(
        "procedimento"=>"tns:procedimento",
        "soggetti" => "tns:soggetti",
        "indirizzi"=>"tns:indirizzi",
        "catasto_terreni" => "tns:particelleterreni",
        "catasto_urbano" => "tns:particelleurbano",
        "allegati" => "tns:allegati"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string[]",
        "errors" =>"xsd:string[]" ,
        "pratica"=>"xsd:int",
        "numero_pratica"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addPratica',
    'rpc',
    'encoded',
    'Metodo che aggiunge una istanza di pratica edilizia al software Praticaweb 2.0,restituisce la chiave primaria della pratica'
);



$server->register('elencoTipoPratica',
    Array(),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:elenco"
    ),
    'urn:praticaweb',
    'urn:praticaweb#listTipoPratica',
    'rpc',
    'encoded',
    'Metodo che restituisce elenco tipo pratica'
);

$server->register('elencoAllegati',
    Array(),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:elenco"
    ),
    'urn:praticaweb',
    'urn:praticaweb#listTipoPratica',
    'rpc',
    'encoded',
    'Metodo che restituisce elenco allegati disponibili online'
);

$server->register('elencoVie',
    Array(),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:elenco"
    ),
    'urn:praticaweb',
    'urn:praticaweb#listTipoPratica',
    'rpc',
    'encoded',
    'Metodo che restituisce elenco allegati disponibili online'
);
//require_once DIR.'lib/wsFunction.savona.php';
require_once "../config/savona.config.php";
require_once DIR."lib/utils.php";



function aggiungiPratica($procedimento,$soggetti=Array(),$indirizzi=Array(),$ct=Array(),$cu=Array(),$allegati=Array()){
    //ISTANZIO L'OGGETTO WS APPROPRIATO
    $ws = new wsApp(DSN);
    $ws->debug($ws::debugDir."PARAMS.debug",$ws::$projectParams);
    //INSERISCO UNA NUOVA PRATICA
    $r = $ws->aggiungiPratica($procedimento);
    //SE NON E' ANDATO A BUON FINE RITORNO MESSAGGIO DI ERRORE
    if(!$r["success"]){
        return Array(
            "success"=>0,
            "errors" => Array($r["message"]),
            "messages" => Array(),
            "numero" => NULL,
            "pratica" => NULL
        );
    }
    //INIZIALIZZO IL RISULTATO
    $result = Array(
        "success"=>1,
        "errors" => Array(),
        "messages" => Array(),
        "numero" => $r["numero"],
        "pratica" => $r["id"]
    );
    
    
    $pr = $res["id"];
    //SETTO LA DIRECTORY DEGLI ALLEGATI
    //$ws->setDirAllegati($pr);
    //CREO LA DIRECTORY DEGLI ALLEGATI
    //$ws->createDirAllegati();
    //INSERIMENTO DEI SOGGETTI 
    $cont = $err = 0;
    for($i=0;$i<count($soggetti);$i++){
        $res = $ws->aggiungiRecord($pr, $soggetti[$i], "soggetti");
        if(!$res["success"]){
            $err += 1;
            $result["errors"][] = $res["message"];
        }
        else{
            $cont += 1;
        }
    }
    $message = ($err)?("Sono stati inseriti $cont soggetti. Si sono verificati $err errori."):("Sono stati inseriti $cont soggetti.");
    
    $result["messages"][]=$message;
    //INSERIMENTO DEGLI INDIRIZZI 
    $cont = $err = 0;
    
    
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
/*              CATASTO TERRENI                                              */
/*----------------------------------------------------------------------------*/

function aggiungiCatastoTerreni($pratica,$ct){
    
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
    
    return $result;
}
function rimuoviIndirizzo($pratica,$indirizzo){
    $result=Array();
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    ALLEGATI                                                */
/*----------------------------------------------------------------------------*/

function aggiungiAllegato($pratica,$allegato,$files=Array()){
    
    return $result;
}

function addFile($pratica,$allegato,$text,$dir){
    
    return $result;
}

function aggiungiFile($pratica,$allegato){
    
    return $result;
}


/*----------------------------------------------------------------------------*/
/*                    TIPI PRATICA                                            */
/*----------------------------------------------------------------------------*/

function elencoTipoPratica(){
    $ws = new wsApp(DSN);
    return Array("success"=>1,"message"=>"","result"=>$ws->elencoTipiPratica());
}

function elencoAllegati(){
    $ws = new wsApp(DSN);
    return Array("success"=>1,"message"=>"","result"=>$ws->elencoAllegati());
}

function elencoVie(){
    $ws = new wsApp(DSN);
    return Array("success"=>1,"message"=>"","result"=>$ws->elencoVie());
}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>