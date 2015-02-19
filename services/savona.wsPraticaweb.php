<?php
$dbh="";
require_once "../config/savona.config.php";

$sqlTipoPratica="SELECT id,nome as testo FROM pe.e_tipopratica WHERE enabled=1 order by 1;";
$sqlTipoIntervento="SELECT id,descrizione as testo FROM pe.e_intervento;";
$stmt=$dbh->prepare($sqlTipoPratica);
$stmt->execute();
$result=$stmt->fetchAll();
$tipoPratica=convert($result);
$stmt=$dbh->prepare($sqlTipoIntervento);
$stmt->execute();
$result=$stmt->fetchAll();
$tipoIntervento=convert($result);
header("Content-Type: application/xml; charset=utf-8");
require_once "../lib/wsPraticawebBase.php";

?>
