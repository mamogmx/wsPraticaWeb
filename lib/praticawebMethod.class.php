<?php
/**
 * Web Services Praticaweb 2.0
 * 
 * @service PraticaWeb-2.0
 */
require_once "utils.php";

class praticawebMethod {
    private $dbh;
    
    /**
     * Inserisce un Pratica nel Software Praticaweb-2.0
     * 
     * @param procedimento $proc Un tipo complesso procedimento
     * @return result Il risultoto dell'inserimento
     */
    public function aggiungiPratica($proc) {
        $dbh = new PDO(DSN);
        utils::debug("ADD",$proc);
        return 1;
    }
        
}
