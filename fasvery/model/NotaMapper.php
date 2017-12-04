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
	* A�ade una nueva nota a la bbdd
	**/
	public function save($alias, $note) {
		$stmt = $this->db->prepare("SELECT idUsuario FROM usuario WHERE alias=?");
		$stmt->execute(array($alias));
		$fk_idUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$id;
		foreach ($fk_idUsuario as $id){
		$stmtN = $this->db->prepare("INSERT INTO nota (titulo, contenido, fecha ,fk_idUsuario) values (?,?,?,?)");
		$stmtN->execute(array($note->getTitulo(), $note->getContenido(), $note->getFecha(), $id["idUsuario"]));
		}
	}
	
	/**
	* Elimina una nota en la bbdd
	* S�lo si se es el que la ha publicado
	**/
	public function drop($idNota) {
		if(self::permisoNota($idNota)){
			$stmt = $this->db->prepare("DELETE FROM nota WHERE idNota =?");
			$stmt->execute(array($idNota));
			return true;
		}
		return false;
	}
	
	/**
	* comprueba si la nota existe
	**/
	public function noteExists($idNota) {
		$stmt = $this->db->prepare("SELECT count(idNota) FROM nota where idNota=?");
		$stmt->execute(array(idNota));
		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
	
	/*
	* Obtiene una lista con las notas publicadas de ese usuario
	*/
	public function listNote($alias){
		$stmt = $this->db->prepare("SELECT idUsuario FROM usuario WHERE alias=?");
		$stmt->execute(array($alias));
		$fk_idUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$id;
		foreach ($fk_idUsuario as $id){
			$stmt = $this->db->prepare("SELECT nota.*,usuario.nombre FROM nota,usuario WHERE fk_idUsuario=?");
			$stmt->execute(array($id["idUsuario"]));
			$notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		$listaNotas=array();
		foreach($notas as $nota){
			array_push($listaNotas, new Nota($nota["idNota"], $nota["titulo"], $nota["contenido"], $nota["fecha"],$nota["fk_idUsuario"], $nota["nombre"]));
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