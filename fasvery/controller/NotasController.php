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
	
	/*nueva
	*Crea una nueva nota
	*Es necesario esta logeado, en caso contrario requerira que el usuario se autentique
	*/
	public function nueva() {
		if(self::logeado()){
			if(isset($_POST["titulo"]) && isset($_POST["contenido"])){
				$note = new Nota();
				$note->setTitulo($_POST["titulo"]);
				$note->setContenido($_POST["contenido"]);
				//$note->setFecha(getdate());
				try{
					$errors = array();
					if($_SESSION["currentuser"]){
						$this->NotaMapper->save($note);
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
			$this->view->render("notes", "crearNota");
		}
	}

	/*verNota
	*Muestra una nota en detalle
	*/
	public function verNota(){
		if(self::logeado()){
			$this->view->setVariable("nota",$this->NotaMapper->getNoteByID($_GET["idNota"]));
			$this->view->setVariable("alias",$_SESSION["currentuser"]);
			$this->view->render("notes", "verNota");
		}
	}
	
	/*listarNotas
	*Lista todas las notas para un usuario
	*Si la sesion no esta iniciada pedira que se inicie
	*/
	public function listarNotas(){
		if(self::logeado()){
				$alias=$_SESSION["currentuser"];
				$listNota=$this->NotaMapper->listNote();
				if ($listNota == NULL) {
					$this->view->setVariable("creadas","No ha publicado ninguna nota");//se muestra que no hay notas publicadas
				}else{
					$this->view->setVariable("creadas","");//no se muestra ningun mensaje
					$this->view->setVariable("currentuser", $alias);
					$this->view->setVariable("notes", $listNota);
				}
			$this->view->render("notes", "listarNotas");
		}
	}

	/*editar
	* Si se llama con un get muestra la nota en vista completa para editarla
	* Si se llama con un post editar la nota actualizandola en la base de datos
	*/
	public function editar(){
		if(self::logeado()){
			if(isset($_POST["idNota"]) && isset($_POST["titulo"]) && isset($_POST["contenido"])){
				$this->NotaMapper->editar(new Nota($_POST["idNota"],$_POST["titulo"],$_POST["contenido"]));
				$this->view->setFlash("Nota Editada correctamente");
				self::listarNotas();
			}
			$this->view->setVariable("nota",$this->NotaMapper->getNoteByID($_GET["idNota"]));
			$this->view->setVariable("alias",$_SESSION["currentuser"]);
			$this->view->render("notes","editarNota");
		}
	}

	/*compartir
	* Si se llama con un get muestra la nota en vista para compartir notas
	* Si se llama con un post permite compartir notas
	*/
	public function compartir(){
		$this->view->render("notes","compartirNota");
	}

	/*eliminarNotas
	*Elimina una nota
	*Es necesario ser el propietario
	*/
	public function eliminarNotas(){
		if(self::logeado()){
			if(isset($_GET["idNota"]) && $this->NotaMapper->drop($_GET["idNota"])){
				$this->view->setFlash("Nota Eliminada correctamente");
			}else{
				$this->view->setFlash("ERROR: No se ha podido eliminar la nota");
			}//Refresca la vista.
			self::listarNotas();
		}
	}

	/*logeado
	* Si el usuario no esta logeado lo manda a la vista de loging
	* Si esta logeado devuelve un true;
	*/
	private function logeado(){
		if (!isset($this->currentUser)) {
			$this->view->redirect("Usuario","login");
		}
		return true;
	}
}
?>