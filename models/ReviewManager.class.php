<?php
class ReviewManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}
	public function findByItem(Item $item)
	{
		$id_item = intval($item->getId());
		$list = [];
		$res = mysqli_query($this->db, "SELECT * FROM reviews WHERE id_item='".$id_item."' ORDER BY date DESC");
		while ($item = mysqli_fetch_object($res, "Review", [$this->db]))
		{
			$list[] = $item;
		}
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$res = mysqli_query($this->db, "SELECT * FROM reviews WHERE id='".$id."' LIMIT 1");
		$item = mysqli_fetch_object($res, "Item", [$this->db]);
		return $item;
	}
	public function save(Review $review)
	{
		$id = intval($review->getId());
		$content = mysqli_real_escape_string($this->db, $review->getContent());
		$id_customer = intval($review->getCustomer()->getId());
		$id_item = intval($review->getItem()->getId());
		$res = mysqli_query($this->db, "UPDATE reviews SET content='".$content."', id_customer='".$id_customer."', id_item='".$id_item."' WHERE id='".$id."' LIMIT 1");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		return $this->findById($id);
	}
	public function remove(Review $review)
	{
		$id = intval($review->getId());
		mysqli_query($this->db, "DELETE from reviews WHERE id='".$id."' LIMIT 1");
		return $review;
	}
	public function create($content, User $customer, Item $item)
	{
		$errors = [];
		$review = new Review($this->db);
		$error = $review->setContent($content);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $review->setCustomer($cutomer);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $review->setItem($item);
		if ($error)
		{
			$errors[] = $error;
		}
		if (count($errors) != 0)
		{
			throw new Exceptions($errors);
		}
		$content = mysqli_real_escape_string($this->db, $review->getContent());
		// $id_author = intval($comment->getIdAuthor());
		$id_customer = intval($review->getCustomer()->getId());
		$id_item = intval($review->getItem()->getId());
		$res = mysqli_query($this->db, "INSERT INTO reviews (content, id_customer, id_item) VALUES('".$content."', '".$id_customer."', '".$id_item."')");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>