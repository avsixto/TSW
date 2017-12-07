<?php

require_once(__DIR__."/../core/PDOConnection.php");

class UsuarioMapper {
	
	private $db;
	/**
	*el contructor obtiene la conexion con la base de datos del core
	**/
	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	/**
	*Añade un nuevo usuario en la bbdd
	**/
	public function save($user) {
		$stmt = $this->db->prepare("INSERT INTO usuario (nombre,apellidos,alias,password) values (?,?,?,?)");
		$stmt->execute(array($user->getNombre(), $user->getApellidos(), $user->getAlias(), $user->getPassword()));
	}
	/**
	*Elimina un usuario en la bbdd
	**/
	public function drop($user) {
		$stmt = $this->db->prepare("DELE FROM usuario WHERE idUsuario=?");
		$stmt->execute(array($user->getUsername(), $user->getPasswd()));
	}
	/**
	comprueba si el alias existe
	**/
	public function userAliasExists($alias) {
		$stmt = $this->db->prepare("SELECT count(alias) FROM usuario where alias=?");
		$stmt->execute(array($alias));
		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}

	/*getAlias
	* Obtiene todos los alias de los usuarios
	* Cualquier usuario del sistema podra compartir con los demas sus notas
	* No se ha pensado en retringir a los usuarios, todos son publicos para no complicar la lógica
	*/
	public function getAlias(){
		$stmt = $this->db->prepare("SELECT alias FROM usuario");
		$stmt->execute();
		$listaAlias = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $listaAlias;
	}

	/*getIdByAlias
	* Devuelve el id de un usuario buscandolo por el alias
	* En el sistema no puede haber mas de un usuario con el mismo alias
	*/
	public function getIdByAlias($idUsuario){
		$stmt = $this->db->prepare("SELECT idUsuario FROM usuario WHERE alias=?");
		$stmt->execute(array($idUsuario));
		$idUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $idUsuario[0];
	}

	/**
	*compruba si existe el alias y la contraseña de un susuario
	*/
	public function isValidUser($alias, $password) {
		$stmt = $this->db->prepare("SELECT count(alias) FROM usuario where alias=? and password=?");
		$stmt->execute(array($alias, $password));
		if ($stmt->fetchColumn() > 0) {
			return true;
		}
	}
}