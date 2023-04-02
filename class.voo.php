<?
include_once DateTime;
include_once("class.companhia_aerea.php");
include_once("class.aeronave.php");

class Voo {
    
    //DÚVIDA: CÓDIGO EM VOO OU EM VIAGEM?
    private string $origem;
    private string $destino;
    private DateTime $horario_partida;
    private Companhia_Aerea $companhia_aerea;
    private string $frequencia;
    private Aeronave $aeronave;
    private int $duracao_estimada;

    public function __constructor(string $p_origem, string $p_destino, DateTime $p_horario_partida, 
    Companhia_Aerea $p_companhia_aerea, string $p_frequencia, Aeronave $p_aeronave, int $p_duracao_estimada) {

        $this->origem = $p_origem;
        $this->destino = $p_destino;
        $this->horario_partida = $p_horario_partida;    
        $this->companhia_aerea = $p_companhia_aerea;
        $this->frequencia = $p_frequencia;
        $this->aeronave = $p_aeronave;
        $this->duracao_estimada = $p_duracao_estimada;

    }

}
?>