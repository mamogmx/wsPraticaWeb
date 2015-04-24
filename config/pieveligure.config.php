<?php
$info = pathinfo(__FILE__);
$dsn="pgsql:host=192.168.1.134;port=5433;dbname=gw_pieveligure;user=postgres;password=postgres";
define('SERVICE_URL','http://webservice.gisweb.vmserver/wspraticaweb/pieveligure.wsPraticaweb.php?wsdl');
define('DIR',dirname($info['dirname']).DIRECTORY_SEPARATOR);
define('LIB',DIR."lib".DIRECTORY_SEPARATOR);
define('LIBWSDL',LIB."php-wsdl".DIRECTORY_SEPARATOR);
define('DSN',$dsn);
define('DOCDIR','/data/pieveligure/pe/praticaweb/documenti/pe/');

ini_set('memory_limit','1024M');
function convert($res){
    for($i=0;$i<count($res);$i++){
        list($id,$testo)=$res[$i];
        $r[$testo]=$id;
    }
    return $r;
}
?>
