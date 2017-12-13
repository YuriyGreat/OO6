<?php
/**
 * @author brand
 * @version 1.0
 * @created 25-���-2017 10:36:08
 */
namespace AppBundle\Models;

use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AppBundle\DBService\UserDBService;
use AppBundle\Entity\User;

class RegistrationModel
{

	public $encoder;
	public $dbService;
    const DEFAULT_ROLE = 'ROLE_USER';

	function __construct(ManagerRegistry $doctrine, UserPasswordEncoderInterface $encoder)
	{
        $this->dbManager = new UserDBService($doctrine);
        $this->encoder = $encoder;
	}

	function __destruct()
	{
	}



	public function CheckEmailExist()
	{
	}

	public function CreateActivationCode()
	{
	}

	public function addUser(User $user)
	{
        $this->HashPassword($user);
        $user->setRole(self::DEFAULT_ROLE);
        // TODO activation
        $user->setIsActive(true);
        $this->dbManager->addUser($user);
	}

	public function HashPassword(User $user)
	{
        $encodedPassword = $this->encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encodedPassword);
	}

    public function getUserById($id): User
    {
        return $this->dbManager->getUserById($id);
    }

	public function SendActivation()
	{
	}

	public function SolePassword()
	{
	}

}
?>