<?php

class Book{
    private $id;
    private $title;
    private $author;
    private $price;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($author){
		$this->author = $author;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}

    public function Book4($id,$title, $author, $price)
    {
		$this->id=$id;
        $this->title=$title;
        $this->author=$author;
        $this->price=$price;
    }

    function __construct(){
        $a=func_get_args();
        $i=func_num_args();

        if (method_exists($this,$f='Book'.$i)) {
            call_user_func_array(array($this,$f), $a);
        }
    }

    function __destruct()
    {
    }
}
