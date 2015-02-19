<?php
$loc=Array("apps","wsPraticaWeb");
define('DIR',DIRECTORY_SEPARATOR.implode(DIRECTORY_SEPARATOR,$loc).DIRECTORY_SEPARATOR);
$dsn="pgsql:host=127.0.0.1;port=5432;dbname=gw_savona;user=postgres;password=postgres";
define('DSN',$dsn);

function convert($res){
    for($i=0;$i<count($res);$i++){
        list($id,$testo)=$res[$i];
        $r[$testo]=$id;
    }
    return $r;
}

$dbh=new PDO(DSN);
?>
