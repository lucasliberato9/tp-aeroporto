<?php
require_once("global.php");

$companhia1 = new Companhia("Nome 1", "Codigo Teste", "Razao Social Teste", 12345678000112, "SIG", 6.50);

if(1)
{
    $aeronave1 = new Aeronave("Fabricante 1", "Modelo 1", 180, 1000.5, "Registro Teste", $companhia1);
    $aeronave1->save();
}
if(0)
{
    $aeronaves = Aeronave::getRecords();
    print_r($aeronaves);
}

