<?php 


namespace Source\Entity;
use \Source\DB\Connect;
/**
 * User responsavel pelo gerenciamento de usuarios
 */
class User
{
	
	public $id;
	public $login;
	public $password;
	public $log_login;

	/**
	Responsavel por inserir dados no banco
	**/
	public function cadastrar()
	{
		//conexao com o banco
		$connect = new Connect('user_login');

		$this->id = $connect->insert([
				'login'=> $this->login,
				'password'=> $this->password
		]);

	}
}

?>