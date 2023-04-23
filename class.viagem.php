<?
include_once("class.aeronave.php");

class Viagem
{
    private string $relatorio;
    private DateTime $data_hora_partida;
    private DateTime $data_hora_chegada;
    private Aeronave $aeronave;
    private array $assentos_disponiveis;
    private float $preco_assento;
    private array $passagens;


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
}
