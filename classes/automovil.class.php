<?php 

class Automovil {
    private $marca;
    private $matricula;
    private $modelo;
    private $combustible;


    public function __construct($marca, $matricula, $modelo, $combustible) {
        $this->marca= $marca;
        $this->matricula= $matricula;
        $this->modelo= $modelo;
        $this->combustible= $combustible;
    }

    public function mostrarVehiculos() {
            echo "<tr>";
            echo "<td><strong>Matrícula:</strong> " . htmlspecialchars($this->matricula) . "</td>";
            echo "<td><strong>Marca:</strong> " . htmlspecialchars($this->marca) . "</td>";
            echo "<td><strong>Modelo:</strong> " . htmlspecialchars($this->modelo) . "</td>";
            echo "<td><strong>Combustible:</strong> " . htmlspecialchars($this->combustible) . "</td>";
            echo "</tr>";
            
    }
}


?>