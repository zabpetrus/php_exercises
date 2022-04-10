<?php

interface classicModel{
	
	public function create();
	
	public function put();
	
	public function remove();
	
	public function listAll();
	
	public function listByParameter( $data );
		
	public function toString();
	
	public function listById( $id );	
	
}


?>