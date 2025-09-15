<?php
require_once __DIR__ . "/../clases/tarifa_pizza.class.php";
require_once __DIR__ . "/../clases/tarifa_ingrediente.class.php";

$_pizzas = [];

$_pizzas["napolitana"]   = new TarifaPizza("Napolitana", 4.00, 4.50, 5.20);
$_pizzas["new york"]     = new TarifaPizza("New York", 4.20, 4.80, 5.50);
$_pizzas["pizza a taglio"] = new TarifaPizza("Pizza a Taglio", 5.20, 5.80, 6.50);
$_pizzas["argentina"]    = new TarifaPizza("Argentina", 6.00, 6.80, 7.20);
$_pizzas["chicago"]      = new TarifaPizza("Chicago", 4.20, 4.50, 5.00);
$_pizzas["sfincione"]    = new TarifaPizza("Sfincione", 5.80, 6.20, 6.50);


$_ingredientes = [];

$_ingredientes["anchoas"]    = new TarifaIngrediente("Anchoas", 0.25, 0.30);
$_ingredientes["atun"]       = new TarifaIngrediente("Atún", 0.25, 0.35);
$_ingredientes["queso"]      = new TarifaIngrediente("Queso extra", 0.40, 0.70);
$_ingredientes["jamon"]      = new TarifaIngrediente("Jamón", 0.50, 0.90);
$_ingredientes["bacon"]      = new TarifaIngrediente("Bacon", 0.60, 1.00);
$_ingredientes["pepperoni"]  = new TarifaIngrediente("Pepperoni", 0.50, 0.85);
$_ingredientes["champiñones"]= new TarifaIngrediente("Champiñones", 0.30, 0.55);
$_ingredientes["pimiento"]   = new TarifaIngrediente("Pimiento", 0.25, 0.45);
$_ingredientes["cebolla"]    = new TarifaIngrediente("Cebolla", 0.20, 0.40);
$_ingredientes["aceitunas"]  = new TarifaIngrediente("Aceitunas", 0.30, 0.50);
