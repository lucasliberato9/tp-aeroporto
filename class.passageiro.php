<?
include_once("class.aeroporto.php");
include_once("class.passagem.php");
include_once("class.voo.php");

include_once("validacao.php");

class Passageiro
{

    private string $nome;
    private string $sobrenome;
    private string $documento_identificacao;
    private string $nacionalidade;
    private string $data_nascimento;
    private string $email;
    private string $cpf;
    private bool $vip;

    private array $passagens;
    private array $historico_voos;

    private bool $franquia_adicional = false;
    private bool $gratuidade_alteracao = false;
    private float $desconto_franquia = 0;

    public function __construct(
        string $p_nome,
        string $p_sobrenome,
        string $p_documento_identificacao,
        string $p_nacionalidade,
        string $p_data_nascimento,
        string $p_email,
        string $p_cpf,
        bool $p_vip
    ) {
        $this->nome = $p_nome;
        $this->sobrenome = $p_sobrenome;
        $this->documento_identificacao = $p_documento_identificacao;
        $this->nacionalidade = $p_nacionalidade;
        if (!validarDataNascimento($p_data_nascimento)) throw new Exception("Data inválida.");
        $this->data_nascimento = $p_data_nascimento;
        if (!validarEmail($p_email)) throw new Exception("Email inválido.");
        $this->email = $p_email;
        if (!validar_cpf($p_cpf)) throw new Exception("CPF inválido.");
        $this->cpf = $p_cpf;
        $this->vip = $p_vip;

        if ($this->vip == true)
        {
            $this->franquia_adicional = true;
            $this->gratuidade_alteracao = true;
            $this->desconto_franquia = 0.5;
        }
    }
    public function adicionar_passagem(Passagem $passagem)
    {
        array_push($passagens, $passagem);
    }
    public function acessar_historico_voos()
    {
        //implementar em outro momento
    }
    public function verificar_checkins() {
        foreach ($this->passagens as $passagem) {
            if (!$passagem->fez_checkin() && $passagem->intervalo_checkin()) {
                $checkin = (bool) readline("Deseja fazer checkin da passagem {$passagem->pegar_data()} | {$passagem->pegar_origem()->pegar_sigla()} -> {$passagem->pegar_destino()->pegar_sigla()}?");
                if ($checkin) {
                    $passagem->confirmar_checkin();
                }
            }
        }
    }
    public function alterar_voo()
    {
        //implementar em outro momento
    }
    public function cancelar_voo()
    {
        //implementar em outro momento
    }

}