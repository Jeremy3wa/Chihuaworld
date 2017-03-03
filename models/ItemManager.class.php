<?php
class ItemManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function findByCommand(Command $command)
	{	
		$id = intval($command->getId());
		$list = [];
		$res = mysqli_query($this->db, "SELECT items.* FROM items LEFT JOIN link_command_items ON link_command_items.id_items=items.id WHERE link_command_items.id_command='".$id."'");
		while ($item = mysqli_fetch_object($res, "Item", [$this->db]))
		{
			$list[] = $item;
		}
		return $list;
	}

		public function findNbrByCommand(Command $command)
		{
			$id = intval($command->getId());
			$list = [];
			$res = mysqli_query($this->db, "SELECT items.*, COUNT(items.id) AS nbr FROM items LEFT JOIN link_command_items ON link_command_items.id_items=items.id WHERE link_command_items.id_command='".$id."'");
			while($items = mysqli_fetch_object($res, "Item", [$this->db]))
			{
				$list[] = $items;
			}
			return $list;
		}

	public function findAll()
	{
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM items ORDER BY id_category");
		while ($item = mysqli_fetch_object($res, "Item", [$this->db]))
		{
			$list[] = $item;
		}
		return $list;
	}

	public function findById($id)
	{
		$id = intval($id);
		$res = mysqli_query($this->db, "SELECT * FROM items WHERE id='".$id."' LIMIT 1");
		$item = mysqli_fetch_object($res, "Item", [$this->db]);
		return $item;
	}
	public function findByCategory(Category $category)
	{	
		$id_category = intval($category->getId());
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM items WHERE id_category='".$id_category."' ORDER BY name");
		while ($item = mysqli_fetch_object($res, "Item", [$this->db])) // $user = new User();
		{
			$list[] = $item;
		}
		return $list;

	}


	public function save(Item $item)
	{
		$id = intval($item->getId());
		$name =  mysqli_real_escape_string($this->db, $item->getName());
		$id_category = intval($item->getCategory()->getId());
		$stock = intval($item->getStock());
		$price = floatval($item->getPrice());
		$picture = mysqli_real_escape_string($this->db, $item->getPicture());
		$id_item = intval($this->db, $item->getName());
		// $stock_item = ;
		$description = mysqli_real_escape_string($this->db, $item->getDescription());
		$res = mysqli_query($this->db, "UPDATE items SET description='".$description."', name='".$name."', id_category='".$id_category."', stock='".$stock."', size='".$size."', price='".$price."', picture='".$picture."'  WHERE id='".$id."' LIMIT 1");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		return $this->findById($id);
	}

		public function remove(Item $item)
	{
		$id = intval($item->getId());
		mysqli_query($this->db, "DELETE from items WHERE id='".$id."' LIMIT 1");
		return $item;
	}

	public function create($description, $name, Category $category, $stock, $size, $price, $picture)

	{
		$errors = [];
		$item = new Item($this->db);
		$error = $item->setName($name);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $item->setCategory($category);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $item->setDescription($description);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $item->setStock($stock);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $item->setPrice($price);
		if ($error)
		{
			$errors[] = $error;
		}

		$error = $item->setPicture($picture);
		if ($error)
		{
			$errors[] = $error;
		}
		
		if (count($errors) != 0)
		{
			throw new Exceptions($errors);
		}

		
		$name =  mysqli_real_escape_string($this->db, $item->getName());
		$id_category = intval($item->getCategory()->getId());
		$stock = intval($item->getStock());
		$price = floatval($item->getPrice());
		$description = mysqli_real_escape_string($this->db, $item->getDescription());
		$picture = mysqli_real_escape_string ($this->db, $item->getPicture());
		$res = mysqli_query($this->db, "INSERT INTO items (description, name, id_category, stock, size, price, picture) VALUES('".$description."', '".$name."', '".$id_category."', '".$stock."','".$size."', '".$price."', '".$picture."')");

		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}

}