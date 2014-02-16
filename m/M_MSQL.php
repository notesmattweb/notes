<?php

class M_MSQL{
	
	// Настройки подключения к БД.
	private $hostname = 'localhost:31006'; 
	private $username = 'root'; 
	private $password = '';
	private $dbName = 'blog';

	private static $instance;
	
	public static function get_instance(){
		if(empty(self::$instance)){
			self::$instance = new M_MSQL();
		}
		
		return self::$instance;
	}

	public function __construct(){

		// Языковая настройка.
		setlocale(LC_ALL, 'ru_RU.UTF8');	
		
		// Подключение к БД.
		mysql_connect($this->hostname, $this->username, $this->password) or die('No connect with data base'); 
		mysql_query('SET NAMES utf8');
		mysql_select_db($this->dbName) or die('No data base');	
	}
	
	//выборка 
	public function Select($query){

		$result = mysql_query($query);
									
			if (!$result)
				die(mysql_error());
			
			$arr = array();
			// Извлечение из БД.
			while($row = mysql_fetch_assoc($result)){
			   $arr[] = $row;
			}
			return $arr;
			
	}
	
	// добавление
	// $exept - массив ключей, значения  которых не нужно обрабатывать
	public function Insert($table, $object, $exept = array()){
		
		// поля и значения
		$columns = array();
		$values = array();
		
		foreach($object as $key=>$value){
			$key = mysql_real_escape_string($key." ");
			$columns[] = $key;
			
			if($value=null){
				$values[] = 'NULL';
			}
			elseif(in_array($key, $exept)){
				$values[] = "$value";
			}
			else{
				$value = mysql_real_escape_string($value." ");
				$values[] = "'$value'";
			}
		}
	
		$columns_s = implode(',',$columns);
		$values_s = implode(',',$values);
		
		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)"; 
		
		$result = mysql_query($query);
								
		if (!$result)
			die(mysql_error());
			
		return mysql_insert_id();
		
	}

	// изменение 
	// $exept - массив ключей, значения  которых не нужно обрабатывать
	public function Update($table, $object, $where, $exept=array()){
		$sets = array();
		
		foreach($object as $key=>$value){
		$key = mysql_real_escape_string($key." ");
		
			if($value === null){
				$sets[] = "$key=NULL";		
			}
			elseif(in_array($key, $exept)){
				$sets[] = "$key=$value";
			}			
			else{				
				$value = mysql_real_escape_string($value." ");
				$sets[] = "$key='$value'";
			}
		}
		
		$set_s = implode(",",$sets);
		$query = "UPDATE $table SET $set_s WHERE $where";
		
		$result = mysql_query($query);
								
		if (!$result)
			die(mysql_error());
			
		return mysql_affected_rows();
		
	}
	
	// Удаление
	public function Delete($table, $where){
		$query = "DELETE FROM $table WHERE $where";
		
		$result = mysql_query($query);
								
		if (!$result)
			die(mysql_error());
			
		return mysql_affected_rows();	
	}
	
	
}





?>