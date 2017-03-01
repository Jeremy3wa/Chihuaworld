<?php
class Article
{
	private $id;
	private $title;
	private $content;
	private $id_author;
	private $date;

	private $author;
	private $comments;

	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getTitle()
	{
		return $this->title;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function getAuthor()
	{
		$manager = new UserManager($this->db);
		$this->author = $manager->findById($this->id_author);
		return $this->author;// null
	}
	public function getComments()
	{
		$manager = new CommentManager($this->db);
		$this->comments = $manager->findByArticle($this);
		return $this->comments;
	}
	public function getDate()
	{
		return $this->date;
	}
	public function setTitle($title)
	{
		if (strlen($title) > 63)
		{
			return "Titre trop long (> 63)";
		}
		else if (strlen($title) < 5)
		{
			return "Titre trop court (< 5)";
		}
		else
		{
			$this->title = $title;
		}
	}
	public function setContent($content)
	{
		if (strlen($content) > 4095)
		{
			return "Contenu trop long (> 4095)";
		}
		else if (strlen($content) < 65)
		{
			return "Contenu trop court (< 65)";
		}
		else
		{
			$this->content = $content;
		}
	}
	public function setAuthor(User $author)
	{
		$this->author = $author;
		$this->id_author = $author->getId();
	}
}
?>