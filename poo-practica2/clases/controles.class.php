<?php
// Interfaz htmlrenderable
interface htmlrenderable {
    function html();
}

// Clase textbox
class textbox implements htmlrenderable {
    protected $id;
    protected $valor;

    public function __construct($id, $valor = null) {
        $this->id = $id;
        if ($valor === null) {
            // Recuperar valor de $_REQUEST si está disponible
            if (isset($_REQUEST[$this->id])) {
                $this->valor = $_REQUEST[$this->id];
            }
        } else {
            $this->valor = $valor;
        }
    }

    public function getvalor() {
        return $this->valor;
    }

    public function html() {
        echo "<input type='text' name='$this->id' value='$this->valor'>";
    }
}

// Clase listboxopcion
class listboxopcion implements htmlrenderable {
    protected $titulo;
    protected $valor;
    protected $seleccionado;

    public function __construct($titulo, $valor, $seleccionado = null) {
        $this->titulo = $titulo;
        $this->valor = $valor;
        $this->seleccionado = $seleccionado;
    }

    public function estaseleccionado($seleccionado) {
        $this->seleccionado = $seleccionado;
    }

    public function html() {
        echo "<option value='$this->valor'" . ($this->seleccionado ? " selected" : "") . ">$this->titulo</option>";
    }
}

// Clase listbox
class listbox implements htmlrenderable {
    protected $id;
    protected $opciones = array();

    public function __construct($id) {
        $this->id = $id;
    }

    public function opcion(listboxopcion $opcion) {
        array_push($this->opciones, $opcion);
    }

    public function getvalor() {
        return isset($_REQUEST[$this->id]) ? $_REQUEST[$this->id] : null;
    }

    public function html() {
        echo "<select name='$this->id'>";
        foreach ($this->opciones as $opcion) {
            if (isset($_REQUEST[$this->id])) {
                $opcion->estaseleccionado($_REQUEST[$this->id] == $opcion->valor);
            }
            $opcion->html();
        }
        echo "</select>";
    }
}

// Clase validatebox
class validatebox extends textbox {
    protected $error_longitud = false;
    protected $error_numerico = false;
    protected $longitud;

    public function __construct($id, $valor = null, $longitud = 9999) {
        parent::__construct($id, $valor);
        $this->longitud = $longitud;
    }

    public function esValido() {
        $this->error_longitud = false;
        $this->error_numerico = false;

        if ($this->valor !== null && strlen($this->valor) > $this->longitud) {
            $this->error_longitud = true;
            return false;
        }

        if ($this->valor !== null && !is_numeric($this->valor)) {
            $this->error_numerico = true;
            return false;
        }

        return true;
    }

    public function html() {
        $mensaje = '';
        if ($this->esValido()) {
            $mensaje = '';
        } elseif ($this->error_longitud) {
            $mensaje = 'LONGITUD EXCEDIDA';
        } elseif ($this->error_numerico) {
            $mensaje = 'VALOR NO VALIDO';
        }

        echo "<input type='text' name='$this->id' value='$this->valor'>";
        if ($mensaje) {
            echo "<span style='margin-left: 10px; color: red;'>$mensaje</span>";
        }
    }
}

// Clase dni
class dni {
    private $numero;
    private $letra;

    public function __construct($dni) {
        if (is_string($dni) && strlen($dni) === 9) {
            $this->numero = substr($dni, 0, 8);
            $this->letra = strtoupper(substr($dni, -1));
        } else {
            $this->numero = null;
            $this->letra = null;
        }
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getLetra() {
        return $this->letra;
    }

    public function validar() {
        if ($this->numero === null || $this->letra === null) {
            return false;
        }

        if (!ctype_digit($this->numero)) {
            return false;
        }

        $resto = intval($this->numero) % 23;
        $letras = [
            0 => 'T', 1 => 'R', 2 => 'W', 3 => 'A', 4 => 'G', 5 => 'M', 6 => 'Y',
            7 => 'F', 8 => 'P', 9 => 'D', 10 => 'X', 11 => 'B', 12 => 'N',
            13 => 'J', 14 => 'Z', 15 => 'S', 16 => 'Q', 17 => 'V', 18 => 'H',
            19 => 'L', 20 => 'C', 21 => 'K', 22 => 'E'
        ];

        return $this->letra === $letras[$resto];
    }
}
?>