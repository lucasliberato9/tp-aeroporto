<?
class Cliente
{

    private string $nome;
    private string $sobrenome;
    private string $documento_identificacao;

    public function __construct(string $p_nome, string $p_sobrenome, string $p_documento_identificacao)
    {
        $this->nome = $p_nome;
        $this->sobrenome = $p_sobrenome;
        $this->documento_identificacao = $p_documento_identificacao;
    }
}
