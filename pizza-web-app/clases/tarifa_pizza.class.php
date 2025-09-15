<?php
class TarifaPizza {
    private $nombre;
    private $mediana;
    private $normal;
    private $familiar;

    public function __construct($nombre, $mediana, $normal, $familiar) {
        $this->nombre   = $nombre;
        $this->mediana  = $mediana;
        $this->normal   = $normal;
        $this->familiar = $familiar;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio($tamano) {
        switch ($tamano) {
            case "mediana":  return $this->mediana;
            case "normal":   return $this->normal;
            case "familiar": return $this->familiar;
            default: return 0;
        }
    }
}
