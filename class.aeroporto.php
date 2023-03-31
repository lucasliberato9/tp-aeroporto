<?
class Aeroporto {
    
    private string $sigla;
    //Deve ter três letras.
    private string $cidade;
    private string $estado;

    public function __constructor(string $p_sigla, string $p_cidade, string $p_estado) {

        $this->sigla = $p_sigla;
        $this->cidade = $p_cidade;
        $this->estado = $p_estado;

    }

}
?>