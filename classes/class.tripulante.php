<?php
include_once("class.companhia.php");
include_once("class.aeroporto.php");

class Tripulante{
    private string $nome;
    private string $sobrenome;
    private string $documento_identificacao;
    private string $nacionalidade;
    private string $data_nascimento;
    private string $email;
    private string $cpf;
    private string $CHT;
    private string $endereco;
    private Companhia $companhia_aerea;
    private Aeroporto $aeroporto_base;
    private string $cargo;

    public function __construct(string $nome, string $sobrenome, string $documento_identificacao, string $nacionalidade, string $data_nascimento, string $email, string $cpf, string $CHT, string $endereco, Companhia $companhia_aerea, Aeroporto $aeroporto_base, string $cargo){
        $this->$nome = $nome;
        $this->$sobrenome = $sobrenome;
        $this->$documento_identificacao = $documento_identificacao;
        $this->$nacionalidade = $nacionalidade;
        $this->$data_nascimento = $data_nascimento;
        $this->$email = $email;
        $this->$cpf = $cpf;
        $this->$CHT = $CHT;
        $this->$endereco = $endereco;
        $this->$companhia_aerea = $companhia_aerea;
        $this->$aeroporto_base = $aeroporto_base;
        $this->$cargo = $cargo;
    }

}