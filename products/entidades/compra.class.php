<?php 

class Compra {
    protected $comprador;
    protected $mail;
    protected $productos;

    public function __construct($_comprador, $_mail, $_productos = []) {
               $this->comprador = $_comprador;
        $this->mail = $_mail;
        $this->productos = $_productos;
    }
       public function getComprador() {
        return $this->comprador;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getProductos() {
        return $this->productos;
    }

    public function calcularImporte() {
        $total = 0;
        foreach ($this->productos as $prod) {
            $total += $prod['importe'];
        }
        return $total;
    }

    public function calcularImporteIva($_iva = 21) {
        $bruto = $this->calcularImporte();
        return $bruto + ($bruto * ($_iva / 100));
    }

    // Devuelve la compra en formato JSON (para registrar)
    public function toArray() {
        return [
            "comprador" => $this->comprador,
            "mail"      => $this->mail,
            "productos" => $this->productos
        ];
    }
}
?>