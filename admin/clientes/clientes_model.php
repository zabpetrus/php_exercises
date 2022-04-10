<?php

require_once "clientes.php";
include_once "interface_classicModel.php";

class ClientModel implements classicModel{
	
	private $conn;
	private $cliente;

	
	//Construtor que inicializa os objetos necessários para o crud
	public function __construct( $conn, $cliente ){
		$this->conn = $conn;   //conexão do banco de dados
		$this->cliente = $cliente;  //objeto do modelo
	}
	
	//Método para inserir no banco de dados
	/************************************************
	*******************  CREATE *********************
	************************************************/
	private function insert(){
		try {
				
			/*Inserindo os  valores obtidos do objeto clientes*/
			$nome = $this->cliente->getNome();
			$data_nascimento = $this->cliente->getDataNascimento();	;
			$stmt = $this->conn->prepare('INSERT INTO clientes( nome, data_nascimento) VALUES (?,?)');
			$stmt->bind_param('ss',$nome, $data_nascimento);
			$stmt->execute();
		
			/* If code reaches this point without errors then commit the data in the database */
			$this->conn->commit();
			return 1;
			
		} catch (mysqli_sql_exception $exception) {
			$this->conn->rollback();		
			throw $exception;
			return -1;
		}
		
		return 0;
	}
	
	//Método para atualizar no banco de dados
	/************************************************
	*********************  PUT  *********************
	************************************************/
	private function update(){
		
		try{		
				
			/*Atualizando os  valores obtidos do objeto clientes*/
			
			$id = $this->cliente->getId();
			$nome = $this->cliente->getNome();
			$data_nascimento = $this->cliente->getDataNascimento();	
			
			if($id != NULL){
								
				$colunas = array();
				!empty($nome) ? array_push ( $colunas,  "nome=\"" .$nome ."\"" ) : '';
				!empty($data_nascimento) ? array_push ( $colunas,  "data_nascimento=\"" .$data_nascimento."\""  ) : '';
				$all_data = implode(", ", $colunas);
				
				$sql = 'UPDATE clientes SET '.$all_data.' WHERE id=?';
				$stmt = $this->conn->prepare($sql);
				$stmt->bind_param('i', $id);
				$stmt->execute();
				$this->conn->commit();
				return 1;			
			}
			else{
				return 2;
			}
			
		}catch(mysqli_sql_exception $exception){
			   $this->conn->rollback();
    			throw $exception;
				return -1;
		}
		
		return 0;
	}
	
	//Método para excluir do banco de dados
	/************************************************
	*******************  DELETE  *********************
	************************************************/
	private function delete(){
		
		try{
			$id = $this->cliente->getId();
			if($id == NULL){
				return 3;
			}
			else{				
				$pre_query = $this->conn->query("SELECT * FROM clientes WHERE id={$id}");
				$count = $pre_query->num_rows;
				if($count  > 0){
					
					$sql = 'DELETE  FROM clientes WHERE  id=? LIMIT 1;';
					$stmt = $this->conn->prepare($sql);
					$stmt->bind_param('i',$id);
					$stmt->execute();
					
					 //Se deu tudo certo, comita
    				$this->conn->commit();
					return 1;
				}
				else{
					return 2;
				}		            
			}	
		
		}catch(mysqli_sql_exception $exception){
			$this->conn->rollback();
			throw $exception;
			return -1;
		}
	return 0;		
}

	//Método para excluir do banco de dados
	/************************************************
	*****************  SELECT  ALL *******************
	************************************************/
	private function selectAll(){
		
		try {			
				$sql = 'SELECT id, nome, data_nascimento, data_registro  FROM clientes WHERE 1';
							
				if($stt = $this->conn->prepare($sql)){
					$stt->execute();			
					
					$stt->store_result();
					$num = $stt->num_rows ;
					if($num > 0 ){
						
						$stt->bind_result($id, $nome, $data_nascimento, $data_registro);						
						$table = array();
						
						while ($stt->fetch()) {
							$row = array( 'id' => $id, 'nome' => $nome, 'data_nascimento' => $data_nascimento, 'data_registro' => $data_registro );
							array_push($table, $row);
						}						
						return $table;
						
					}else{
						return 0;
					}
			
				}	
					/* Se não tiver nenhum problema ai */
					$this->conn->commit();
				} catch (mysqli_sql_exception $exception) {
					$this->conn->rollback();			
				throw $exception;
			}
	}
	
	//Método para excluir do banco de dados
	/************************************************
	****************  SELECT BY ID *******************
	************************************************/
	private function selectById( $id ){
		
		try {			
				$sql = "SELECT id, nome, data_nascimento, data_registro  FROM clientes WHERE id={$id}";
							
				if($stt = $this->conn->prepare($sql)){
					$stt->execute();			
					
					$stt->store_result();
					$num = $stt->num_rows ;
					if($num > 0 ){
						
						$stt->bind_result($id, $nome, $data_nascimento, $data_registro);						
						$table = array();
						
						while ($stt->fetch()) {
							$row = array( 'id' => $id, 'nome' => $nome, 'data_nascimento' => $data_nascimento, 'data_registro' => $data_registro );
							array_push($table, $row);
						}						
						return $table;
						
					}else{
						return 0;
					}			
				}	
					/* Se não tiver nenhum problema ai */
					$this->conn->commit();
				} catch (mysqli_sql_exception $exception) {
					$this->conn->rollback();			
				throw $exception;
			}
	}
	
	
	
		//Método para inserir no banco de dados
	/************************************************
	*******************  SEARCH  *********************
	************************************************/
	private function search( $value ){
		try {			
				$sql = "SELECT *  FROM clientes WHERE nome LIKE '%{$value}%' ";
								
				if($stt = $this->conn->prepare($sql)){
					$stt->execute();			
					
					$stt->store_result();
					$num = $stt->num_rows ;
					if($num > 0 ){
						
						$stt->bind_result($id, $nome, $data_nascimento, $data_registro);						
						$table = array();
						
						while ($stt->fetch()) {
							$row = array( 'id' => $id, 'nome' => $nome, 'data_nascimento' => $data_nascimento, 'data_registro' => $data_registro );
							array_push($table, $row);
						}						
						return $table;
						
					}else{
						return 0;
					}
			
				}	
					/* Se não tiver nenhum problema ai */
					$this->conn->commit();
				} catch (mysqli_sql_exception $exception) {
					$this->conn->rollback();			
				throw $exception;
			}
		
	}
	
	
	//Metodo to string
	//Para testar o functionamento básico da classe
	/************************************************
	*******************  TO STRING  *********************
	************************************************/
	public function toString(){
		$result = "";
		if($this->conn == NULL ){
			$result = "Sem conexão ativa.";
		}else{
			$result = $this->conn->stat();
		}
		$nome = $this->cliente->getNome();
		$data_nascimento = $this->cliente->getDataNascimento();	
		return  "Model data: " .$nome."-".$data_nascimento ."<br/>Conexão: ". $result;
	}	
	
		
	public function create(){ return $this->insert(); }
	
	public function put(){ return $this->update(); }
	
	public function remove(){ return $this->delete(); }
	
	public function listAll(){ return $this->selectAll(); }
	
	public function listById($id){ return $this->selectById($id); }
	
	public function listByParameter( $data ){ return $this->search($data); }
	
		public function __destruct(){
		if($this->conn != NULL){
			$this->conn->close();
		}
	}
	
	
	
	
}







?>