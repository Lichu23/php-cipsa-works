<?php 
require_once __DIR__ . '/htmlrenderable.interface.php';

class textbox implements HtmlRenderable {
    protected $id;
    protected $valor;

    public function __construct($id, $valor = "") {
        $this->id = $id;
        $this->valor = (isset($_REQUEST[$this->id])) ? $_REQUEST[$this->id] : $valor;
    }

    public function esValido() {
        return $this->valor !== "";
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function html() {
        echo "<input type='text' name='{$this->id}' value='{$this->valor}'>";
    }
}

?>