<?php
require_once __DIR__ . '/textbox.class.php';

class validatebox extends textbox {
    protected $error_longitud = false;
    protected $error_numerico = false;
    protected $longitud;

    public function __construct($id, $longitud = 9999, $valor = "") {
        parent::__construct($id, $valor);
        $this->longitud = $longitud;

        if (isset($_REQUEST[$this->id])) {
            $this->error_longitud = (strlen($this->valor) > $this->longitud);
            $this->error_numerico = !is_numeric($this->valor);
        }
    }

    public function esValido() {
        return !$this->error_longitud && !$this->error_numerico;
    }

    public function html() {
        parent::html();
        if ($this->error_longitud) {
            echo "LONGITUD NO VALIDA";
        } elseif ($this->error_numerico) {
            echo "VALOR NO VALIDO";
        }
    }
}
?>