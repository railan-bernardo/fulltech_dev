<?php

namespace Source\DB;

use \PDO;
use \PDOException;
/**
 * Class de conexao com o banco de dados
 */
class Connect
{
	
	 const DB_HOST = "localhost";
	 const DB_USER = "root";
	 const DB_PASSWORD = "Neyo385x";
	 const DB_NAME = "fulltech_dev";

	private $table;
	

	/**
	 * @var PDO
	 */
	private $instance;

	public function __construct($entity = null)
	{
		$this->table = $entity;
		$this->getInstance();
	}


	//conectar com o banco
	private function getInstance()
	{
		try {
			$this->instance = new PDO(
             "mysql:host=". self::DB_HOST .";dbname=". self::DB_NAME,
             self::DB_USER,
             self::DB_PASSWORD
			);
			$this->instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Opss " .$e->getMessage());
		}
	}

	/**
		*responsavel por executar a query no banco
	 *@param string $query
	 *@param array $params
	 * @return PDOStatement
	 */

	private function execute($query, $params = [])
	{
		try {
			$statement = $this->instance->prepare($query);
			$statement->execute($params);
			return $statement;
		} catch (PDOException $e) {
			die("Opss: ".$e->getMessage());
		}
	}

	//inseri dados no banco
	public function insert($values)
	{
		//prepara os keys e links
		$fields =  array_keys($values);
		$binds =   array_pad([], count($fields), '?');
		
		//monta a query
		$query = 
		"INSERT INTO " .$this->table."(". implode(',', $fields) .") VALUES "."(".implode(',',$binds).")";

		//executa a query
		$this->execute($query, array_values($values));
		return $this->instance->lastInsertId();
	
	}

}

 ?>