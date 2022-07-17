<?php 
class user{
    private $id;
    private $name;
    private $password;
    private $email;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}


	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}
    public function User0(){}

    public function User2($email, $password)
    {

        $this->email=$email;
        $this->password=$password;
    }

    public function User3($name, $email, $password)
    {
        $this->name=$name;
        $this->email=$email;
        $this->password=$password;
    }
    function __construct(){
        $a=func_get_args();
        $i=func_num_args();

        if (method_exists($this,$f='User'.$i)) {
            call_user_func_array(array($this,$f), $a);
        }
    }

    function __destruct()
    {
    }
}