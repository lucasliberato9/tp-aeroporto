<?php
include_once("class.voo.php");
class Aeroporto extends persist
{

    private string $sigla;
    //Deve ter três letras.
    private string $cidade;
    private string $estado;
    private array $voos;
    
    static $local_filename = "aeroporto.txt";

    public function __construct(string $p_sigla, string $p_cidade, string $p_estado)
    {
        $this->sigla = $p_sigla;
        $this->cidade = $p_cidade;
        $this->estado = $p_estado;
    }
    public function adicionar_voo(Voo $p_voo)
    {
        array_push($this->voos, $p_voo);
    }
    public function pegar_voos()
    {
        return $this->voos;
    }
    public function pegar_sigla()
    {
        return $this->sigla;
    }
    static public function getFilename() {
        return get_called_class()::$local_filename;
    }
}
