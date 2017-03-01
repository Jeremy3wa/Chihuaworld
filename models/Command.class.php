<?php
class Command
{
	// Propriétés Stockées
	private $id;
	private $status;
	private $price;
	private $id_user;
	private $date;
	// Propriété Calculée
	private $user;// class User

	// Propriété Transmise
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getStatus()
	{
		return $this->status;
	}
	public function getPrice()
	{
		return $this->price;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getUser()
	{
		$manager = new UserManager($this->db);
		$this->user = $manager->findById($this->id_user);
		return $this->user;// null
	}
	

	public function setUser(User $user)
	{
		$this->user = $user;
		$this->id_user = $user->getId();
	}
	public function setStatus($status)
	{
		if (strlen($status) < 3)
		{
			return "Statut de la commande trop court (<3)";
		}
		else if (strlen($status) > 31)
		{
			return "Statut trop long (> 31)";
		}
		else
		{
			$this->status = $status;
		}
	}

	


}
?>