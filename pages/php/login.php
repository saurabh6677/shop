<?php



class db{
	private $db;
	function database()
	{
		$this->db = new mysqli("localhost","root","","bookstore");
		if(!$this->db->connect_error)
		{
			return $this->db;
		}
		else
		{
			echo "connection faild";
		}
	}
}


class main{
	private $email;
	private $password;
	private $db;
	function __construct(){
		$this->db = new db();
		$this->db = $this->db->database();
		$this->email = trim($_POST['email']);
		$this->email = htmlspecialchars($this->email,ENT_QUOTES);
		$this->email = mysqli_real_escape_string($this->db, $this->email);
		$this->password = trim($_POST['password']);
		$this->password = md5($this->password);
		new check_email($this->email,$this->password);
	}
}


class check_email{
		private $email;
		private $db;
		private $query;
		private $password;
		function __construct($mail,$pass)
		{
			$this->email = $mail;
			$this->password = $pass;
			$this->db = new db();
			$this->db = $this->db->database();
			$this->query = $this->db->prepare("SELECT * FROM users WHERE email=?");
			$this->query->bind_param('s',$this->email);
			$this->query->execute();
			$this->query = $this->query->get_result();
			if($this->query->num_rows != 0)
			{
				new check_pass($this->email,$this->password);
			}
			else
			{
				echo "wrong email address";
			}

		}
}

class check_pass{
	private $db;
	private $password;
	private $email;
	private $query;
	private $username;
	function __construct($email,$pass){

		$this->db = new db();
		$this->db = $this->db->database();
		$this->email = $email;
		$this->password = $pass;
		$this->query = $this->db->prepare("SELECT * FROM users WHERE email=? AND password=?");
		$this->query->bind_param('ss',$this->email,$this->password);
		$this->query->execute();
		$this->query = $this->query->get_result();

		if($this->query->num_rows !=0)
		{
			$this->query = $this->query->fetch_assoc();
			$this->query = $this->query['status'];
			if($this->query == "pending")
			{
				session_start();
				$_SESSION['email'] = $this->email;
				echo "pending";
			}
			else
			{
				$this->username = base64_encode($this->email);
				$this->time = time()+(60*60*24*7);

				setcookie("_bk_",$this->username,$this->time,"/");
				echo "success";
			}
		}
		else
		{
			echo "wrong password";
		}

	}
}





new main();











?>