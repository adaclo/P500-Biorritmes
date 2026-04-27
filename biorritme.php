<?php
class Biorritme {
    private $nom;
    private $naixement;
    private $arrPeriodes = array("físic"=>23, "emotiu"=>28, "intelectual"=>33);
  

    public function __construct($naixement, $nom) { 
        $this->naixement = $naixement;
        $this->nom = $nom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function calculBiorritme() {
        $resultats = [];

        $dataActual = new DateTime();
        $dataNaixement = new DateTime($this->naixement);

        $dies = $dataNaixement->diff($dataActual)->days;

        foreach ($this->arrPeriods as $tipus -> $periode) {
            $valor = sin(2 * pi() * $dies / $periode);
            $resultats[$tipus] = $valor;
        }

        return $resultats;
    }

    public function saveCalculBiorritmeToJson($values) {

        $fitxer = "biorritmes.json";

        if (file_exists($fitxer)) {
            $json_data = file_get_contents($fitxer);
            $data = json_decode($json_data, true);
        } else {
            $data = [];
        }

        $data[] = [
            "nom" => $this->nom,
            "naixement" => $this->naixement,
            "data_calcul" => date("Y-m-d"),
        ];

        file_put_contents($fitxer, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function tableCalculBiorritmeJsonFile() {
        $fitxer = "biorritmes.json";

        if (!file_exists($fitxer)) {
            return "<p>No hi ha dades disponibles.</p>";
        }

        $json_data = file_get_contents($fitxer);
        $data = json_decode($json_data, true);

        $html_table="<table border='1'><tr><th>Nom</th><th>Data de Naixement</th><th>Data de Càlcul</th></tr>";

        foreach ($data as $registre) {
            $html_table .= "<tr>";
            $html_table .= "<td>{$registre['nom']}</td>";
            $html_table .= "<td>{$registre['naixement']}</td>";
            $html_table .= "<td>{$registre['resultats']['físic']}</td>";
            $html_table .= "<td>{$registre['resultats']['emotiu']}</td>";
            $html_table .= "<td>{$registre['resultats']['intelectual']}</td>";
            $html_table .= "</tr>";
        }

        $html_table .= "</table>";
       
        return $html_table;
    }
}
?>