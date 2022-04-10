<?php

 /* Arquivo  de testes  de clientes_model*/
  
 //Mock - Objetos de teste
//Objeto 1 - Verificar se a estrutura da classe está funcionando:
 function Test1(){
	 
	 //Inserindo a conexão dentro do método para testes
	 include_once "clientes_model.php";
	 include_once "connection.php";

	 $connection = new Connection();
	 $m = $connection->getConnection();
	 
	$cliente= new Cliente();
	$cliente->setNome("Jones");
	$cliente->setDataNascimento("23/88/1258");
	$result = new ClientModel( $m, $cliente );
	echo $result->toString();
	 
 }

 
 
 //Objeto 2 - Verificar se a conexão com o Banco de dados está funcionando
//Verificar também se a validação é feita com um banco de dados nulo
 function Test2(){
	 
	 	//Inserindo a conexão dentro do método para testes
		  include_once "clientes_model.php";
		 include_once "connection.php";
	
		 $connection = new Connection();
		 $mysqli = $connection->getConnection();
		 
	 	$cliente= new Cliente();
		$cliente->setNome("Jones");
		$cliente->setDataNascimento("23/88/1258");
		$result = new ClientModel( $mysqli, $cliente );
		echo $result->toString();	 	 
 }
 
 
//Objeto 3- Testando o insert de um dado qualquer no banco de dados;
//Retornando um codigo de erro para cada erro especificado.
function Test3(){
	
		//Inserindo a conexão dentro do método para testes
	 	 include_once "clientes_model.php";
		 include_once "connection.php";

		$connection = new Connection();
		$m = $connection->getConnection();
		
		$cliente= new Cliente();
		$cliente->setNome("Rades Moru");
		$cliente->setDataNascimento("11/12/2011");
		$result = new ClientModel($m, $cliente );
		switch( $result->create()){
			case 0:
				echo "Não foi possivel concluir a solicitação";
				break;
			case 1:
				echo "Inserção feita com sucesso!";
				break;
			case -1:
				echo "Exceção";
				break;		
		}	
}



//Objeto 4- Testando o update de um dado qualquer no banco de dados;
//Retornando um codigo de erro para cada erro especificado.
 function Test4(){
	 
	 //Inserindo a conexão dentro do método para testes
	 	 include_once "clientes_model.php";
		 include_once "connection.php";
	
		 $connection = new Connection();
		 $mysqli = $connection->getConnection();

		 
		$cliente= new Cliente();
		$cliente->setId(5);
		$cliente->setNome("Michael B. Konn");
		//$cliente->setDataNascimento("22/04/2010");
		$result = new ClientModel( $mysqli, $cliente );
		switch( $result->put()){
			case 0:
				echo "Não foi possivel concluir a solicitação";
				break;
			case 1:
				echo "Atualização feita com sucesso!";
				break;
			case -1:
				echo "Exceção";
				break;
			case 2:
				echo "Identificador de usuario nao encontrado";
				break;	
		}			
 }
 

//Objeto 5- Testando o delete de um dado qualquer no banco de dados;
//Retornando um codigo de erro para cada erro especificado. 
 function Test5(){
	 
	  include_once "clientes_model.php";
		 include_once "connection.php";
	
		 $connection = new Connection();
		 $mysqli = $connection->getConnection();

	 
	 $cliente = new Cliente();
	 $cliente->setId(4);
	 $result= new ClientModel( $mysqli, $cliente );
	 switch( $result->remove()){
			case 0:
				echo "Não foi possivel concluir a solicitação";
				break;
			case 1:
				echo "Exclusão feita com sucesso!";
				break;
			case -1:
				echo "Exceção";
				break;
			case 2:
				echo "Identificador de usuario nao encontrado";
				break;	
			case 3:
				echo "Eh necessario inserir um id valido";
				break;					
		}		
	 
 }
 
 //Objeto 6- Testando o select completo de uma tabela;
//Retornando um codigo de erro para cada erro especificado. 
function Test6(){	

		 include_once "clientes_model.php";
		 include_once "connection.php";
	
		 $connection = new Connection();
		 $mysqli = $connection->getConnection();


	$result= new ClientModel( $mysqli,NULL );
	$m = $result->listAll();	
	if(is_array($m)){
		print_r($m);
	}
	if($m == 0){
		echo "Vazio";
	}
}

 //Objeto 7- Testando o select dado um argumento;
//Retornando um codigo de erro para cada erro especificado. 
function Test7(){
	
	 include_once "clientes_model.php";
		 include_once "connection.php";
	
		 $connection = new Connection();
		 $mysqli = $connection->getConnection();

	
	$result= new ClientModel( $mysqli,NULL );
	$m = $result->listByParameter("Claudinei");	
	if(is_array($m)){
		print_r($m);
	}
	if($m == 0){
		echo "Vazio";
	}
}

 //Objeto 7- Testando o select dado um id;
//Retornando um codigo de erro para cada erro especificado. 

function Test8(){
	
	 include_once "clientes_model.php";
	 include_once "connection.php";
	
	 $connection = new Connection();
	 $mysqli = $connection->getConnection();
	
	$result= new ClientModel( $mysqli,NULL );
	$m = $result->listById( 3 );
	if(is_array($m)){
		print_r($m);
	}
	if($m == 0){
		echo "Vazio";
	}
}

Test8();




?>