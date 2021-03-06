<?php
class Category
{
	private $id;
	private $name;
	private $description;

	private $items;
	

	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getDescription()
	{
		return $this->description;
	}

	public function getItems()
	{
		$manager = new ItemManager($this->db);
		$this->items = $manager->findByCategory($this);
		return $this->items;
	}
	


	public function setName($name)
	{
		if (strlen($name) > 63)
		{
			return "Nom de catégorie trop long (> 63)";
		}
		else if (strlen($name) < 3)
		{
			return "Nom de catégorie trop court (< 3)";
		}
		else
		{
			$this->name = $name;
		}
	}
	public function setDescription($description)
	{
		if (strlen($description) > 4095)
		{
			return "Description du produit trop longue (> 4095)";
		}
		else if (strlen($description) < 10)
		{
			return "Description de la catégorie trop court(< 10)";
		}
		else
		{
			$this->description = $description;
		}
	}
}
?>