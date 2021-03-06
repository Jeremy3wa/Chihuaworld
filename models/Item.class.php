<?php
class Item
{
	private $id;
	private $name;
	private $id_category;
	private $stock;
	private $price;
	private $description;
	private $size;
	private $color;
	private $review;
	private $picture;

	private $db;
	private $category;

	public function __construct($db)
	{
		$this->db = $db;
	}

	/*---------GET-------*/
	public function getId()
	{
		return $this->id;
	}
	public function getSize()
	{
		return explode(',', $this->size);
	}
	public function getColor()
	{
		return explode(',', $this->color);
	}
	public function setSize($size)
	{
		$this->size = $size;
	}
	public function setColor($color)
	{
		$this->color = $color;
	}
	public function getReview()
	{
		$manager = new ReviewManager($this->db);
		$this->review = $manager->findByItem($this);
		return $this->review;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPicture()
	{
		return $this->picture;
	}

	public function getCategory()
	{
		$manager = new CategoryManager($this->db);
		$this->category = $manager->findById($this->id_category);
		return $this->category;
	}
	public function getStock()
	{
		return $this->stock;
	}
	public function getPrice()
	{
		return $this->price;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getCustomer()
	{
		$manager = new UserManager($this->db);
		$this->customer = $manager->findById($this->id_customer);
		return $this->customer;// null
	}
	/*---------SET-------*/



	public function setName($name)
	{
		if(strlen($name) > 63)
		{
			return "Nom de produit trop long (> 63)";
		}
		else if (strlen($name) < 5 )
		{
			return "Nom de produit trop court (< 5)";
		}
		else
		{
			$this->name = $name;
		}
	}
	public function setCategory(Category $category)
	{
		$this->category = $category;
		$this->id_category = $category->getId();
	}
	public function setStock($stock)
	{
		if(strlen($stock) < 0)
		{
			return "Un stock ne peut être négatif";
		}
		else
		{
			$this->stock=$stock;
		}
	}
	public function setPrice($price)
	{
		$price = floatval($price);
		if($price <= 0)
		{
			return "Prix invalide";
		}
		else
		{
			$this->price=$price;
		}
	}

	public function setDescription($description)
	{

		if (strlen($description) > 4095)
		{
			return "Description trop long (> 4095)";
		}
		else if (strlen($description) < 65)
		{
			return "Description trop court (< 65)";
		}
		else
		{
			$this->description = $description;
		}
		
	}
	public function setReview($review)
	{
		$this->review = $review;
	}

	public function setPicture($picture)
	{
		$this->picture = $picture;
	}
	
	public function setCustomer(User $customer)
	{
		$this->customer = $customer;
		$this->id_customer = $customer->getId();
	}

}

?>
