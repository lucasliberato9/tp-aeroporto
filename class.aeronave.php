<?
class Aeronave {

    private string $fabricante;
    private string $modelo;
    private int $capacidade_passageiros;
    private float $capacidade_carga_kg;
    private string $registro;
    //Registro da aeronave
    //Composto pelo prefixo, que contém duas letras
    //Um hífen
    //Seguido de três letras
    //(Ex.: PR-GUO)
    //No Brasil, somente são permitidos para voos comerciais os prefixos PT,
    //PR, PP, PS, que devem ser validados.
    
    public function __constructor(string $p_fabricante, string $p_modelo, int $p_capacidade_passageiros, 
    float $p_capacidade_carga_kg, string $p_registro) {
        
        $this->fabricante = $p_fabricante;
        $this->modelo = $p_modelo;
        $this->capacidade_passageiros = $p_capacidade_passageiros;
        $this->capacidade_carga_kg = $p_capacidade_carga_kg;
        $this->registro = $p_registro;

    }
}
?>