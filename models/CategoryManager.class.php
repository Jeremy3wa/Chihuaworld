<?php

class CategoryManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function findAll()
	{
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM category ORDER BY name DESC");
		while ($category = mysqli_fetch_object($res, "Category", [$this->db]))
		{
			$list[] = $category;
		}
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$res = mysqli_query($this->db, "SELECT * FROM category WHERE id='".$id."' LIMIT 1");
		$category = mysqli_fetch_object($res, "Category", [$this->db]);
		return $category;
	}


	public function save(Category $category)
	{
		$id = intval($category->getId());
		$description = mysqli_real_escape_string($this->db, $category->getDescription());
		$name = mysqli_real_escape_string($this->db, $category->getName());
		$res = mysqli_query($this->db, "UPDATE category SET name='".$name."', '".$description."' WHERE id='".$id."' LIMIT 1");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		return $this->findById($id);
	}
	public function remove(Category $category)
	{
		$id = intval($category->getId());
		mysqli_query($this->db, "DELETE from category WHERE id='".$id."' LIMIT 1");
		return $category;
	}
	public function create($description, $name)
	{
		$errors = [];
		$category = new Category($this->db);
		$error = $category->setName($name);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $category->setDescription($description);
		if ($error)
		{
			$errors[] = $error;
		}
		if (count($errors) != 0)
		{
			throw new Exceptions($errors);
		}
		$description = mysqli_real_escape_string($this->db, $category->getDescription());
		$name = mysqli_real_escape_string($this->db, $category->getName());
		$res = mysqli_query($this->db, "INSERT INTO category (name, description) VALUES('".$name."', '".$description."')");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);

	}
}
?>