<?php
class Review
{
	// Propriétés Stockées
	private $id;
	private $content;
	private $id_customer;
	private $id_item;
	private $date;
	private $rate;

	// Propriété Calculée
	private $customer;// class User 
	private $item;// class Article

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
	public function getContent()
	{
		return $this->content;
	}
	// public function getIdAuthor()
	// {
	// 	return $this->id_author;
	// }
	public function getItem()
	{
		$manager = new ItemManager($this->db);
		$this->item = $manager->findById($this->id_item);
		return $this->item;
	}
	public function getDate()
	{
		return $this->date;
	}

	public function getRate()
	{
		return $this->rate;
	}
	
	public function getCustomer()
	{
		$manager = new UserManager($this->db);
		$this->customer = $manager->findById($this->id_customer);
		return $this->customer;// null
	}
	public function setCustomer(User $customer)
	{
		$this->customer = $customer;
		$this->id_customer = $customer->getId();
	}
	public function setContent($content)
	{
		if (strlen($content) < 3)
		{
			return "Contenu trop court (< 3)";
		}
		else if (strlen($content) > 4095)
		{
			return "Contenu trop long (> 4095)";
		}
		else
		{
			$this->content = $content;
		}
	}

	public function setItem(Item $item)
	{
		$this->item = $item;
		$this->id_item = $item->getId();
	}

	public function setRate($rate)
	{
		if($rate<1)
		{
			return "Note < 1";
		}
		else if ($rate>5)
		{
			return "Note > 5";
		}
		else
		{
			$this->rate=$rate;
		}
	}
}
?>