<?php 
require_once __DIR__ . '/htmlrenderable.interface.php';

class Boton implements HtmlRenderable {
    protected $id;
    protected $valor;

    public function __construct($id, $valor = "Enviar") {
        $this->id = $id;
        $this->valor = $valor;
    }

    // Saber si se pulsó el botón
    public function fuePulsado() {
        return isset($_REQUEST[$this->id]);
    }

    // Renderizar el botón como HTML
    public function html() {
        return "<input type='submit' name='{$this->id}' value='{$this->valor}'>";
    }
}
?>
