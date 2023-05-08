<?php
include_once("class.companhia.php");
include_once("class.aeronave.php");
include_once("class.viagem.php");
include_once("class.aeroporto.php");

class Voo extends persist
{

  private Aeroporto $origem;
  private Aeroporto $destino;
  private string $previsao_partida;
  //tem que ser string porque não tem dia na previsão
  private Companhia $companhia;
  private string $frequencia;
  private Aeronave $aeronave;
  private int $duracao_estimada;
  private array $viagens_programadas;
  private array $viagens_realizadas;
  private string $codigo;

  static $local_filename = "voo.txt";

  function validar_codigo_voo($codigo, $sigla_companhia)
  {
    $pattern = "/^" . $sigla_companhia . "[A-Z]{2}\d{4}$/";

    if (preg_match($pattern, $codigo)) {
      return true;
    } else {
      return false;
    }
  }

  public function __construct(
    Aeroporto $p_origem,
    Aeroporto $p_destino,
    string $p_previsao_partida,
    Companhia $p_companhia,
    string $p_frequencia,
    Aeronave $p_aeronave,
    int $p_duracao_estimada,
    array $p_viagens_programadas,
    array $p_viagens_realizadas,
    string $p_codigo
  ) {
    $this->origem = $p_origem;
    $this->destino = $p_destino;
    $this->previsao_partida = $p_previsao_partida;
    $this->companhia = $p_companhia;
    $this->frequencia = $p_frequencia;
    $this->aeronave = $p_aeronave;
    $this->duracao_estimada = $p_duracao_estimada;
    $this->viagens_programadas = $p_viagens_programadas;
    $this->viagens_realizadas = $p_viagens_realizadas;
    $sigla_companhia = $this->$p_companhia->pegar_sigla();
    if ($this->validar_codigo_voo($p_codigo, $sigla_companhia)) {
      echo "Código válido";
      $this->codigo = $p_codigo;
    } else {
      echo "Código inválido";
      exit;
    }

    $p_origem->adicionar_voo($this);
  }

  public function programar_viagem(Viagem $p_viagem)
  {
    array_push($this->viagens_programadas, $p_viagem);
  }
  public function adicionar_viagem_realizada(Viagem $p_viagem)
  {
    // Busca o índice da viagem dentro da array de viagens programadas
    $index = array_search($p_viagem, $this->viagens_programadas);

    // Se a viagem existe no array, remove ela
    if ($index !== false) {
      array_splice($this->viagens_programadas, $index, 1);
    }

    // Adiciona a viagem no array de viagens realizadas
    $this->viagens_realizadas[] = $p_viagem;
  }
  public function pegar_origem()
  {
    return $this->origem;
  }
  public function pegar_destino()
  {
    return $this->destino;
  }
  public function pegar_viagens_programadas()
  {
    return $this->viagens_programadas;
  }
  public function pegar_preco_bagagem()
  {
    return $this->companhia->pegar_preco_bagagem();
  }
  static public function getFilename() {
    return get_called_class()::$local_filename;
  }
}
