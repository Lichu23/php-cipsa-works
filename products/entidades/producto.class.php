<?php 
class Producto {
    private $id;
    private $nombre;
    private $categoria;
    private $precio;
    private $unidades;
    private $importe;

    public function __construct($id, $nombre, $categoria, $precio){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->precio = $precio;
        $this->unidades = 0;
        $this->importe = 0;
    }

    public function comprar($unidades) {
        $this->unidades = $unidades;
        $this->importe = $this->unidades * $this->precio;
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getCategoria() { return $this->categoria; }
    public function getPrecio() { return $this->precio; }
    public function getUnidades() { return $this->unidades; }
    public function getImporte() { return $this->importe; }
}
?>
