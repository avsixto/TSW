<?php

require_once(__DIR__."/../core/PDOConnection.php");

class NotaMapper {
	
	private $db;
	/**
	* El contructor obtiene la conexion con la base de datos del core
	**/
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	
	/**
	* Añade una nueva nota a la bbdd
	**/
	public function save($note) {
		$stmt = $this->db->prepare("SELECT idUsuario FROM usuario WHERE alias=?");
		$stmt->execute(array($_SESSION["currentuser"]));
		$fk_idUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($fk_idUsuario as $id){
		$stmtN = $this->db->prepare("INSERT INTO nota (titulo, contenido, fecha ,fk_idUsuario) values (?,?,?,?)");
		$stmtN->execute(array($note->getTitulo(), $note->getContenido(), $note->getFecha(), $id["idUsuario"]));
		}
	}
	
	/**
	* Elimina una nota en la bbdd
	* Sólo si se es el que la ha publicado
	**/
	public function drop($idNota) {
		if(self::permisoNota($idNota)){
			$stmt = $this->db->prepare("DELETE FROM nota WHERE idNota =?");
			$stmt->execute(array($idNota));
			return true;
		}
		return false;
	}
	
	/**noteExists
	* comprueba si la nota existe
	**/
	public function noteExists($idNota) {
		$stmt = $this->db->prepare("SELECT count(idNota) FROM nota where idNota=?");
		$stmt->execute(array($idNota));
		if ($stmt->fetchColumn() > 0) {
			return true;
		}
		return false;
	}

	/*getNoteByID
	* devuelve una nota a partir de un id
	*/
	public function getNoteByID($idNota){
		if(self::noteExists($idNota)){//comprobamos que la nota exista por seguridad
			$stmt = $this->db->prepare("SELECT * FROM nota WHERE idNota=?");
			$stmt->execute(array($idNota));
			$stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$nota=$stmt["0"];
			return $nota=new Nota($nota["idNota"],$nota["titulo"],$nota["contenido"],$nota["fecha"],$nota["fk_idUsuario"]);//devuelvo la única nota con ese id
			}
			return NULL;
		}
	
	/*listNote
	* Obtiene una lista con las notas publicadas de ese usuario
	* Controla el tamaño del formulario para que no se desajuste el titulo en el legend
	* No se ha creado en un .js aparte por que sólo para eso no merecía la pena crear un .js
	*/
	public function listNote(){
		$stmt = $this->db->prepare("SELECT idUsuario FROM usuario WHERE alias=?");
		$stmt->execute(array($_SESSION["currentuser"]));
		$stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$idUsuario=$stmt["0"];//id del usuario Actual
		//obtenemos todas las notas para ese usuario
		$stmt = $this->db->prepare("SELECT nota.* FROM nota,usuario WHERE fk_idUsuario=usuario.idUsuario AND usuario.idUsuario=?");
		$stmt->execute(array($idUsuario["idUsuario"]));
		$notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$listaNotas=array();//lista con notas para ese usuario
		foreach($notas as $nota){
			if(strlen($nota["titulo"])>13){//para que no se desajuste el tamaño de formulario
				$titulo=substr($nota["titulo"], 0, 13)."...";
			}else{
				$titulo=$nota["titulo"];
			}
			array_push($listaNotas, new Nota($nota["idNota"],$titulo, $nota["contenido"], $nota["fecha"],$nota["fk_idUsuario"], $_SESSION["currentuser"]));
		}
		return $listaNotas;
	}

	private function permisoNota($idNota){
		if(isset($_SESSION["currentuser"])){
			$stmt = $this->db->prepare("SELECT fk_idUsuario FROM nota WHERE idNota=?");
			$stmt -> execute(array($idNota));
			$stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);//id usuario de la nota
			$stmt2 = $this->db->prepare("SELECT idUsuario FROM usuario WHERE alias=?");
			$stmt2->execute(array($_SESSION["currentuser"]));
			$stmt2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);//id usuario actual
			$idPropietario=$stmt["0"];//id del propietario de la nota
			$idUsuario=$stmt2["0"];//id del usuario Actual
			if ($idUsuario["idUsuario"]==$idPropietario["fk_idUsuario"]) {
				return true;
			}
		}
		return false;
	}
}