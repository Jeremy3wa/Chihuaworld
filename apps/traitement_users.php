<?php
// Etape 0

if (isset($_GET['page']) && $_GET['page'] == "logout")
{
	session_destroy();
	header('Location: index.php');
	exit;
}
if (isset($_POST['action']))
{
	$action = $_POST['action'];
	if ($action == "register")
	{
		// Etape 1
		if (isset($_POST['login'],$_POST['firstname'], $_POST['lastname'], $_POST['birthdate'], $_POST['adress'], $_POST['email'], $_POST['password1'], $_POST['password2']))
		{
			// Etape 2
			$manager = new UserManager($db);
			try
			{
				// Etape 3
				// public function create($login, $password1, $password2, $email, $birthdate)
				$user = $manager->create($_POST['login'], $_POST['firstname'], $_POST['lastname'], $_POST['adress'], $_POST['password1'], $_POST['password2'], $_POST['email'], $_POST['birthdate']);
				if ($user)
				{
					// Etape 4
					header('Location: index.php?page=login');
					exit;
				}
				else
				{
					$user1 = $manager->findByEmail($_POST['email']);
					$user2 = $manager->findByName($_POST['name']);
					if ($user1)
					{
						$errors[] = "Email deja existant";
					}
					else if ($user2)
					{
						$errors[] = "Nom deja existant";
					}
					else
					{
						$errors[] = "Erreur interne";
					}
				}
			}
			catch (Exceptions $e)
			{
				$errors = $e->getErrors();
			}
		}
	}
	else if ($action == "login")
	{
		// Etape 1
		if (isset($_POST['login'], $_POST['password']))
		{
			// Etape 2
			$manager = new UserManager($db);
			try
			{
				// Etape 3
				$user = $manager->findByLogin($_POST['login']);
				if ($user)
				{
					if ($user->verifPassword($_POST['password']))
					{
						$_SESSION['id'] = $user->getId();
						$_SESSION['login'] = $user->getLogin();
						$_SESSION['admin'] = $user->isAdmin();
						// Etape 4
						header('Location: index.php?page=items');
						exit;
					}
					else
					{
						$errors[] = "Mot de passe incorrect";
					}
				}
				else
				{
					$errors[] = "Login inconnu";
				}
			}
			catch (Exceptions $e)
			{
				$errors = $e->getErrors();
			}
		}
	}
	else if ($action == "update")
	{
		// Etape 1
		if (isset($_SESSION['id'], $_POST["password"], $_POST['firstname'], $_POST['lastname'], $_POST['adress'], $_POST['email'], $_POST["old_password"]))
		{
			// Etape 2
			$manager = new UserManager($db);
			try
			{
				// Etape 3
				$user = $manager->findById($_SESSION['id']);
				if ($user)
				{
					if ($user->verifPassword($_POST['old_password']))
					{	
						if (($error = $user->setEmail($_POST['email'])))
							$errors[] = $error;
						if (($error = $user->updatePassword($_POST['password'], )
							$errors[] = $error;
						if (($error = $user->setName($_POST['name'])))
							$errors[] = $error;
						if (($error = $user->setAddress($_POST['address'])))
							$errors[] = $error;
						if (($error = $user->setCity($_POST['firstname'])))
							$errors[] = $error;

						if (count($errors) == 0)
						{	
							$manager->save($user);
							$_SESSION['login'] = $user->getLogin();
							// Etape 4
							header('Location: index.php?page=items');
							exit;
						}
					}
					else
					{
						$errors[] = "Mot de passe incorrect";
					}
				}
				else
				{
					$errors[] = "Login inconnu";
				}
			}
			catch (Exceptions $e)
			{
				$errors = $e->getErrors();
			}
		}
	}
}
?>