<?php
class Categoria_Milhagem {
    public $nome;
    public $pontos_minimo;

    public function __construct($nome, $pontos_minimo) {
        $this->nome = $nome;
        $this->pontos_minimo = $pontos_minimo;
    }
}
