<?php
class Comment
{
	// Propriétés Stockées
	private $id;
	private $content;
	private $id_author;
	private $id_article;
	private $date;

	// Propriété Calculée
	private $author;// class User
	private $article;// class Article

	// Propriété Transmise
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getContent()
	{
		return $this->content;
	}
	// public function getIdAuthor()
	// {
	// 	return $this->id_author;
	// }
	public function getArticle()
	{
		$manager = new ArticleManager($this->db);
		$this->article = $manager->findById($this->id_article);
		return $this->article;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function getAuthor()
	{
		$manager = new UserManager($this->db);
		$this->author = $manager->findById($this->id_author);
		return $this->author;// null
	}
	public function setAuthor(User $author)
	{
		$this->author = $author;
		$this->id_author = $author->getId();
	}
	public function setContent($content)
	{
		if (strlen($content) < 3)
		{
			return "Contenu trop court (< 3)";
		}
		else if (strlen($content) > 2047)
		{
			return "Contenu trop long (> 2047)";
		}
		else
		{
			$this->content = $content;
		}
	}
	// public function setIdAuthor($id_author)
	// {
	// 	$this->id_author = $id_author;
	// }
	public function setArticle(Article $article)
	{
		$this->article = $article;
		$this->id_article = $article->getId();
	}
}
?>