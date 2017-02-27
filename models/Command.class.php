<?php
class Command
{
	// Propriétés Stockées
	private $id;
	private $status;
	private $price;
	private $id_customer;
	private $date;
	// Propriété Calculée
	private $customer;// class User

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

	public function getIdCustomer()
	{
		return $this->id_customer;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getCustomer()
	{
		$manager = new UserManager($this->db);
		$this->user = $manager->findById($this->id_user);
		return $this->user;// null
	}
	public function setCustomer(User $user)
	{
		$this->user = $user;
		$this->id_user = $user->getId();
	}
	public function getStatus($status)
	{
		if (strlen($status) < 3)
		{
			return "Contenu trop court (< 3)";
		}
		else if (strlen($status) > 2047)
		{
			return "Contenu trop long (> 2047)";
		}
		else
		{
			$this->status = $status;
		}
	}

	public function setIdCustomer($id_customer)
	{
		$this->id_customer = $id_customer;
	}


}
?>