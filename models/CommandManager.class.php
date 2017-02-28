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
		$status = mysqli_real_escape_string($this->db);
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

	
	public function findByUser(User $user)
	{
		$id_users = intval($user->getId());
		$res  = mysql_query($this->db, "SELECT * FROM users WHERE ");
		$command = mysqli_fetch_object($res, "User", [$this->db]);
		while ($user = mysqli_fetch_object($res, "Command", [$this->db]))
		{
			$list[] = $status;
		}
		return $list;
	}
	
	public function save(Command $command)
	{
		$id = intval($command->getId());
		$price = mysqli_real_escape_string($this->db, $command->getPrice());
		$id_customer = intval($command->getCustomer()->getId());
		$status = intval($command->getStatus());
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
	public function create($price, User $customer, $status)
	{
		$errors = [];
		$command = new Command($this->db);
		$error = $command->setPrice($price);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $command->setCustomer($customer);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $command->setStatus($status);
		if ($error)
		{
			$errors[] = $error;
		}
		if (count($errors) != 0)
		{
			throw new Exceptions($errors);
		}
		$price = mysqli_real_escape_string($this->db, $command->getPrice());
		// $id_customer = intval($command->getidAuthor());
		$id_customer = intval($command->getCustomer()->getId());

		$status = intval($command->getStatus());
		$res = mysqli_query($this->db, "INSERT INTO command (price, id_customer, status) VALUES('".$price."', '".$id_customer."', '".$status."')");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>