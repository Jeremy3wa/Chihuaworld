<?php
class UserManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	// SELECT
	public function findAll()
	{
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM users ORDER BY login");
		while ($user = mysqli_fetch_object($res, "User", [$this->db])) // $user = new User();
		{
			$list[] = $user;
		}
		return $list;
	}
	public function findById($id)
	{
		// /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\
		$id = intval($id);
		// /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\
		$res = mysqli_query($this->db, "SELECT * FROM users WHERE id='".$id."' LIMIT 1");
		$user = mysqli_fetch_object($res, "User", [$this->db]); // $user = new User();
		return $user;
	}
	// on en a besoin pour la partie login du site internet
	public function findByLogin($login)
	{
		// /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\
		$login = mysqli_real_escape_string($this->db, $login);
		// /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\ /!\
		$res = mysqli_query($this->db, "SELECT * FROM users WHERE login='".$login."' LIMIT 1");
		$user = mysqli_fetch_object($res, "User", [$this->db]); // $user = new User();
		return $user;
	}
	// UPDATE
	public function save(User $user)
	{
		$id = intval($user->getId());
		$email = mysqli_real_escape_string($this->db, $user->getEmail());
		$firstname = mysqli_real_escape_string($this->db, $user->getFirstname());
		$lastname = mysqli_real_escape_string($this->db, $user->getLastname());
		$adress = mysqli_real_escape_string($this->db, $user->getAdress());
		$password = mysqli_real_escape_string($this->db, $user->getPassword());
		$login = mysqli_real_escape_string($this->db, $user->getLogin());
		$birthdate = mysqli_real_escape_string($this->db, $user->getBirthdate());

		$admin = mysqli_real_escape_string($this->db, $user->isAdmin());
		$res = mysqli_query($this->db, "UPDATE users SET email='".$email."',firstname='".$firstname."',lastname='".$lastname."', adress='".$adress."', password='".$password."', login='".$login."', birthdate='".$birthdate."', admin='".$admin."' WHERE id='".$id."' LIMIT 1");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		return $this->findById($id);
	}
	// DELETE
	public function remove(User $user)
	{
		$id = intval($user->getId());
		mysqli_query($this->db, "DELETE from users WHERE id='".$id."' LIMIT 1");
		return $user;
	}
	// INSERT
	public function create($login, $firstname, $lastname, $adress, $password1, $password2, $email, $birthdate)
	{
		$errors = [];
		$user = new User($this->db);
		if (($error = $user->setEmail($_POST['email'])))
			$errors[] = $error;
		if (($error = $user->setName($_POST['name'])))
			$errors[] = $error;
		if (($error = $user->setAddress($_POST['address'])))
			$errors[] = $error;
		if (($error = $user->setFirstname($_POST['firstname'])))
			$errors[] = $error;
		if (($error = $user->setBirthdate($birthdate)))
			$errors[] = $error;
		if (($error = $user->initPassword($_POST['password1'], $_POST['password2'])))
			$errors[] = $error;
		if (count($errors) != 0)
		{
			throw new Exceptions($errors);
		}
		$login = mysqli_real_escape_string($this->db, $user->getLogin());
		$firstname = mysqli_real_escape_string($this->db, $user->getFirstname());
		$lastname = mysqli_real_escape_string($this->db, $user->getLastname());
		$adress = mysqli_real_escape_string($this->db, $user->getAdress());
		$email = mysqli_real_escape_string($this->db, $user->getEmail());
		$birthdate = mysqli_real_escape_string($this->db, $user->getBirthdate());
		$hash = mysqli_real_escape_string($this->db, $user->getPassword());
		$res = mysqli_query($this->db, "INSERT INTO users (email, firstname, lastname, adress, password, login, birthdate) VALUES('".$email."','".$firstname."','".$lastname."','".$adress."', '".$hash."', '".$login."', '".$birthdate."')");
		// var_dump(mysqli_error($this->db));

		// if (!$res)
		// {
		// 	throw new Exceptions(["Erreur interne"]);
		// }
		$id = mysqli_insert_id($this->db);// last_insert_id
		return $this->findById($id);
	}
}
?>