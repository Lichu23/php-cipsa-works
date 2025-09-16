<?php 
require_once __DIR__ . '/htmlrenderable.interface.php';

class Tabla implements HtmlRenderable {
    protected $id;
    protected $columns = array();
    protected $datos = array();

    public function __construct($_columns = [], $_datos = [], $_id = "tabla1") {
        $this->id = $_id;
        $this->columns = $_columns;
        $this->datos = $_datos;
    }

    public function setValores($datos) {
        $this->datos = $datos;
    }

    public function html() {
        $html = "<table border='1' cellpadding='5' cellspacing='0'>";

        // Cabecera
        if (!empty($this->columns)) {
            $html .= "<tr>";
            foreach ($this->columns as $col) {
                $html .= "<th>" . htmlspecialchars($col) . "</th>";
            }
            $html .= "</tr>";
        }

        // Filas
        foreach ($this->datos as $fila) {
            $html .= "<tr>";
            foreach ($fila as $celda) {
                $html .= "<td>" . htmlspecialchars($celda) . "</td>";
            }
            $html .= "</tr>";
        }

        $html .= "</table>";
        return $html;
    }
}
?>
