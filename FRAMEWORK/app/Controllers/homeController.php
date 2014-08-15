<?

class home extends Controller
{
	public $img;

	public function init($params = null)
	{
		$this -> img = new Imagens_Model();
	}


	public function index_action($params = null)
	{
		$dados['imagens'] = $this -> img -> read(null, null, null, "created");
		$this->view('index', $dados);
	}

}

?>