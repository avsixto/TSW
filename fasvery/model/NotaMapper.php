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
	**/
	public function drop($idNota) {
		$stmt = $this->db->prepare("DELE FROM nota WHERE idNota =?");
		$stmt->execute(array($idNota));
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

	public function listNoteOriginal($alias){
		$stmt = $this->db->prepare("SELECT idUsuario FROM usuario WHERE alias=?");
		$stmt->execute(array($alias));
		$fk_idUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$id;
		foreach ($fk_idUsuario as $id){
			$stmt = $this->db->prepare("SELECT * FROM nota WHERE fk_idUsuario=?");
			$stmt->execute(array($id["idUsuario"]));
			$notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		$listaNotas=array();
		foreach($notas as $nota){
			array_push($listaNotas, new Nota($nota["idNota"], $nota["titulo"], $nota["contenido"], $nota["fecha"],$nota["fk_idUsuario"]));
		}
		return $listaNotas;
	}
}