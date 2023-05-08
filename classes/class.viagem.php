<?php
include_once("class.aeronave.php");
include_once("class.passagem.php");
include_once("class.tripulante.php");
class Viagem extends persist
{
    private string $relatorio;
    private DateTime $data_hora_partida;
    private DateTime $data_hora_chegada;
    private Aeronave $aeronave;
    private array $assentos_disponiveis;
    private float $preco_assento;
    private array $passagens;
    private array $tripulantes = array('Piloto' => null, 'Co-Piloto' => null, 'Comissário' => array());

    static $local_filename = "viagem.txt";

    public function __construct(string $p_relatorio, DateTime $p_data_hora_partida, DateTime $p_data_hora_chegada, Aeronave $p_aeronave, float $p_preco_assento)
    {
        $this->relatorio = $p_relatorio;
        $this->data_hora_partida = $p_data_hora_partida;
        $this->data_hora_chegada = $p_data_hora_chegada;
        $this->aeronave = $p_aeronave;
        $this->assentos_disponiveis = array();
        $contador_fileira = 0;
        $contador_coluna = 0;
        for ($i = 0; $i < $p_aeronave->pegar_capacidade(); $i++) {
            array_push($this->assentos_disponiveis, strval($contador_fileira) . strval($contador_coluna));
            if ($contador_coluna === 3) {
                $contador_coluna = 0;
                $contador_fileira++;
            } else {
                $contador_coluna++;
            }
        }
        $this->preco_assento = $p_preco_assento;
    }
    public function pegar_assentos_disponiveis()
    {
        return $this->assentos_disponiveis;
    }
    public function pegar_data_hora_partida()
    {
        return $this->data_hora_partida;
    }
    public function pegar_data_hora_chegada()
    {
        return $this->data_hora_chegada;
    }
    public function pegar_preco_assento()
    {
        return $this->preco_assento;
    }
    public function adicionar_passagem($p_passagem)
    {
        array_push($this->passagens, $p_passagem);
    }
    public function confirmar_embarque($p_passageiro)
    {
        foreach ($this->passagens as $passagem) {
            $passageiro = $passagem->pegar_passageiro();
            if ($passageiro === $p_passageiro) {
                $passagem->embarcar_passageiro();
                echo "O embarque foi confirmado!";
                return;
            }
        }
        echo "Não foi possivel confirmar o embarque, passageiro não encontrado!";
    }
    public function iniciar_voo()
    {
        foreach ($this->passagens as $passagem) {
            if (!$passagem->fez_embarque())
            {
                $passagem->confirmar_noshow();
            }
        }
    }
    public function validar_cargos(string $cargo) {
        if (!array_key_exists($cargo, $this->tripulantes)) {
            throw new Exception('Cargo Inválido. Os cargos são: Piloto, Co-Piloto e Comissário');
        }
        if ($cargo != 'Comissário' && $this->tripulantes[$cargo] != null) {
            throw new Exception('O cargo ' . $cargo . ' já está ocupado');
        }
    }

    public function adicionar_tripulante(string $nome, string $sobrenome, string $documento_identificacao, string $nacionalidade, string $data_nascimento, string $email, string $cpf, string $CHT, string $endereco, Companhia $companhia_aerea, Aeroporto $aeroporto_base, string $cargo) {
        $this->validar_cargos($cargo);
        $tripulante = new Tripulante($nome, $sobrenome, $documento_identificacao, $nacionalidade, $data_nascimento, $email, $cpf, $CHT, $endereco, $companhia_aerea, $aeroporto_base, $cargo);
        if ($cargo != 'Comissário') {
            $this->tripulantes[$cargo] = $tripulante;
        } else {
            array_push($this->tripulantes[$cargo], $tripulante);
        }
    }

    public function validar_viagem() {
        if ($this->tripulantes['Piloto'] == null) {
            throw new Exception('Viagem sem piloto');
        }
        if ($this->tripulantes['Co-Piloto'] == null) {
            throw new Exception('Viagem sem Co-Piloto');
        }
        if (count($this->tripulantes['Comissário']) <= 2) {
            throw new Exception('Viagem sem Comissários suficientes');
        }
    }
    static public function getFilename() {
        return get_called_class()::$local_filename;
    }
}
