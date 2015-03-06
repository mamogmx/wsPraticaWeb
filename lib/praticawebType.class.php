<?php

if(basename($_SERVER['SCRIPT_FILENAME'])==basename(__FILE__))
    exit;

/** 
 * Tipo di Dato "Procedimento"
 *
 * 
 * @pw_element int $anno Anno del procedimento
 * @pw_element int $categoria Categoria della procedimento
 * @pw_element date $data_com_resp Data della Comunicazione del RDP
 * @pw_element date $data_presentazione Data di presentazione della domanda
 * @pw_element date $data_prot Data di protocollazione
 * @pw_element date $data_resp Data Assegnazione RDP
 * @pw_element date $data_resp_ia Data Assegnazione Responsabile Istruttoria Tecnica
 * @pw_element date $data_resp_it Data Assegnazione Responsabile Istruttoria Amministrativa
 * @pw_element int $intervento Tipologia di Intervento
 * @pw_element string $note Note del Procedimento
 * @pw_element string $numero Numero di Pratica
 * @pw_element string $oggetto Oggetto della Pratica
 * @pw_element int $online Pratica OnLine
 * @pw_element int $pratica Identificativo Pratica
 * @pw_element string $prot Numero di Protocollo
 * @pw_element int $resp_ia Responsabile Istruttoria Amministrativa
 * @pw_element int $resp_it Responsabile Istruttoria Tecnica
 * @pw_element int $resp_proc Responsabile del Procedimento
 * @pw_element int $tipo Tipologia di pratica
 * @pw_complex procedimento Tipo complesso "procedimento"
 */

class procedimento {
    public $anno;
    public $categoria;
}

class soggetto {
    
}

/** 
 * Tipo di Dato "Indirizzo"
 *
 * 
 * @pw_element string $via Via
 * @pw_element string $civico Categoria della procedimento
 * @pw_element string $interno Data della Comunicazione del RDP
 * @pw_complex indirizzo Tipo complesso "Indirizzo"
 */
class indirizzo {
    
}
/** 
 * Tipo di Dato "Particella"
 *
 * 
 * @pw_element string $sezione Sezione
 * @pw_element string $foglio Foglio
 * @pw_element string $mappale Mappale
 * @pw_element string $sub Subalterno
 * @pw_complex particella Tipo complesso "Particella"
 */

class particella {
    
}

class parere {
    
}

class allegato {
    
}

class fileallegato {
    
}
/** 
 * Tipo di Dato "Risultato"
 *
 * 
 * @pw_element int $success Risultato del metodo
 * @pw_element string $message Messaggio di output
 * @pw_element string $id Chiave Primaria del risultato
 * @pw_complex risultato Tipo complesso "Risultato"
 */
class risultato {
    public $success = 0;
    public $message = "";
    public $id;
}

?>