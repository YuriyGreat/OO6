<?php
/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:36:11
 */
namespace AppBundle\Models;
use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\DBService\UserDBService;

class AutorisationModel
{

	public $m_user;
	public $m_UserDBService;

	function __construct()
	{
	}

	function __destruct()
	{
	}



	public function CheckEmail()
	{
	}

	/**
	 * 
	 * @param password
	 */
	public function CheckPassword(int $password)
	{
	}

	public function ChecKUserStatus()
	{
	}

	public function GetUserByEmail()
	{
	}

	public function HashPassword()
	{
	}

	public function SolePassword()
	{
	}

}
?>