<?php
include_once("class.companhia.php");

class Aeronave extends persist
{

    private string $fabricante;
    private string $modelo;
    private int $capacidade_passageiros;
    private float $capacidade_carga;
    private string $registro_aeronave;
    private Companhia $companhia;
    
    static $local_filename = "aeronave.txt";
    //Registro da aeronave
    //Composto pelo prefixo, que contém duas letras
    //Um hífen
    //Seguido de três letras
    //(Ex.: PR-GUO)
    //No Brasil, somente são permitidos para voos comerciais os prefixos PT,
    //PR, PP, PS, que devem ser validados.

    public function __construct(
        string $p_fabricante,
        string $p_modelo,
        int $p_capacidade_passageiros,
        float $p_capacidade_carga,
        string $p_registro_aeronave,
        Companhia $p_companhia
    ) {

        $this->fabricante = $p_fabricante;
        $this->modelo = $p_modelo;
        $this->capacidade_passageiros = $p_capacidade_passageiros;
        $this->capacidade_carga = $p_capacidade_carga;
        $this->registro_aeronave = $p_registro_aeronave;
        $this->companhia = $p_companhia;
    }
    public function pegar_capacidade()
    {
        return $this->capacidade_passageiros;
    }
    static public function getFilename() {
        return get_called_class()::$local_filename;
    }
}
