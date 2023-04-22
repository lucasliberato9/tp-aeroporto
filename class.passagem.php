<?php

include_once("class.aeroporto.php");
include_once("class.viagem.php");
include_once("class.voo.php");

class Passagem
{
    private Aeroporto $aeroporto_origem;
    private Aeroporto $aeroporto_destino;
    private array $assentos;
    private array $viagens;
    private float $total_franquia_bagagem;
    private float $preco_total;
    private string $comprador;

    function verificar_voos(Aeroporto $p_aeroporto)
    {
        $voo_encontrado = false;
        $voos = $p_aeroporto->pegar_voos();
        for ($i = 0; $i < count($voos); $i++) {
            if ($voos[$i]->pegar_destino() === $this->aeroporto_destino) {
                $voo_encontrado = true;
                return $voos[$i];
            }
        }
        if ($voo_encontrado === false) {
            return false;
        }
    }
    function selecionar_viagem(Voo $p_voo)
    {
        $viagens_programadas = $p_voo->pegar_viagens_programadas();
        if (count($viagens_programadas) === 0) {
            echo "Não existem viagens disponíveis!";
            return false;
        }
        echo "Os possíveis horários de partida para o seu destino são:\n";
        foreach ($viagens_programadas as $index => $viagem) {
            echo ($index + 1) . ". " . $viagem->pegar_data_hora_partida() . "\n";
        }
        while (true) {
            echo "Digite o número da lista referente ao horário desejado: ";
            $numero_lista = intval(fgets(STDIN));

            // verifique se o número digitado é válido
            if ($numero_lista < 1 || $numero_lista > count($viagens_programadas)) {
                echo "Número inválido. Por favor, digite novamente.\n";
                continue; // continue o loop
            }

            // recupere a viagem selecionada pelo usuário
            $viagem_selecionada = $viagens_programadas[$numero_lista - 1];
            break; // saia do loop
        }
        return $viagem_selecionada;
    }
    function verificar_conexão(Viagem $p_viagem_selecionada, Voo $voo_conexao)
    {
        $conexao_encontrada = false;
        $data_chegada = $p_viagem_selecionada->pegar_data_hora_chegada();
        $viagens_disponiveis = $voo_conexao->pegar_viagens_programadas();
        for ($i = 0; $i < count($viagens_disponiveis); $i++) {
            if ($data_chegada <=> $viagens_disponiveis[$i]->pegar_data_hora_partida() < 0) {
                $conexao_encontrada = true;
                return $viagens_disponiveis[$i];
            }
        }
        if ($conexao_encontrada === false) {
            return false;
        }
    }
    public function __construct(
        Aeroporto $p_aeroporto_origem,
        Aeroporto $p_aeroporto_destino,
        array $p_franquia_bagagem,
        string $p_comprador
    ) {

        $this->aeroporto_origem = $p_aeroporto_origem;
        $this->aeroporto_destino = $p_aeroporto_destino;
        $total_bagagem = 0;
        if ($this->verificar_voos($p_aeroporto_origem) !== false) {
            $voo_desejado = $this->verificar_voos($p_aeroporto_origem);
            $preco_bagagem = $voo_desejado->pegar_preco_bagagem();
            foreach ($p_franquia_bagagem as $index => $franquia) {
                if ($franquia > 23) {
                    echo "Bagagens so são permitidas até 23KG.";
                    exit;
                }
                $total_bagagem = +$total_bagagem + (+$franquia * +$preco_bagagem);
            }
            $this->total_franquia_bagagem = $total_bagagem;
            $viagem_selecionada = $this->selecionar_viagem($voo_desejado);
            if ($viagem_selecionada === false) {
                echo "Não existem viagens programadas para o seu destino a partir do seu aeroporto de partida no momento!";
                exit;
            }
            array_push($this->viagens, $viagem_selecionada);
        } else {
            //implementação para apenas 1 conexão
            $voos_origem = $p_aeroporto_origem->pegar_voos();
            $voo_encontrado = false;
            for ($i = 0; $i < count($voos_origem); $i++) {
                $aux = $this->verificar_voos($voos_origem[$i]->pegar_destino());
                if ($aux !== false) {
                    $primeiro_preco_bagagem = $voos_origem[$i]->pegar_preco_bagagem();
                    $segundo_preco_bagagem = $aux->pegar_preco_bagagem();
                    foreach ($p_franquia_bagagem as $index => $franquia) {
                        if ($franquia > 23) {
                            echo "Bagagens so são permitidas até 23KG.";
                            exit;
                        }
                        $total_bagagem = +$total_bagagem + (+$franquia * +$primeiro_preco_bagagem);
                        $total_bagagem = +$total_bagagem + (+$franquia * +$segundo_preco_bagagem);
                    }
                    $this->total_franquia_bagagem = $total_bagagem;
                    $voo_encontrado = true;
                    $viagem_selecionada = $this->selecionar_viagem($voos_origem[$i]);
                    $viagem_conexao = $this->verificar_conexão($viagem_selecionada, $aux);
                    if ($viagem_conexao === false) {
                        echo "Não foram encontradas conexões ou viagens diretas a partir do horario de partida selecionado!";
                        exit;
                    } else {
                        array_push($this->viagens, $viagem_selecionada);
                        array_push($this->viagens, $viagem_conexao);
                    }
                }
            }
            if ($voo_encontrado === false) {
                echo "Não foi encontrados voos de conexão para o seu destino!";
                exit;
            }
        }
        $num_viagens = count($this->viagens);
        if ($num_viagens > 1) {
            echo "Você possui " . $num_viagens - 1 . " conexão(ôes).";
        }
        echo "Você precisa selecionar " . $num_viagens . " assentos.";
        $total_assentos = 0;
        foreach ($this->viagens as $index => $viagem) {
            $assentoValido = false;
            $total_assentos = $total_assentos + +$viagem->pegar_preco_assento();

            while (!$assentoValido) {
                echo "Selecione um assento no formato: '00', onde o primeiro número representa a fileira desejada e o segundo representa a coluna (estando entre 0 e 3) ou digite NÃO para não selecionar assento para esse voo:";
                $assentos_disponiveis = $viagem->pegar_assentos_disponiveis();
                // lê a linha digitada pelo usuário
                $linha = fgets(STDIN);

                // remove quebras de linha e espaços em branco do início e do fim da string
                $linha = trim($linha);
                if ($linha === "NÃO") {
                    array_push($this->assentos, $assentos_disponiveis[0]);
                    break;
                }
                // verifica se o valor digitado é válido
                if (preg_match('/^\d{2}$/', $linha)) {
                    // o valor digitado é válido
                    $fileira = $linha[0];
                    $coluna = $linha[1];

                    // faça algo com os valores de $fileira e $coluna aqui

                    if (in_array($linha, $assentos_disponiveis)) {
                        // o assento digitado é válido
                        $assentoValido = true;
                        array_push($this->assentos, $linha);
                    }
                } else {
                    // o valor digitado não é válido
                    echo "Valor digitado inválido ou assento indisponível. Por favor, digite novamente.\n";
                }
            }
        }
        $this->preco_total = +$total_assentos + +$total_bagagem;
        $this->comprador = $p_comprador;
    }
}