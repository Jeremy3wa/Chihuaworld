<?php
class CommandManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	public function Status(Status $status)
	{
		$status = intval($status->getId());
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM commands WHERE status='".$status."' ORDER BY date DESC");
		while ($command = mysqli_fetch_object($res, "Command", [$this->db]))
		{
			$list[] = $command;
		}
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$res = mysqli_query($this->db, "SELECT * FROM commands WHERE id='".$id."' LIMIT 1");
		$command = mysqli_fetch_object($res, "Command", [$this->db]);
		return $command;
	}
	public function save(Command $command)
	{
		$id = intval($command->getId());
		$price = mysqli_real_escape_string($this->db, $command->getPrice());
		$id_customer = intval($command->getCustomer()->getId());
		$status = intval($command->getIdStatus());
		$res = mysqli_query($this->db, "UPDATE commands SET price='".$price."', id_customer='".$id_customer."', status='".$status."' WHERE id='".$id."' LIMIT 1");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		return $this->findById($id);
	}
	public function remove(Command $command)
	{
		$id = intval($command->getId());
		mysqli_query($this->db, "DELETE from commands WHERE id='".$id."' LIMIT 1");
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
		$error = $command->setIdCustomer($customer);
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

		$status = intval($command->getIdStatus());
		$res = mysqli_query($this->db, "INSERT INTO commands (price, id_customer, status) VALUES('".$price."', '".$id_customer."', '".$status."')");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>