<?php
require_once 'ingrediente.class.php';

class Pizza {
    public $nombre;
    public $tipo; // mediana, normal, familiar
    public $precio; // precio base
    public $ingredientes = [];

    public function __construct($nombre, $tipo, $precio) {
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->precio = $precio;
    }

    public function agregarIngrediente(Ingrediente $ingrediente) {
        $this->ingredientes[] = $ingrediente;
    }

    public function calcular_precio() {
        $total = $this->precio;
        foreach ($this->ingredientes as $ing) {
            $total += $ing->precio;
        }
        return $total;
    }
}
?>
