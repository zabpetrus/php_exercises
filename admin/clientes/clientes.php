<?php

class Cliente{
	
	private $id;
	private $nome;
	private $data_nascimento;
	private $data_registro;
	
	public function __construct(){}
	public function setId( $id ){ $this->id = $id;  }
	public function getId(){ return $this->id; }
	public function setNome( $nome ){ $this->nome = $nome; }
	public function getNome(){ return $this->nome; }
	public function setDataNascimento( $data_nascimento ){ $this->data_nascimento = $data_nascimento; }
	public function getDataNascimento(){ return $this->data_nascimento; }	
	public function getDataRegistro(){ return $this->data_registro; }
	public function toString(){ return  $this->id . " " .  $this->nome . " " . $this->data_nascimento; }
	
	
}
// Objeto de exemplo - Mock
/*
	$cliente = new Cliente();
	$cliente->setId(1);
	$cliente->setNome("Jones");
	$cliente->setDataNascimento("12/11/1258");
	echo $cliente->toString();
*/


?>