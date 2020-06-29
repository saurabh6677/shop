<?php
session_start();
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
			echo "conaction faild";
		}
	}
}


class main{
	private $db;
	private $email;
	private $otp;
	private $query;
	private $data;
	private $otp_o;
	private $active;
	private $time;
	private $username;
	function __construct()
	{
		$this->db = new db();
		$this->db = $this->db->database();
		$this->email = $_SESSION['email'];
		$this->otp = trim($_POST['otp']);
		$this->otp = htmlspecialchars($this->otp);
		$this->otp = mysqli_real_escape_string($this->db,$this->otp);

		$this->query = $this->db->prepare("SELECT * FROM users WHERE email=?");
		$this->query->bind_param('s',$this->email);
		$this->query->execute();
		$this->data = $this->query->get_result();
		$this->otp_o = $this->data->fetch_assoc();
		$this->otp_o =  $this->otp_o['otp'];
		$this->active = "active";
		if($this->otp == $this->otp_o)
		{
			$this->query = $this->db->prepare("UPDATE users SET status=? WHERE email=? AND otp=?");
			$this->query->bind_param('ssi',$this->active,$this->email,$this->otp);
			$this->query->execute();
			if($this->query->affected_rows != 0)
			{
				echo "success";
				$this->username = base64_encode($this->email);
      			$this->time = time()+(60*60*24*365);

      			setcookie("_bk_",$this->username,$this->time,"/");
			}
			else
			{
				echo "something went wrong";
			}
		}
		else
		{
			echo "Wrong otp";
		}

	}
}


new main();





?>