<?php
class Cliente extends persist
{

    private string $nome;
    private string $sobrenome;
    private string $documento_identificacao;

    static $local_filename = "cliente.txt";

    public function __construct(string $p_nome, string $p_sobrenome, string $p_documento_identificacao)
    {
        $this->nome = $p_nome;
        $this->sobrenome = $p_sobrenome;
        $this->documento_identificacao = $p_documento_identificacao;
    }
    static public function getFilename() {
        return get_called_class()::$local_filename;
    }
}
