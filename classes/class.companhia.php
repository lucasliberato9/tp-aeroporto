<?php
class Companhia
{

    private string $nome;
    private string $codigo;
    private string $razao_social;
    private int $cnpj;
    private string $sigla;
    //A sigla deve ser formada por duas letras.
    private float $preco_bagagem; //o preço é pensado em qual o preço por quilo de passagem

    public function __construct(
        string $p_nome,
        string $p_codigo,
        string $p_razao_social,
        int $p_cnpj,
        string $p_sigla,
        float $p_preco_bagagem
    ) {

        $this->nome = $p_nome;
        $this->codigo = $p_codigo;
        $this->razao_social = $p_razao_social;
        $this->cnpj = $p_cnpj;
        $this->sigla = $p_sigla;
        $this->preco_bagagem = $p_preco_bagagem;
    }
    public function pegar_preco_bagagem()
    {
        return $this->preco_bagagem;
    }
    public function pegar_sigla()
    {
        return $this->sigla;
    }
}
