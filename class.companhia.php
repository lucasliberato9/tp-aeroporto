<?
class Companhia {

    private string $nome;
    private string $codigo;
    private string $razao_social;
    private int $cnpj;
    private string $sigla;
    //A sigla deve ser formada por duas letras.

    public function __constructor(string $p_nome, string $p_codigo, string $p_razao_social, int $p_cnpj, 
    string $p_sigla) {
        
        $this->nome = $p_nome;
        $this->codigo = $p_codigo;
        $this->razao_social = $p_razao_social;
        $this->cnpj = $p_cnpj;
        $this->sigla = $p_sigla;

    }

}
?>