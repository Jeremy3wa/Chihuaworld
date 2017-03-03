<?php
class CommandManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	public function findByStatus($status)
	{
		$status = mysqli_real_escape_string($this->db, $status);
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM command WHERE status='".$status."' ORDER BY date DESC");
		while ($user = mysqli_fetch_object($res, "Command", [$this->db]))
		{
			$list[] = $status;
		}
		return $list;
		
	}
	public function findById($id)
	{
		$id = intval($id);
		$res = mysqli_query($this->db, "SELECT * FROM command WHERE id='".$id."' LIMIT 1");
		$command = mysqli_fetch_object($res, "Command", [$this->db]);
		return $command;
	}


	public function findCartByUser(User $user)
	{
		$id_user= intval($user->getId());
		$res = mysqli_query($this->db, "SELECT * FROM command WHERE status='panier' AND id_customer='".$id_user."' LIMIT 1");
		$cart = mysqli_fetch_object($res, "Command", [$this->db]);
		return $cart;
	}

	
	public function findByUser(User $user)
	{
		$id_user = intval($user->getId());
		$res  = mysqli_query($this->db, "SELECT * FROM users WHERE id_customer='".$id_user."' LIMIT 1");
		$command = mysqli_fetch_object($res, "User", [$this->db]);
		while ($user = mysqli_fetch_object($res, "Command", [$this->db]))
		{
			$list[] = $user;
		}
		return $list;
	}
	
	public function save(Command $command)
	{
		$id = intval($command->getId());
		
		$products = $command->getItems();
		$itemManager = new ItemManager($this->db);

		mysqli_query($this->db, "DELETE FROM link_command_items WHERE id_command='".$id."'");
		$count = 0;
		while ($count < count($products))
		{	
			$item = $products[$count];
			mysqli_query($this->db, "INSERT INTO link_command_items(id_command, id_items) VALUES('".$id."', '".$products[$count]->getId()."')");
			$count++;
			$item->setStock($item->getStock() -1);
			$itemManager->save($item);
		}

		$id_customer = intval ($command->getUser()->getId());
		$price = floatval($command->getPrice());
		$id_customer = intval($command->getUser()->getId());
		$status = mysqli_real_escape_string($this->db, $command->getStatus());

		$res = mysqli_query($this->db, "UPDATE command SET price='".$price."', id_customer='".$id_customer."', status='".$status."' WHERE id='".$id."' LIMIT 1");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		return $this->findById($id);
	}
	public function remove(Command $command)
	{
		$id = intval($command->getId());
		mysqli_query($this->db, "DELETE from command WHERE id='".$id."' LIMIT 1");
		return $command;
	}
	public function create(User $customer)
	{
		$errors = [];
		$command = new Command($this->db);
		
		$error = $command->setUser($customer);
		if ($error)
		{
			$errors[] = $error;
		}
		
		// $id_customer = intval($command->getidAuthor());
		$id_customer = intval($command->getUser()->getId());

		$res = mysqli_query($this->db, "INSERT INTO command (id_customer) VALUES('".$id_customer."')");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>