<?php
class ArticleManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function findAll()
	{
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM articles ORDER BY date DESC");
		while ($article = mysqli_fetch_object($res, "Article", [$this->db]))
		{
			$list[] = $article;
		}
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$res = mysqli_query($this->db, "SELECT * FROM articles WHERE id='".$id."' LIMIT 1");
		$article = mysqli_fetch_object($res, "Article", [$this->db]);
		return $article;
	}
	public function save(Article $article)
	{
		$id = intval($article->getId());
		$content = mysqli_real_escape_string($this->db, $article->getContent());
		$title = mysqli_real_escape_string($this->db, $article->getTitle());
		$id_author = intval($article->getAuthor()->getId());
		$res = mysqli_query($this->db, "UPDATE articles SET content='".$content."', title='".$title."', id_author='".$id_author."' WHERE id='".$id."' LIMIT 1");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		return $this->findById($id);
	}
	public function remove(Article $article)
	{
		$id = intval($article->getId());
		mysqli_query($this->db, "DELETE from articles WHERE id='".$id."' LIMIT 1");
		return $article;
	}
	public function create($content, $title, User $author)
	{
		$errors = [];
		$article = new Article($this->db);
		$error = $article->setTitle($title);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $article->setContent($content);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $article->setAuthor($author);
		if ($error)
		{
			$errors[] = $error;
		}
		if (count($errors) != 0)
		{
			throw new Exceptions($errors);
		}
		$content = mysqli_real_escape_string($this->db, $article->getContent());
		$title = mysqli_real_escape_string($this->db, $article->getTitle());
		$id_author = intval($article->getAuthor()->getId());
		$res = mysqli_query($this->db, "INSERT INTO articles (content, title, id_author) VALUES('".$content."', '".$title."', '".$id_author."')");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>