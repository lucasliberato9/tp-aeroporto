<?php
include_once("class.passageiro.php");
include_once("class.categoria_milhagem.php");

class Passageiro_VIP extends Passageiro
{
    private int $numero_registro;
    private Categoria_Milhagem $milhagem_favorito;
    private string $categoria_milhagem;
    private int $pontos_acumulados;
    private DateTime $data_inicio_categoria;
    private DateTime $data_expiracao_categoria;

    public function __construct(
        string $p_nome,
        string $p_sobrenome,
        string $p_documento_identificacao,
        string $p_nacionalidade,
        string $p_data_nascimento,
        string $p_email,
        string $p_cpf,
        bool $p_vip,
        Categoria_Milhagem $p_milhagem_favorito,
        int $p_numero_registro, 
        int $p_pontos_acumulados, 
        DateTime $p_data_inicio_categoria, 
        DateTime $p_data_expiracao_categoria
    ) 
    {
        parent::__construct($p_nome, $p_sobrenome, $p_documento_identificacao, $p_nacionalidade, $p_data_nascimento, $p_email, $p_cpf, $p_vip);
        $this->numero_registro = $p_numero_registro;
        $this->milhagem_favorito = $p_milhagem_favorito; 
        $this->pontos_acumulados = $p_pontos_acumulados;
        $this->data_inicio_categoria = $p_data_inicio_categoria;
        $this->data_expiracao_categoria = $p_data_expiracao_categoria;
    }

}