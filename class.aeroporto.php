<?
include_once("class.voo.php");
class Aeroporto
{

    private string $sigla;
    //Deve ter três letras.
    private string $cidade;
    private string $estado;
    private array $voos;

    public function __construct(string $p_sigla, string $p_cidade, string $p_estado)
    {
        $this->sigla = $p_sigla;
        $this->cidade = $p_cidade;
        $this->estado = $p_estado;
    }
    public function adicionar_voo(Voo $p_voo)
    {
        array_push($this->voos, $p_voo);
    }
    public function pegar_voos()
    {
        return $this->voos;
    }
    public function pegar_sigla()
    {
        return $this->sigla;
    }
}
