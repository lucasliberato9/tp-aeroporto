<?
include_once DateTime;
include_once("class.companhia.php");
include_once("class.aeronave.php");
include_once("class.viagem.php");
include_once("class.aeroporto.php");

class Voo {
    
    private string $codigo;
    private Aeroporto $origem;
    private Aeroporto $destino;
    private string $previsao_partida;
    private Companhia $companhia;
    private string $frequencia;
    private Aeronave $aeronave;
    private int $duracao_estimada;

    private array $viagens_realizadas = array();

    public function __constructor(string $p_codigo, Aeroporto $p_origem, Aeroporto $p_destino, 
    string $p_previsao_partida, Companhia $p_companhia, string $p_frequencia, Aeronave $p_aeronave, 
    int $p_duracao_estimada) {

        $this->codigo = $p_codigo;
        $this->origem = $p_origem;
        $this->destino = $p_destino;
        $this->previsao_partida = $p_previsao_partida;    
        $this->companhia = $p_companhia;
        $this->frequencia = $p_frequencia;
        $this->aeronave = $p_aeronave;
        $this->duracao_estimada = $p_duracao_estimada;

    }

  public function adiciona_viagem() {
    //IMPLEMENTAR
  }

}
?>