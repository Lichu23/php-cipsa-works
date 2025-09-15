<?php
class Ingrediente {
    public $nombre;
    public $cantidad; // 'simple' o 'doble'
    public $precio;

    public function __construct($nombre, $cantidad, $precio) {
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->precio = $precio;
    }
}
?>
