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

        if ($dataNaixement > $dataActual) {
            throw new Exception("La data de naixement no pot ser posterior a la data actual.");
        }

        $dies = $dataNaixement->diff($dataActual)->days;

        foreach ($this->arrPeriodes as $tipus => $periode) {
            $valor = sin(2 * pi() * $dies / $periode);
            $percentatge = (($valor + 1) / 2) * 100;

            $resultats[$tipus] = [
                "valor" => round($valor, 2),
                "percentatge" => round($percentatge, 2)
            ];
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
            "resultats" => $values
        ];

        file_put_contents($fitxer, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function tableCalculBiorritmeJsonFile() {
        $fitxer = "biorritmes.json";

        if (!file_exists($fitxer)) {
            return "<p class='rounded-xl bg-slate-100 p-4 text-slate-600'>No hi ha dades disponibles.</p>";
        }

        $json_data = file_get_contents($fitxer);
        $data = json_decode($json_data, true);

        if (!$data || count($data) === 0) {
            return "<p class='rounded-xl bg-slate-100 p-4 text-slate-600'>No hi ha dades disponibles.</p>";
        }

        $html_table = "<div class='relative overflow-x-auto rounded-2xl border border-slate-200 shadow-sm'>";
        $html_table .= "<table class='w-full text-left text-sm text-slate-600'>";
        $html_table .= "<thead class='bg-slate-900 text-xs uppercase tracking-wider text-white'>";
        $html_table .= "<tr><th class='px-6 py-4'>Nom</th><th class='px-6 py-4'>Data de naixement</th><th class='px-6 py-4'>Físic</th><th class='px-6 py-4'>Emotiu</th><th class='px-6 py-4'>Intel·lectual</th></tr>";
        $html_table .= "</thead><tbody>";

        foreach (array_reverse($data) as $registre) {
            $fisic = $registre['resultats']['físic']['percentatge'] ?? 0;
            $emotiu = $registre['resultats']['emotiu']['percentatge'] ?? 0;
            $intelectual = $registre['resultats']['intelectual']['percentatge'] ?? 0;

            $html_table .= "<tr class='border-b bg-white hover:bg-slate-50'>";
            $html_table .= "<td class='whitespace-nowrap px-6 py-4 font-semibold text-slate-900'>" . htmlspecialchars($registre['nom']) . "</td>";
            $html_table .= "<td class='px-6 py-4'>" . htmlspecialchars($registre['naixement']) . "</td>";
            $html_table .= "<td class='px-6 py-4'><span class='rounded-full bg-blue-100 px-3 py-1 font-medium text-blue-700'>" . $fisic . "%</span></td>";
            $html_table .= "<td class='px-6 py-4'><span class='rounded-full bg-pink-100 px-3 py-1 font-medium text-pink-700'>" . $emotiu . "%</span></td>";
            $html_table .= "<td class='px-6 py-4'><span class='rounded-full bg-purple-100 px-3 py-1 font-medium text-purple-700'>" . $intelectual . "%</span></td>";
            $html_table .= "</tr>";
        }

        $html_table .= "</tbody></table></div>";
       
        return $html_table;
    }
}
?>