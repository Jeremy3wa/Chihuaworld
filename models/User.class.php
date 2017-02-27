<?php
class User
{
	// liste des propriétés -> privées
	private $id;
	private $email;
	private $password;
	private $login;
	private $birthdate;
	private $admin;

	// méthode secrète public

	// méthodes public
	// getter
	public function getId()
	{
		return $this->id;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getBirthdate()
	{
		return $this->birthdate;
	}
	public function isAdmin()
	{
		return $this->admin;
	}
	// setter
	public function setEmail($email)
	{
		// $errors[] = "Email invalide";
		if (filter_var($email, FILTER_VALIDATE_EMAIL) == true)
		{
			$this->email = $email;
		}
		else
			return "Email invalide";
	}
	public function setPassword($password)
	{
		// $errors[] = "Les mots de passe ne correspondent pas";
		if (strlen($password) < 6)
		{
			return "Mot de passe trop court (< 6)";
		}
		else if (strlen($password) > 74)
		{
			return "Mot de passe trop long (> 73)";
		}
		else
		{
			$this->password = $password;
		}
	}
	public function setLogin($login)
	{
		if (strlen($login) < 3)
		{
			return "Login trop court (< 3)";
		}
		else if (strlen($login) > 31)
		{
			return "Login trop long (> 31)";
		}
		else
		{
			$this->login = $login;
		}
	}
	public function setBirthdate($birthdate)
	{
		// $birthdate => 2017-02-22
		// explode / implode
		// string => array / array => string
		$tab = explode('-', $birthdate);
		// ["2017", "02", "22"]
		$month = $tab[1];
		$day = $tab[2];
		$year = $tab[0];
		// http://php.net/manual/fr/function.checkdate.php
		if (checkdate($month, $day, $year) == true)
		{
			$this->birthdate = $birthdate;
		}
		else
		{
			return "Date de naissance invalide";
		}
	}
	public function setAdmin($admin)
	{
		$this->admin = $admin;
	}
}
?>