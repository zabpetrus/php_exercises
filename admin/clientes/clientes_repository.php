<?php

require_once "clientes_model.php";
include_once "connection.php";

//Classe que salva, exclui e lista, mas não faz contato com o BD
class ClientRepository{
	
	private $cliente;
	private $clientesmodel;
	
	//Construtor obtém os dados de um cliente
	public function __construct( $cliente ){
		$this->cliente = $cliente;
		
		$connection = new Connection();
		$this->clientesmodel = new ClientModel( $connection->getConnection(), $cliente );
	}
	
	//Salvar o cliente
	public function save(){
		
		if($this->cliente->getId() == NULL){
				 return $this->clientesmodel->create();		 
		}else{
			 return $this->clientesmodel->put();		 
		}		
	}
	
	//Listar todos os clientes
	public function listAllClients(){ 
		return $this->clientesmodel->listAll();
	}
	
	//Lista um cliente com determinado id
	public function  listClientById( $id ){
		return $this->clientesmodel->listById($id);
	 }	
	
	//Procura um cliente dado um parâmetro
	public function searchClient( $parameters ){
		return $this->clientesmodel->listByParameter($parameters);
	}
	
	//Exclui o cliente recebido no construtor
	public function delete(){
		return $this->clientesmodel->remove();
	}
	
	
}

?>