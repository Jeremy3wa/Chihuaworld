<?php
class User
{
	// liste des propriétés -> privées
	private $id;
	private $firstname;
	private $lastname;
	private $adress;
	private $email;
	private $password;
	private $login;
	private $birthdate;
	private $admin;

	private $cart;
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	// méthode secrète public

	// méthodes public
	// getter
	public function getCart()
	{
		$manager = new CommandManager($this->db);
		$this->cart = $manager->findCartByUser($this);
		if (!$this->cart)
		{
			$this->cart = $manager->create($this);
		}
		return $this->cart;
	}
	public function getId()
	{
		return $this->id;
	}
	public function getFirstname()
	{
		return $this->firstname;
	}
	public function getLastname()
	{
		return $this->lastname;
	}
	public function getAdress()
	{
		return $this->adress;
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

	public function verifPassword($password)
	{
		return password_verify($password, $user->password);
	}

	public function updatePassword($password, $old_password)
	{
		if (strlen($password) > 63)
		{
			return "Mot de passe trop long (> 63)";
		}
		else if (strlen($password) < 6)
		{
			return "Mot de passe trop court (< 6)";
		}
		else if (!$this->verifPassword($old_password))
		{
			return "L'ancien mot de passe est invalide";
		}
		else
		{
			$this->password = password_hash($password, PASSWORD_BCRYPT, ["cost"=>11]);
		}
	}

		public function initPassword($password1, $password2)
	{
		if (strlen($password1) > 63)
		{
			return "Mot de passe trop long (> 63)";
		}
		else if (strlen($password1) < 6)
		{
			return "Mot de passe trop court (< 6)";
		}
		else if ($password1 != $password2)
		{
			return "Les mots de passe ne correspondent pas";
		}

		else if ($this->password != null)
		{
			return "Vous ne pouvez pas initialiser un mot de passe deja existant";
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

	public function setFirstname ($firstname)
	{
		if (strlen($firstname) < 3)
		{
			return "Prénom trop court (< 3)";
		}
		else if (strlen($firstname) > 31)
		{
			return "Prénom trop long (> 31)";
		}
		else
		{
			$this->firstname = $firstname;
		}
	}

	public function setLastname($lastname)
	{
		if (strlen($lastname) < 3)
		{
			return "Nom trop court (< 3)";
		}
		else if (strlen($lastname) > 31)
		{
			return "Nom trop long (> 31)";
		}
		else
		{
			$this->lastname = $lastname;
		}
	}

	public function setAdress($adress)
	{
		if (strlen($adress) < 3)
		{
			return "Adresse trop courte (< 3)";
		}
		else if (strlen($adress) > 4095)
		{
			return "Adresse trop longue (> 4095)";
		}
		else
		{
			$this->adress = $adress;
		}
	}

	public function setBirthdate($birthdate)
	{
		$birthdate = str_replace('/','-', $birthdate);
		$birthdate = str_replace('.','-', $birthdate);
		$birthdate = str_replace(' ','-', $birthdate);
		if($birthdate == '')
		{
			return "Date invalide";
		}
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

	public function setCart($cart)
	{
		$this->cart = $cart;
	}
}
?>