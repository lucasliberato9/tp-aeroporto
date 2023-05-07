<?php
class Categoria_Milhagem {
    private $nome;
    private $pontos_minimo;

    public function __construct($nome, $pontos_minimo) {
        $this->nome = $nome;
        $this->pontos_minimo = $pontos_minimo;
    }
}
