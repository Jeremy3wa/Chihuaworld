<?php
// Etape 0
// var_dump($_POST);
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
		if (isset($_POST['login'], $_POST['birthdate'], $_POST['email'], $_POST['password1'], $_POST['password2']))
		{
			// Etape 2
			$manager = new UserManager($db);
			try
			{
				// Etape 3
				// public function create($login, $password1, $password2, $email, $birthdate)
				$user = $manager->create($_POST['login'], $_POST['password1'], $_POST['password2'], $_POST['email'], $_POST['birthdate']);
				if ($user)
				{
					// Etape 4
					header('Location: index.php?page=login');
					exit;
				}
				else
				{
					$errors[] = "Erreur interne";
				}
			}
			catch (Exceptions $e)
			{
				$errors = $e->getErrors();
			}
		}
	}
	if ($action == "login")
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
					if (password_verify($_POST['password'], $user->getPassword()))
					{
						$_SESSION['id'] = $user->getId();
						$_SESSION['login'] = $user->getLogin();
						$_SESSION['admin'] = $user->isAdmin();
						// Etape 4
						header('Location: index.php?page=articles');
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
}
?>