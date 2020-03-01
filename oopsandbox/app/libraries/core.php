<?php
	/* 
		*App Core Class
		*Creates URL & loads core controller
		*URL FORMAT - /controller/method/params
	*/
	class Core {
		protected $currentController = 'Pages';
		protected $currentMethod = 'index';
		protected $params = [];

		public function __construct(){
			//print_r($this->getUrl());

			$url=$this->getUrl();

			// Look in controllers for first value in url
			if (file_exists('../app/controllers/' . ucwords($url[0]).'.php')) {
				//If exists, set as controller
				$this->currentController = ucwords($url[0]);
				//Tirar a url já atualizada do index 0
				unset($url[0]);
			}

			//Require the controller
			require_once '../app/controllers/' . $this->currentController . '.php';

			//Instanciar a classe controller
			$this->currentController = new $this->currentController;
		}

		public function getUrl(){
			
			//PRIMEIRO VERIFICA A EXISTENCIA DE MAIS CARACTERES NA URL
			if (isset($_GET['url'])) {
				//TROCA ESPAÇOES EM BRANCO NA URL PELA BARRA
				$url = rtrim($_GET['url'], '/');
				//VAI FILTRAR NA URL CARACTERES ESPECIAIS
				$url = filter_var($url, FILTER_SANITIZE_URL);
				//VAI TRANSFORMAR AS BARRAS DA URL EM MATRIZES *cada elemento após uma barra corresponderá à alguma ação
				$url = explode('/', $url);
				return $url;
			}


		}

	}
