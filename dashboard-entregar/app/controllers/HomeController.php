<?php

/**
 * home - Controller de exemplo
 * @author Cândido Farias
 * @package mvc
 * @since 0.1
 */
class HomeController extends MainController
{

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['user'])){
			header("Location:".URL_BASE."users/login");
		}
	}

	/**
	 * Carrega a página "/views/home/index.php"
	 */
    public function index() {
		# Título da página
		$this->title = 'Home';
		$model=$this->load_model("Home");
		$mostraValores=$model->valoresLer();
		$data['home']=$mostraValores;
		
		
		# Essa página não precisa de modelo (model)
		
		# Carrega os arquivos do view		
		$this->view->show('home/home', null);
	
		
    } // index
	public function graficoInput($dataInput){
		$model=$this->load_model("Home");
		$dias=$model->input($dataInput);
		$dados['input']=$dias;
		$diasExplode=explode("-", $dias);
		printf($diasExplode);
		$this->view->show('home/home',$dados);
	}

	
} // class HomeController