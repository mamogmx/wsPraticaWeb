<?php
$info = pathinfo(__FILE__);
$dsn="pgsql:host=192.168.1.134;port=5433;dbname=gw_savona;user=postgres;password=postgres";

define('DIR',dirname($info['dirname']).DIRECTORY_SEPARATOR);
define('LIB',DIR."lib".DIRECTORY_SEPARATOR);
define('LIBWSDL',LIB."php-wsdl".DIRECTORY_SEPARATOR);
define('DSN',$dsn);
define('DOCDIR','/data/savona/pe/praticaweb/documenti/pe/');

$dbh=new PDO(DSN);
ini_set('memory_limit','512M');
function convert($res){
    for($i=0;$i<count($res);$i++){
        list($id,$testo)=$res[$i];
        $r[$testo]=$id;
    }
    return $r;
}
?>
