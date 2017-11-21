<?php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");
require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/UsuarioMapper.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
*Controller to users, logout and user registration
**/

class UsuarioController extends BaseController {
	
	private $UsuarioMapper;
	
	/**
	* Obtiene la conexion
	* Crea el mapper del usuario
	**/
	public function __construct() {
		parent::__construct();/*llama al contructor pade 'BaseController de gestion de la sesion*/
		$this->UsuarioMapper = new UsuarioMapper();
		// different to the "default" layout where the internal
	}
	
	/**
	* Action to usuarios
	
	* When called via GET,login form.
	* When called via POST, it tries to start user sesion
	
	* @return void
	*/
	public function login() {
		if(isset($_POST["alias"]) && isset($_POST["password"])){
			try{
				$errors = array();
				if($this->UsuarioMapper->isValidUser($_POST["alias"],$_POST["password"])){
					$_SESSION["currentuser"]=$_POST["alias"];
					echo $_SESSION["currentuser"];
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
		$this->view->render("users", "logIn");
	}
	
	/**
	* Action to register
	
	* When called via GET, it shows the register form.
	* When called via POST, it tries to add the user
	* to the database.
	
	* The expected HTTP parameters are:
	* name: the name of user (via HTTP POST)
	* surname: the surname of user (via HTTP POST)
	* alias: The username (via HTTP POST)
	* passwd: The password (via HTTP POST)
	
	* The views are:
	
	* users/register: If this action is reached via HTTP GET (via include)
	* users/users: If users succeds (via redirect)
	* users/register: If validation fails (via include). Includes these view variables:
	
	*	user: The current User instance, empty or being added
	
	*	errors: Array including validation errors
	
	* @return void
	*/
	public function register() {
		$user = new Usuario();
		if (isset($_POST["alias"])){ // reaching via HTTP Post...
			// populate the User object with data form the form
			$user->setNombre($_POST["nombre"]);
			$user->setApellidos($_POST["apellidos"]);
			$user->setAlias($_POST["alias"]);
			$user->setPassword($_POST["password"]);
				try{
				$user->checkIsValidForRegister(); // if it fails, ValidationException
				// check if user exists in the database
					if (!$this->UsuarioMapper->userAliasExists($_POST["alias"])){
						// save the User object into the database
						$this->UsuarioMapper->save($user);
						// POST-REDIRECT-GET
						// Everything OK, we will redirect the user to the list of users
						// We want to see a message after redirection, so we establish
						// a "flash" message (which is simply a Session variable) to be
						// get in the view after redirection.
						$this->view->setFlash("Username ".$user->getAlias()." successfully added. Please users now");
						// perform the redirection. More or less:
						// header("Location: logIn.php?controller=Usuario&action=login")
						// die();
						$this->view->redirect("Usuario", "login");
					} else {
						$errors = array();
						$errors["username"] = "Username already exists";
						$this->view->setFlash("errors: ".$errors["username"]);
					}
				}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		// Put the User object visible to the view
		$this->view->setVariable("user", $user);
		// render the view (/view/users/register.php)
		$this->view->render("users", "registroUsuario");
	}
	/**
	* Action to logout
	*
	* This action should be called via GET
	*
	* No HTTP parameters are needed.
	*
	* The views are:
	* <ul>
	* <li>users/users (via redirect)</li>
	* </ul>
	*
	* @return void
	*/
	public function logout() {
		session_destroy();
		// perform a redirection. More or less:
		// header("Location: logIn.php?controller=users&action=users")
		// die();
		$this->view->redirect("main", "index");
	}
}
?>