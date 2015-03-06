<?php

if(basename($_SERVER['SCRIPT_FILENAME'])==basename(__FILE__))
	exit;

/**
 * @service PraticaWeb 2.0
 */
class praticaweb {
    /**
     * Insert a
     * 
     * @param procedimento $obj The object
     * @return result The result 
     */
    
    public function aggiungiProcedimento($obj){
        return utf8_encode($obj);
    }
}
