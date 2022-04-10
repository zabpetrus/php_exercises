<?php

/* Versão temporária de arquivo de conexão ao banco de dados*/


class Connection{
	
	private $conect;	
	public function __construct(){
		
		$host = "localhost";
		$user = "root";
		$password = "823543";
		$database = "heron";		
		
			/* Chamar mysqli para lançar uma exception caso ocorra um erro */
			mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
			
			$mysqli = new mysqli( $host, $user,$password ,$database);
			
			//Query de teste de um campo qualquer da tabela;
			
			$result = $mysqli->query("SHOW TABLES LIKE 'clientes';");
			if($result->num_rows < 1){
					/* The table engine has to support transactions */
					$sql= "CREATE TABLE clientes (
								id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
								nome VARCHAR(30) NOT NULL,
								data_nascimento VARCHAR(50),
								data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
								) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
				
					$result = $mysqli->query($sql);
					echo "A tabela clientes foi gerada automaticamente";
			}
			
			/* Start transaction */			
			$mysqli->begin_transaction();
			$this->conect = $mysqli;

	}
	
	public function getConnection(){
		return $this->conect;
	}
	
}





?>