<?php
class Category
{
	private $id;
	private $name;
	private $description;

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
	public function setName($name)
	{
		if (strlen($name) > 63)
		{
			return "Titre trop long (> 63)";
		}
		else if (strlen($name) < 5)
		{
			return "Titre trop court (< 5)";
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
			return "Contenu trop long (> 4095)";
		}
		else if (strlen($description) < 65)
		{
			return "Contenu trop court (< 65)";
		}
		else
		{
			$this->description = $description;
		}
	}
}
?>