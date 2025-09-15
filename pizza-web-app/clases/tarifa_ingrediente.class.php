<?php
class TarifaIngrediente {
    private $nombre;
    private $simple;
    private $doble;

    public function __construct($nombre, $simple, $doble) {
        $this->nombre = $nombre;
        $this->simple = $simple;
        $this->doble  = $doble;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecio($tipo) {
        switch ($tipo) {
            case "simple": return $this->simple;
            case "doble":  return $this->doble;
            default: return 0;
        }
    }
}
