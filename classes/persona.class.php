<?php 
class Persona {
 private $nombre;
 private $edad;

 public function __construct($nombre, $edad) {
    $this->nombre = $nombre;
    $this->edad = $edad;
 } 

 public function Saludar () {
    echo "Hola soy ". $this->nombre. " tengo ". $this->edad. " años.<br>";
 }

public function  getNombre($nombre) {
    return $this->nombre;
 }


 public function  setNombre($nuevoNombre) {
    return $this->nombre = $nuevoNombre;
}

public function  getEdad($edad) {
    return $this->edad;
 }

 public function cumplirAños() {
    return $this->edad++;
}
}

$persona1 = new Persona("Juan", 20);


$persona1->Saludar();
$persona1->setNombre("Pedrito");
$persona1->Saludar();
$persona1->cumplirAños();
$persona1->Saludar();

?>