<?php
require_once DIR."lib/nusoap/nusoap.php";

$server = new nusoap_server; 
$server->soap_defencoding = 'UTF-8';
$server->configureWSDL('praticaweb', SERVICE_URL);

$server->wsdl->addComplexType('elemento','complexType','struct','all','',Array(
    "value"=>Array("name"=>"value","type"=>"xsd:int"),
    "label"=>Array("name"=>"label","type"=>"xsd:string")
));
//$server->wsdl->addSimpleType('tipopratica','xsd:string','SimpleType','scalar',array_keys($tipoPratica));
//$server->wsdl->addSimpleType('tipointervento','xsd:string','SimpleType','scalar',array_keys($tipoIntervento));

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
    "resp_uo" => Array("name"=>"resp_uo","type"=>"xsd:string"),
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
    "datanato"=>Array("name"=>"datanato","type"=>"xsd:string"),
    "direttore"=>Array("name"=>"direttore","type"=>"xsd:int"),
    "economia_diretta"=>Array("name"=>"economia_diretta","type"=>"xsd:int"),
    "email"=>Array("name"=>"email","type"=>"xsd:string"),
    "esecutore"=>Array("name"=>"esecutore","type"=>"xsd:int"),
    "fax"=>Array("name"=>"fax","type"=>"xsd:string"),
    "geologo"=>Array("name"=>"geologo","type"=>"xsd:int"),
    "inail"=>Array("name"=>"inail","type"=>"xsd:string"),
    "inailprov"=>Array("name"=>"inailprov","type"=>"xsd:string"),
    "indirizzo"=>Array("name"=>"indirizzo","type"=>"xsd:string"),
    "inps"=>Array("name"=>"inps","type"=>"xsd:string"),
    "inpsprov"=>Array("name"=>"inpsprov","type"=>"xsd:string"),
    "nome"=>Array("name"=>"nome","type"=>"xsd:string"),
    "note"=>Array("name"=>"note","type"=>"xsd:string"),
    "pec"=>Array("name"=>"pec","type"=>"xsd:string"),
    "piva"=>Array("name"=>"piva","type"=>"xsd:string"),
    "progettista"=>Array("name"=>"progettista","type"=>"xsd:int"),
    "progettista_ca"=>Array("name"=>"Progettista Cementi Armati","type"=>"xsd:int"),
    "proprietario"=>Array("name"=>"proprietario","type"=>"xsd:int"),
    "prov"=>Array("name"=>"prov","type"=>"xsd:string"),
    "provd"=>Array("name"=>"provd","type"=>"xsd:string"),
    "provnato"=>Array("name"=>"provnato","type"=>"xsd:string"),
    "ragsoc"=>Array("name"=>"ragsoc","type"=>"xsd:string"),
    "richiedente"=>Array("name"=>"richiedente","type"=>"xsd:int"),
    "sede"=>Array("name"=>"sede","type"=>"xsd:string"),
    "sesso"=>Array("name"=>"sesso","type"=>"xsd:string"),
    "sicurezza"=>Array("name"=>"sicurezza","type"=>"xsd:int"),
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

$server->wsdl->addComplexType('progetto','complexType','struct','all','',Array(
        "destuso1"=>Array("name"=>"destuso1","type"=>"xsd:int"),
        "destuso2"=>Array("name"=>"destuso2","type"=>"xsd:int"),
        "tavole"=>Array("name"=>"tavole","type"=>"xsd:string")
    )
);
$server->wsdl->addComplexType('lavori','complexType','struct','all','',Array(
        "il"=>Array("name"=>"il","type"=>"xsd:string"),
        "fl"=>Array("name"=>"fl","type"=>"xsd:string"),
        "note"=>Array("name"=>"note","type"=>"xsd:string")
        
    )
);

$server->wsdl->addComplexType('sanzione','complexType','struct','all','',Array(
        "tipo_sanzione"=>Array("name"=>"tipo_sanzione","type"=>"xsd:string"),
        "data_sanzione"=>Array("name"=>"data_sanzione","type"=>"xsd:string"),
        "importo"=>Array("name"=>"importo","type"=>"xsd:string"),
        "data_scadenza"=>Array("name"=>"data_scadenza","type"=>"xsd:string"),
        "quietanza"=>Array("name"=>"quietanza","type"=>"xsd:string"),
        "data_pagamento"=>Array("name"=>"data_pagamento","type"=>"xsd:string"),
        "note"=>Array("name"=>"note","type"=>"xsd:string")
        
    )
);


$server->wsdl->addComplexType('oneri','complexType','struct','all','',Array(
        "totale"=>Array("name"=>"totale","type"=>"xsd:string"),
        "cc"=>Array("name"=>"cc","type"=>"xsd:string"),
        "b1"=>Array("name"=>"b1","type"=>"xsd:string"),
        "b2"=>Array("name"=>"b2","type"=>"xsd:string"),
        "scb1"=>Array("name"=>"scb1","type"=>"xsd:string"),
        "scb2"=>Array("name"=>"scb2","type"=>"xsd:string"),
        "data"=>Array("name"=>"data","type"=>"xsd:string"),
        "quietanza"=>Array("name"=>"quietanza","type"=>"xsd:string"),
        "rateizzato"=>Array("name"=>"rateizzato","type"=>"xsd:string"),
        "fideiussione"=>Array("name"=>"fideiussione","type"=>"xsd:string"),
        "note"=>Array("name"=>"note","type"=>"xsd:string")
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
$server->wsdl->addComplexType(
    'sanzioni',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    Array("sanzione"=>
        Array(
            "name"=>"sanzione",
            "type"=>"tns:sanzione"
        )
    ),
    Array( 
        Array( 
            "ref" => "SOAP-ENC:arrayType",
            "wsdl:arrayType" => "tns:sanzione[]"
        )
    ),
    "tns:sanzione"
);
$server->wsdl->addComplexType(
    'strArray','complexType','array','',
    'SOAP-ENC:Array',
    array(),
    array(array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'xsd:string[]')));


$server->wsdl->addComplexType(
    'infoProcedimento','complexType','struct','all','',Array(
        "procedimento"=>Array("name"=>"procedimento","type"=>"tns:procedimento"),
        "richiedenti"=>Array("name"=>"richiedenti","type"=>"tns:soggetti"),
        "progettisti"=>Array("name"=>"progettisti","type"=>"tns:soggetti"),
        "direttore_lavori"=>Array("name"=>"direttore_lavori","type"=>"tns:soggetti"),
        "esecutori"=>Array("name"=>"esecutori","type"=>"tns:soggetti"),
        "indirizzi"=>Array("name"=>"indirizzi","type"=>"tns:indirizzi")
    ),
    "tns:infoProcedimento"
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
        "messages"=>"tns:strArray",
        "errors" =>"tns:strArray" ,
        "pratica"=>"xsd:int",
        "numero_pratica"=>"xsd:string"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addPratica',
    'rpc',
    'encoded',
    'Metodo che aggiunge una istanza di pratica edilizia al software Praticaweb 2.0,restituisce la chiave primaria della pratica'
);

$server->register('aggiungiAllegato',
    Array(
        "pratica"=>"xsd:int",
        "allegato" => "tns:allegato"
    ),
    Array(
        "success"=>"xsd:int",
        "messages"=>"tns:strArray",
        "errors" =>"tns:strArray" ,
        "id"=>"xsd:int",
        "err"=>"xsd:int",
        "cont"=>"xsd:int"
    ),
    'urn:praticaweb',
    'urn:praticaweb#addAllegato',
    'rpc',
    'encoded',
    'Metodo che aggiunge ad una istanza di pratica edilizia un allegato e i relativi files'
);

$server->register('aggiungiProgetto',
    Array(
        "pratica"=>"xsd:int",
        "progetto" => "tns:progetto"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"tns:strArray",
        "errors" =>"tns:strArray" ,
        "id"=>"xsd:int",
    ),
    'urn:praticaweb',
    'urn:praticaweb#addProgetto',
    'rpc',
    'encoded',
    'Metodo che aggiunge ad una istanza di pratica edilizia i dati relativi al Progetto'
);

$server->register('aggiungiSanzione',
    Array(
        "pratica"=>"xsd:int",
        "sanzione" => "tns:sanzione"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"tns:strArray",
        "errors" =>"tns:strArray" ,
        "id"=>"xsd:int",
    ),
    'urn:praticaweb',
    'urn:praticaweb#addSanzione',
    'rpc',
    'encoded',
    'Metodo che aggiunge ad una istanza di pratica edilizia i dati relativi ad una sanzione'
);

$server->register('aggiungiOneri',
    Array(
        "pratica"=>"xsd:int",
        "sanzione" => "tns:oneri"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"tns:strArray",
        "errors" =>"tns:strArray" ,
        "id"=>"xsd:int",
    ),
    'urn:praticaweb',
    'urn:praticaweb#addOneri',
    'rpc',
    'encoded',
    'Metodo che aggiunge ad una istanza di pratica edilizia i dati relativi agli Oneri'
);

$server->register('trovaProcedimento',
    Array(
        "numero"=>"xsd:string"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "id"=>"xsd:int"
    ),
    'urn:praticaweb',
    'urn:praticaweb#findProcedimento',
    'rpc',
    'encoded',
    'Metodo che restituisce id del procedimento dal numero'
);
$server->register('comunicazioneInizioLavori',
    Array(
        "pratica"=>"xsd:int",
        "lavori" => "tns:lavori"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"tns:strArray",
        "errors" =>"tns:strArray" ,
        "id"=>"xsd:int",
    ),
    'urn:praticaweb',
    'urn:praticaweb#sendIL',
    'rpc',
    'encoded',
    'Metodo che registra la data di inizio lavori'
);
$server->register('comunicazioneFineLavori',
    Array(
        "pratica"=>"xsd:int",
        "lavori" => "tns:lavori"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"tns:strArray",
        "errors" =>"tns:strArray" ,
        "id"=>"xsd:int",
    ),
    'urn:praticaweb',
    'urn:praticaweb#sendFL',
    'rpc',
    'encoded',
    'Metodo che registra la data di fine lavori'
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

$server->register('elencoDestUso',
    Array(),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:elenco"
    ),
    'urn:praticaweb',
    'urn:praticaweb#listDestUso',
    'rpc',
    'encoded',
    "Metodo che restituisce elenco desinazioni d'uso"
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

$server->register('infoProcedimento',
    Array("id"=>"xsd:int"),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:infoProcedimento"
    ),
    'urn:praticaweb',
    'urn:praticaweb#infoPratica',
    'rpc',
    'encoded',
    'Metodo che Informazioni sul Procedimento'
);

$server->register('infoSoggetto',
    Array(
        "id"=>"xsd:int", 
        "tipo_soggetto"=>"xsd:string"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:soggetti"
    ),
    'urn:praticaweb',
    'urn:praticaweb#infoSoggetto',
    'rpc',
    'encoded',
    'Metodo che Informazioni sul Procedimento e sul tipo di soggetto indicato'
);
$server->register('infoPratica',
    Array(
        "id"=>"xsd:int"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:procedimento"
    ),
    'urn:praticaweb',
    'urn:praticaweb#infoPratica',
    'rpc',
    'encoded',
    'Metodo che Informazioni sul Procedimento e sul tipo di soggetto indicato'
);

$server->register('infoIndirizzi',
    Array(
        "id"=>"xsd:int"
    ),
    Array(
        "success"=>"xsd:int",
        "message"=>"xsd:string",
        "result"=>"tns:indirizzi"
    ),
    'urn:praticaweb',
    'urn:praticaweb#infoIndirizzi',
    'rpc',
    'encoded',
    'Metodo che restituisce informazioni sulle ubicazioni'
);
//require_once DIR.'lib/wsFunction.savona.php';
//require_once "../config/savona.config.php";
require_once DIR."lib/utils.php";



function aggiungiPratica($procedimento,$soggetti=Array(),$indirizzi=Array(),$ct=Array(),$cu=Array(),$allegati=Array()){
    //ISTANZIO L'OGGETTO WS APPROPRIATO
    $ws = new wsApp(DSN);
    $ws->debug($ws->debugDir."PROCEDIMENTO.debug",$procedimento);

    //INSERISCO UNA NUOVA PRATICA
    $r = $ws->aggiungiPratica($procedimento);
    //SE NON E' ANDATO A BUON FINE RITORNO MESSAGGIO DI ERRORE
    if(!$r["success"]){
        return Array(
            "success"=>0,
            "errors" => Array($r["error"]),
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
        "numero_pratica" => $r["numero"],
        "pratica" => $r["id"]
    );
    $pr = $r["id"];
    $ws->setDirAllegati($pr);
    $ws->debug($ws->debugDir."RESULT.debug",$r);
    
    //SETTO LA DIRECTORY DEGLI ALLEGATI
    //$ws->setDirAllegati($pr);
    //CREO LA DIRECTORY DEGLI ALLEGATI
    //$ws->createDirAllegati();
    //INSERIMENTO DEI SOGGETTI 
    $cont = $err = 0;
    $errors = Array();
    $messages = Array();
    $ws->debug($ws->debugDir."SOGGETTI.debug",$soggetti);
    for($i=0;$i<count($soggetti);$i++){
        $res = $ws->aggiungiRecord($pr, $soggetti[$i], "soggetti");
        if(!$res["success"]){
            $err += 1;
            $errors[] = $res["error"];
        }
        else{
            $cont += 1;
        }
    }
    $messages[] = ($err)?("Sono stati inseriti $cont soggetti. Si sono verificati $err errori."):("Sono stati inseriti $cont soggetti.");

    //INSERIMENTO DEGLI INDIRIZZI 
    $cont = $err = 0;
    for($i=0;$i<count($indirizzi);$i++){
        $res = $ws->aggiungiRecord($pr, $indirizzi[$i], "indirizzi");
        if(!$res["success"]){
            $err += 1;
            $errors[] = $res["error"];
        }
        else{
            $cont += 1;
        }
    }
    $messages[] = ($err)?("Sono stati inseriti $cont indirizzi. Si sono verificati $err errori."):("Sono stati inseriti $cont indirizzi.");

    //INSERIMENTO DELLE PARTICELLE DEL CATASTO TERRENI 
    $cont = $err = 0;
    for($i=0;$i<count($ct);$i++){
        $res = $ws->aggiungiRecord($pr, $ct[$i], "cterreni");
        if(!$res["success"]){
            $err += 1;
            $errors[] = $res["error"];
        }
        else{
            $cont += 1;
        }
    }
    $messages[] = ($err)?("Sono state inserite $cont particelle del catasto terreni. Si sono verificati $err errori."):("Sono state inserite $cont particelle del catasto terreni.");
    
    //INSERIMENTO DELLE PARTICELLE DEL CATASTO URBANO 
    $cont = $err = 0;
    for($i=0;$i<count($cu);$i++){
        $res = $ws->aggiungiRecord($pr, $cu[$i], "curbano");
        if(!$res["success"]){
            $err += 1;
            $errors[] = $res["error"];
        }
        else{
            $cont += 1;
        }
    }
    $messages[] = ($err)?("Sono state inserite $cont particelle del catasto urbano. Si sono verificati $err errori."):("Sono state inserite $cont particelle del catasto urbano.");
    
    //INSERIMENTO DEGLI ALLEGATI 
    
    
    $result["messages"] = $messages;
    $result["errors"] = $errors;

    return $result;
}
function aggiornaPratica($pratica,$tipo,$intervento,$oggetto,$note,$destinazione_uso){
    $result=Array();
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    ALLEGATI                                                */
/*----------------------------------------------------------------------------*/

function aggiungiAllegato($pratica,$allegato){
    $ws = new wsApp(DSN,$pratica);
    $res = $ws->aggiungiAllegato($pratica, $allegato);
    if(!$res["success"]){
        return Array(
            "success"=>0,
            "errors" => Array($res["error"]),
            "messages" => Array(),
            "id" => NULL
        );
    }
    else{
        
        return Array(
            "success"=>1,
            "errors" => NULL,
            "messages" => $res["messages"],
            "id" => $res["id"]
        );
    }
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
/*                    Progetto                                                */
/*----------------------------------------------------------------------------*/
function aggiungiProgetto($pratica,$progetto){
    $ws = new wsApp(DSN,$pratica);
    $result = $ws->aggiungiRecord($pratica, $progetto, "progetto");
    return $result;
}
function rimuoviProgetto($id){
    $result=Array();
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    Sanzioni                                                */
/*----------------------------------------------------------------------------*/
function aggiungiSanzione($pratica,$sanzione){
    $ws = new wsApp(DSN,$pratica);
    $result = $ws->aggiungiRecord($pratica, $sanzione, "sanzioni");
    return $result;
}
function rimuoviSanzione($id){
    $result=Array();
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    Progetto                                                */
/*----------------------------------------------------------------------------*/
function aggiungiOneri($pratica,$oneri){
    $ws = new wsApp(DSN,$pratica);
    $result = $ws->aggiungiRecord($pratica, $oneri, "oneri");
    return $result;
}
function rimuoviOneri($id){
    $result=Array();
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    Comunicazione Date Lavori                               */
/*----------------------------------------------------------------------------*/

function comunicazioneInizioLavori($pratica,$lavori){
    $ws = new wsApp(DSN,$pratica);
    $result = $ws->aggiungiIL($pratica, $lavori );
    return $result;
}

function comunicazioneFineLavori($pratica,$lsvori){
    $ws = new wsApp(DSN,$pratica);
    $result = $ws->aggiungiFL($pratica, $lavori);
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    Metodi di Ricerca                                       */
/*----------------------------------------------------------------------------*/


function trovaProcedimento($npratica){
    $ws = new wsApp(DSN,$pratica);
    $result = $ws->trovaProcedimento($npratica);
    return $result;
}

/*----------------------------------------------------------------------------*/
/*                    Metodi di Raccolta Informazioni                         */
/*----------------------------------------------------------------------------*/


function infoProcedimento($pr=""){
    $ws = new wsApp(DSN,$pr);
    //return Array("success"=>1,"message"=>"","result"=>Array());
    $result = $ws->infoProcedimento();
    return $result;
}

function infoPratica($pr=""){
    $ws = new wsApp(DSN,$pr);
    
    $result = $ws->infoPratica();
    return $result;
}

function infoSoggetto($pr="",$tipo_soggetto=""){
    $ws = new wsApp(DSN,$pr);
    
    $result = $ws->infoSoggetto($tipo_soggetto);
    return $result;
}

function infoIndirizzi($pr=""){
    $ws = new wsApp(DSN,$pr);
    
    $result = $ws->infoIndirizzi();
    return $result;
}
/*----------------------------------------------------------------------------*/
/*                    TIPI PRATICA                                            */
/*----------------------------------------------------------------------------*/

function elencoTipoPratica(){
    $ws = new wsApp(DSN);
    return Array("success"=>1,"message"=>"","result"=>$ws->elencoTipiPratica());
}

/*----------------------------------------------------------------------------*/
/*                    TIPO ALLEGATI                                           */
/*----------------------------------------------------------------------------*/
function elencoAllegati(){
    $ws = new wsApp(DSN);
    return Array("success"=>1,"message"=>"","result"=>$ws->elencoAllegati());
}

/*----------------------------------------------------------------------------*/
/*                    ELENCO VIE                                              */
/*----------------------------------------------------------------------------*/

function elencoVie(){
    $ws = new wsApp(DSN);
    return Array("success"=>1,"message"=>"","result"=>$ws->elencoVie());
}

/*----------------------------------------------------------------------------*/
/*                    TIPO DESTINAZIONE D'USO                                 */
/*----------------------------------------------------------------------------*/

function elencoDestUso(){
    $ws = new wsApp(DSN);
    return Array("success"=>1,"message"=>"","result"=>$ws->elencoDestUso());
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>