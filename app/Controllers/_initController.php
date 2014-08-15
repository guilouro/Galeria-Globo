<?

class _init extends Controller
{

	public function index_action($params = null)
	{

		

		$this -> _layout = 'login';

		$dados = '';

		if($_POST)
		{
			$host  = $_POST['host'];
			$user  = $_POST['user'];
			$senha = $_POST['senha'];
			$banco = "galeria-globo";



			$link = mysql_connect($host, $user, $senha);
			if (!$link) {
			    die('Não foi possível conectar: ' . mysql_error());
			}

			mysql_query("CREATE DATABASE `{$banco}`");
			mysql_select_db($banco);


			mysql_query("CREATE TABLE IF NOT EXISTS `developer` (
			  `id_developer` int(11) NOT NULL AUTO_INCREMENT,
			  `nome` varchar(45) DEFAULT NULL,
			  `login` varchar(45) DEFAULT NULL,
			  `senha` varchar(128) DEFAULT NULL,
			  PRIMARY KEY (`id_developer`),
			  UNIQUE KEY `login_UNIQUE` (`login`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3");

			mysql_query("CREATE TABLE IF NOT EXISTS `imagens` (
			  `id_imagens` int(11) NOT NULL AUTO_INCREMENT,
			  `imagem` varchar(250) NOT NULL,
			  `created` datetime NOT NULL,
			  PRIMARY KEY (`id_imagens`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10");

			#--
			#-- Extraindo dados da tabela `imagens`
			#--

			mysql_query("INSERT INTO `imagens` (`id_imagens`, `imagem`, `created`) VALUES
			(1, '763fc6fafe22fa61468394cdca77460bimg1.jpg', '2014-08-15 00:34:54'),
			(2, 'ac768c76ecb8279da0c9edadc69396b7img2.jpg', '2014-08-15 00:35:15'),
			(3, '99427c40bca9ca9cb3c2f76bcfc76d8aimg3.jpg', '2014-08-15 00:35:20'),
			(4, '2a4774c87e4f23c4a19ab2d7e4e51739img4.jpg', '2014-08-15 00:35:25'),
			(6, '3552250949ac108f33acb2cdc9dbdbeaimg6.jpg', '2014-08-15 00:35:34'),
			(7, '9d4469a5839f5a705bdbd8c097050838img7.jpg', '2014-08-15 00:35:40'),
			(8, 'bd1afdd92a36bb468dcb737ea25c564dimg5.jpg', '2014-08-15 01:01:20')");


			$ok = mysql_query("INSERT INTO `developer` (`id_developer`, `nome`, `login`, `senha`) VALUES
			(1, 'Guilherme Louro', 'guilherme', '683cd4656571ca9a619e7b51cb8be1ba6c3412012aede21c9c45468b1d2ab52ecda7fc27f323dd0eb10071367fafa1e0d7d2202cf7081af32b3cbbd1c33d691c')");

			$dados['status'] = $this -> retorno($ok);
		}

		$this->view('index', $dados);
	}


	private function retorno($ok)
	{
		

		if($ok)
		{
			$file = ROOT . DS . APP_DIR . DS . "Config" . DS . "database.php";

			$text = "<?php\n";
			$text .= "	class DATABASE_CONFIG\n";
			$text .= "	{\n";
			$text .= "		public static \$default = array(\n";
			$text .= "			'host' => '{$_POST['host']}',\n";
			$text .= "			'login' => '{$_POST['user']}',\n";
			$text .= "			'senha' => '{$_POST['senha']}',\n";
			$text .= "			'banco' => 'galeria-globo',\n";
			$text .= "		);\n";
			$text .= "	}";

			$f = fopen($file, "w+");
			fwrite($f, $text);
			fclose($f);

			header("location:" . URL);
		}
		else
		{
			return 'Erro ao criar banco de dados!';
		}


	}

}

?>