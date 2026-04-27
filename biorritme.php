<?php
class Biorritme {
    private $nom;
    private $naixement;
    private $arrPeriodes = array("físic"=>23, "emotiu"=>28, "intelectual"=>33);
  

    public function __construct($naixement, $nom) {
        //
    }

    public function getNom() {
        return $this->nom;
    }

    public function calculBiorritme() {
       //Calcula els biorritmes en funció de la data
       //actual i la data de naixement
       //Heu de tenir en compte els periodes a arrPeriodes
    }

    public function saveCalculBiorritmeToJson($values) {
        //Metode que enregistre les dades a un arxiu en format Json
        //Cal afegir les noves dades a les existents a l'arxiu
        //Aquesta és una estructura que us serveix de guia, no l'script definitiu.
        
        $file_name="nomdelfitxer.json";
        //Recupera el contingut d'un fitxer
        $json_data = file_get_contents($file_name);
        //Decodifica de text a Array
        $data = json_decode($json_data, true);
        //Codifica un Array en format Json
        $json_data = json_encode($data, JSON_PRETTY_PRINT); 
        //Enregistra en un fitxer
        file_put_contents($file_name, $json_data );
    }

    public function tableCalculBiorritmeJsonFile() {

        //Metode que llegeix les dades d'un arxiu en format Json
         $html_table="";
        //Confecciona una taula HTML amb les dades
        //Retorna la taula
       
        return $html_table;
    }
}
?>