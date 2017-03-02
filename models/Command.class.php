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
	private $user;// class User
	private $products;

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
		$this->user = $manager->findById($this->id_customer);
		return $this->user;// null
	}

	public function getItems()
	{
		if ($this->products == null)
		{
			$manager = new ItemManager($this->db);
			$this->products = $manager->findByCommand($this);
		}
		return $this->products;
	}

	public function addItem(Item $products)
	{
		if ($this->products == null)
		{
			$this->getItems();
		}
		$this->products[] = $products;
		$this->price += $products->getPrice();
	}

	public function setUser(User $user)
	{
		$this->user = $user;
		$this->id_customer = $user->getId();
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