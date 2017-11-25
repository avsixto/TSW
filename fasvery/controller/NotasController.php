<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Nota.php");
require_once(__DIR__."/../model/NotaMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
*Controller to users, logout and user registration
**/

class NotasController extends BaseController {
	
	private $NotaMapper;
	
	/**
	* Obtiene la conexion
	* Crea el mapper del usuario
	**/
	public function __construct() {
		parent::__construct();/*llama al contructor pade 'BaseController de gestion de la sesion*/
		$this->NotaMapper = new NotaMapper();
		// different to the "default" layout where the internal
	}
	
	/**
	* Action to note
	
	* When called via GET, nuew note form.
	* When called via POST, it tries to create a new note.
	
	* @return void
	*/
	public function nueva() {
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding posts requires login");
		}
		if(isset($_POST["titulo"]) && isset($_POST["contenido"])){
			$note = new Nota();
			$note->setTitulo($_POST["titulo"]);
			$note->setContenido($_POST["contenido"]);
			//$note->setFecha(getdate());
			try{
				$errors = array();
				if($_SESSION["currentuser"]){
					$this->NotaMapper->save($_SESSION["currentuser"],$note);
				}else{
					$errors["username"] = "Username and/or password not exists in system";
					$this->view->setFlash("errors: ".$errors["username"]);
				}
			}catch(ValidationException $ex){
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		/*muestra el usuarioLogIn*/
		$this->view->render("notes", "crearNota");
	}
	
	public function listarNotas(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding posts requires login");
		}
		if($_SESSION["currentuser"]){
			try{
				$alias=$_SESSION["currentuser"];
				$listNota=$this->NotaMapper->listNote($alias);
				if ($listNota == NULL) {
					throw new Exception("no notes found");
					$this->view->setVariable("errors","no notes found");
				}
				$this->view->setVariable("currentuser", $alias);
				$this->view->setVariable("notes", $listNota);
				
			}catch(ValidationException $ex){
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		/*muestra el usuarioLogIn*/
		$this->view->render("notes", "listarNotas");
	}
}
?>