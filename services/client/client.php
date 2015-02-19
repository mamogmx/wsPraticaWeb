<?php
require_once "../../lib/nusoap/nusoap.php";
$dbh="";
$url="http://webservice.gisweb.it/wspraticaweb/savona.wsPraticaweb.php?wsdl";
$options = array(
  'cache_wsdl'    => WSDL_CACHE_NONE,
  'encoding'      => 'utf-8',
  'soap_version'  => SOAP_1_1,
  'exceptions'    => true,
  'trace'         => true
);
ini_set('display_errors','on');
error_reporting(E_ALL);
$client = new soapclient($url,$options);
//$res=$client->aggiungiPratica("10000","2","pippo","pluto");
echo "<pre>";print_r($client);echo "</pre>";
?>