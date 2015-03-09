<?php

require_once "ws.class.php";
class wsApp extends ws{
    function __construct($dsn,$pr=NULL) {
        parent::__construct($dsn);
        $this->pratica=$pr;
        $this->projectParams = Array(
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
        self::init();
    }
    static function init(){
        $dir = Array("data","savona","pe","praticaweb","documenti","pe");
        self::$baseDir = DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,$dir).DIRECTORY_SEPARATOR;
        
        if ($this->pratica){
            self::setDirAllegati($this->pratica);
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
            $dir = $this->baseDir.implode(DIRECTORY_SEPARATOR,$arrDir);
            $this->allegatiDir = $dir;
        }
        
    }
}
