<?php
$info = pathinfo(__FILE__);
$dsn="pgsql:host=127.0.0.1;port=5432;dbname=gw_savona;user=postgres;password=postgres";

define('DIR',dirname($info['dirname']).DIRECTORY_SEPARATOR);
define('LIB',DIR."lib".DIRECTORY_SEPARATOR);
define('LIBWSDL',LIB."php-wsdl".DIRECTORY_SEPARATOR);
define('DSN',$dsn);
define('DOCDIR','/data/savona/pe/praticaweb/documenti/pe/');

$savonaParams = Array(
    "avvioproc"=>Array(
        "fields"=>Array(
            "tipo","intervento","oggetto","note",
            "data_presentazione","protocollo",
            "data_prot","resp_proc","online"
        ),
        "params"=>Array("tipo","intervento","oggetto","note",
            "data_presentazione","protocollo","data_prot",
            "resp_proc","online"
        ),
        "table"=>"avvioproc",
        "schema" => "pe",
        "sequence" => "pe.avvioproc_id_seq"
    ),
    "soggetti" =>Array(
        "fields"=>Array(
            "pratica","albo","albonumero","alboprov","app","cap","capd","ccia",
            "cciaprov","cedile","cedileprov","codfis","cognome","collaudatore",
            "collaudatore_ca","comunato","comune","comuned","comunicazioni",
            "concessionario","datanato","denunciante","direttore",
            "economia_diretta","email","esecutore","geologo",
            "inail","inailprov","indirizzo","inps","inpsprov","nome","note",
            "pec","piva","progettista","progettista_ca","proprietario","prov",
            "provd","provnato","ragsoc","resp_abuso","richiedente","sede",
            "sesso","sicurezza","telefono","titolo","titolod","titolod_note",
            "titolo_note","voltura"
        ),
        "params" => Array(
            "albo","albonumero","alboprov","app","cap","capd","ccia",
            "cciaprov","cedile","cedileprov","codfis","cognome","collaudatore",
            "collaudatore_ca","comunato","comune","comuned","comunicazioni",
            "concessionario","datanato","denunciante","direttore",
            "economia_diretta","email","esecutore","geologo",
            "inail","inailprov","indirizzo","inps","inpsprov","nome","note",
            "pec","piva","progettista","progettista_ca","proprietario","prov",
            "provd","provnato","ragsoc","resp_abuso","richiedente","sede",
            "sesso","sicurezza","telefono","titolo","titolod","titolod_note",
            "titolo_note","voltura"
        ),
        "table"=>"soggetti",
        "schema" => "pe",
        "sequence" => "pe.soggetti_id_seq"
    ),
    "indirizzi"=>Array(
        "fields"=>Array(
            "pratica","via","civico","interno"
        ),
        "params"=>Array(
            "via","civico","interno"
        ),
        "table"=> "indirizzi",
        "schema"=>"pe",
        "sequence"=>"pe.indirizzi_id_seq"
    ),
    "cterreni"=>Array(
        "fields"=>Array(
            "pratica","foglio","mappale"
        ),
        "params"=>Array(
            "foglio","mappale"
        ),
        "table"=> "cterreni",
        "schema"=>"pe",
        "sequence"=>"pe.cterreni_id_seq"
    ),
    "curbano"=>Array(
        "fields"=>Array(
            "pratica","foglio","mappale","sub"
        ),
        "params"=>Array(
            "foglio","mappale","sub"
        ),
        "table"=> "curbano",
        "schema"=>"pe",
        "sequence"=>"pe.curbano_id_seq"
    ),
    "allegati"=>Array(
        "fields"=>Array(
            "pratica","documento","note","protocollo","data_protocollo"
        ),
        "params"=>Array(
            "documento","note","protocollo","data_protocollo"
        ),
        "table"=> "allegati",
        "schema"=>"pe",
        "sequence"=>"pe.allegati_id_seq"
    ),
    "file_allegati"=>Array(
        "fields"=>Array(
            "pratica","allegato","data_prot_allegato","prot_allegato",
            "size_file","tipo_file","nome_file","note"
        ),
        "params"=>Array(
            "allegato","data_prot_allegato","prot_allegato",
            "size_file","tipo_file","nome_file","note"
        ),
        "table"=> "file_allegati",
        "schema"=>"pe",
        "sequence"=>"pe.file_allegati_id_seq"
    ),
    "pareri"=>Array(
        "fields"=>Array(

        ),
        "params"=>Array(

        ),
        "table"=> "",
        "schema"=>"",
        "sequence"=>""
    ),
    "lavori"=>Array(
        "fields"=>Array(

        ),
        "params"=>Array(

        ),
        "table"=> "",
        "schema"=>"",
        "sequence"=>""
    ),
    "progetto"=>Array(
        "fields"=>Array(

        ),
        "params"=>Array(

        ),
        "table"=> "",
        "schema"=>"",
        "sequence"=>""
    )
);
ini_set('memory_limit','512M');
function convert($res){
    for($i=0;$i<count($res);$i++){
        list($id,$testo)=$res[$i];
        $r[$testo]=$id;
    }
    return $r;
}
?>
