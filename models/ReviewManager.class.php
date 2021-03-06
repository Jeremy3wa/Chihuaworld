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
		while ($review = mysqli_fetch_object($res, "Review", [$this->db]))
		{
			$list[] = $review;
		}
		return $list;
	}
	public function findById($id)
	{
		$id = intval($id);
		$res = mysqli_query($this->db, "SELECT * FROM reviews WHERE id='".$id."' LIMIT 1");
		$review = mysqli_fetch_object($res, "Review", [$this->db]);
		return $review;
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
	public function create($content, User $customer, Item $item, $rate)
	{
		$errors = [];
		$review = new Review($this->db);
		$error = $review->setContent($content);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $review->setCustomer($customer);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $review->setItem($item);
		if ($error)
		{
			$errors[] = $error;
		}
		$error = $review->setRate($rate);
		if ($error)
		{
			$errors[] = $error;
		}
		if (count($errors) != 0)
		{
			throw new Exceptions($errors);
		}
		$content = mysqli_real_escape_string($this->db, $review->getContent());
		$rate = intval($review->getRate());
		$id_customer = intval($review->getCustomer()->getId());
		$id_item = intval($review->getItem()->getId());
		$res = mysqli_query($this->db, "INSERT INTO reviews (content, id_customer, id_item, rate) VALUES('".$content."', '".$id_customer."', '".$id_item."', '".$rate."')");
		if (!$res)
		{
			throw new Exceptions(["Erreur interne"]);
		}
		$id = mysqli_insert_id($this->db);
		return $this->findById($id);
	}
}
?>