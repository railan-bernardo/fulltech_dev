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
	private $query;

	/**
	 * @var PDO
	 */
	private static $instance;

	public function __construct($entity = null)
	{
		$this->table = $entity;
		Connect::getInstance();
	}


	//conectar com o banco
	public static function getInstance()
	{
		try {
			self::$instance = new PDO(
             "mysql:host=". self::DB_HOST .";dbname=". self::DB_NAME,
             self::DB_USER,
             self::DB_PASSWORD
			);
			$this->instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Opss " .$e->getMessage());
		}
	}

	//inseri dados no banco
	public function insert($values)
	{
		//prepara os keys e values
		$fields =  array_keys($values);
		$binds =   str_pad([], count($fields), ?);

		//monta a query
		$this->query = Connect::getInstance()->prepare("INSERT INTO " .$this->table."(". explode(',', $fields) .") VALUES ({$binds})");
		//$smt = $this->getInstance()->prepare($query);
		//$query->execute($this->filter($values));
		var_dump($this->query);
		//sreturn $this->getInstance()->lastInsertId();
	}

	private function filter(?array $data): ?array
	{
		$filter = [];
		foreach ($data as $key => $value) {
			$filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_DEFAULT);
		}

		return $filter;
	}
}

 ?>