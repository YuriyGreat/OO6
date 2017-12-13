<?php
/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:36:10
 */
namespace AppBundle\Models;

use Doctrine\Common\Persistence\ManagerRegistry;
use AppBundle\DBService\UserDBService;

class ActivationModel
{

	private $ChangeUserStatus;
	private $CheckTimeOfCreation;
	private $CompareActivationCode;
	private $GetActivationByEmail;
	public $m_MailModel;

	function __construct()
	{
	}

	function __destruct()
	{
	}



}
