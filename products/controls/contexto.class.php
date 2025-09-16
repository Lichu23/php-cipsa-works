<?php 
require_once __DIR__ . '/htmlrenderable.interface.php';

class Contexto implements HtmlRenderable {
    protected $id;
    protected $valor;

    public function __construct($_id, $_valor = null) {
        $this->id = $_id;
        if (isset($_REQUEST[$this->id])) {
            $this->valor = unserialize($_REQUEST[$this->id]);
        } else {
            $this->valor = $_valor;
        }
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($_valor) {
        $this->valor = $_valor;
    }

    public function html() {
        $valorSerializado = htmlspecialchars(serialize($this->valor), ENT_QUOTES);
        return "<input type='hidden' name='{$this->id}' value='{$valorSerializado}'>";
    }
}
?>
