<?php
session_start();
class db
{
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
			echo "database error";
		}
	}
}


class main{
	private $fullname;
	private $email;
	private $mobile;
	private $pincode;
	private $country;
	private $district;
	private $city;
	private $state;
	private $db;
	private $query;
	private $response;
	private $store;
	private $otp;
	private $headers;
	private $mail;
	private $massage;
	function __construct()
	{
		$this->db = new db();
		$this->db = $this->db->database();
		$this->fullname = trim($_POST['fullname']);
		$this->fullname = htmlspecialchars($_POST['fullname'],ENT_QUOTES);
		$this->fullname = mysqli_real_escape_string($this->db, $this->fullname);
		$this->email = trim($_POST['email']);
		$this->email = htmlspecialchars($_POST['email'],ENT_QUOTES);
		$this->email = mysqli_real_escape_string($this->db, $this->email);
		$this->password = trim($_POST['password']);
		$this->password = md5($this->password);
		$this->password = mysqli_real_escape_string($this->db, $this->password);
		$this->mobile = trim($_POST['mobile']);
		$this->mobile = htmlspecialchars($_POST['mobile'],ENT_QUOTES);
		$this->mobile = mysqli_real_escape_string($this->db, $this->mobile);
		$this->pincode = trim($_POST['pincode']);
		$this->pincode = htmlspecialchars($_POST['pincode'],ENT_QUOTES);
		$this->pincode = mysqli_real_escape_string($this->db, $this->pincode);
		$this->country = trim($_POST['country']);
		$this->country = htmlspecialchars($_POST['country'],ENT_QUOTES);
		$this->country = mysqli_real_escape_string($this->db, $this->country);
		$this->state = trim($_POST['state']);
		$this->state = htmlspecialchars($_POST['state'],ENT_QUOTES);
		$this->state = mysqli_real_escape_string($this->db, $this->state);
		$this->district = trim($_POST['district']);
		$this->district = htmlspecialchars($_POST['district'],ENT_QUOTES);
		$this->district = mysqli_real_escape_string($this->db, $this->district);
		$this->city = trim($_POST['city']);
		$this->city = htmlspecialchars($_POST['city'],ENT_QUOTES);
		$this->city = mysqli_real_escape_string($this->db, $this->city);
		$this->otp = rand(978864, 124986);
		$this->query = "SELECT * FROM users";
		$this->response = $this->db->query($this->query);
		if($this->response)
		{
			$this->query = $this->db->prepare("INSERT INTO users(fullname,email,password,otp,mobile,pincode,country,state,district,city)VALUES(?,?,?,?,?,?,?,?,?,?)");
				
				$this->query->bind_param('sssisissss',$this->fullname,$this->email,$this->password,$this->otp,$this->mobile,$this->pincode,$this->country,$this->state,$this->district,$this->city);
				$this->query->execute();
				if($this->query->affected_rows !=0)
				{
					$this->headers = "From: saurabh@gmail.com" . "\r\n";
					$this->headers .= "MIME-Version: 1.0" . "\r\n";
					$this->headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
					$this->massage = '<div width="700px;" style="background-color:#ccc;padding:15px">
   <div class="adM">
   </div>
   <table align="center" width="100%" style="font-family:Helvetica,Arial,serif;background-color:#fff;padding:0px 20px;border-bottom:1px solid #4cb96b">
      <tbody>
         <tr align="center">
            <td style="padding-top:10px">
               <h1 style="color:green" align="center">Bookstore.com</h1>
            </td>
         </tr>
      </tbody>
   </table>
   <table align="center" width="100%" style="font-family:Helvetica,Arial,serif;background-color:#fff;padding:0px 20px 20px 20px;border-bottom:1px solid #4cb96b">
      <tbody>
         <tr align="center">
            <td style="font-size:20px">
               Sell and Buy Old Books
            </td>
         </tr>

         <tr>
            <td style="font-size:14px;padding-top:10px;color:#000">
               Hi '.$this->email.',<br><br>This massage from Bookstore.com!<br><br>Thank you for registering for us. <br><br><br><br>To help you stay on track, we’ll send you a reminder email when any changes are made in website.You can view all books <br><br><br><br>
            </td>
         </tr>
          <tr align="center">
            <td style="font-size:20px;color: red">
               Your OTP IS : '.$this->otp.'
            </td>
         </tr>
        
      </tbody>
   </table>
   <table align="center" width="100%" style="font-family:Helvetica,Arial,serif;background-color:#fff;padding:0px 20px 20px 20px;border-bottom:1px solid #4cb96b">
      <tbody>
        
         
      </tbody>
   </table>
   <div class="yj6qo"></div>
   <div class="adL">
   </div>
</div>';

					$this->mail = mail($this->email, "Bookstore OTP", $this->massage,$this->headers);
						if($this->mail)
						{
							echo "success";
							
							$_SESSION['email'] = $this->email;
						}
						else
						{
							echo "faild to send otp on your email";
						}
				}
				else
				{
					echo "unable to store data";
				}
		}
		else
		{
			$this->query = "CREATE TABLE users(
							id INT(11) NOT NULL AUTO_INCREMENT,
							fullname VARCHAR(50),
							email VARCHAR(50),
							password VARCHAR(100),
							otp INT(10),
							status VARCHAR(20) DEFAULT 'pending',
							mobile VARCHAR(20) NULL,
							pincode VARCHAR(10),
							country VARCHAR(20),
							state VARCHAR(50),
							district VARCHAR(100),
							city VARCHAR(100),
							address VARCHAR(250) NULL,
							college VARCHAR(100) NULL,
							course VARCHAR(100) NULL,
							PRIMARY KEY(id))";
			$this->response = $this->db->query($this->query);
			if($this->response)
			{
				$this->query = $this->db->prepare("INSERT INTO users(fullname,email,password,otp,mobile,pincode,country,state,district,city)VALUES(?,?,?,?,?,?,?,?,?,?)");
				$this->query->bind_param('ssssssssss',$this->fullname,$this->email,$this->password,$this->otp,$this->mobile,$this->pincode,$this->country,$this->state,$this->district,$this->city);
				$this->query->execute();
				if($this->query->affected_rows !=0)
				{
					$this->headers = "From: saurabh@gmail.com" . "\r\n";
					$this->headers .= "MIME-Version: 1.0" . "\r\n";
					$this->headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
					$this->massage = '<div width="700px;" style="background-color:#ccc;padding:15px">
   <div class="adM">
   </div>
   <table align="center" width="100%" style="font-family:Helvetica,Arial,serif;background-color:#fff;padding:0px 20px;border-bottom:1px solid #4cb96b">
      <tbody>
         <tr align="center">
            <td style="padding-top:10px">
               <h1 style="color:green" align="center">Bookstore.com</h1>
            </td>
         </tr>
      </tbody>
   </table>
   <table align="center" width="100%" style="font-family:Helvetica,Arial,serif;background-color:#fff;padding:0px 20px 20px 20px;border-bottom:1px solid #4cb96b">
      <tbody>
         <tr align="center">
            <td style="font-size:20px">
               Sell and Buy Old Books
            </td>
         </tr>

         <tr>
            <td style="font-size:14px;padding-top:10px;color:#000">
               Hi '.$this->email.',<br><br>This massage from Bookstore.com!<br><br>Thank you for registering for us. <br><br><br><br>To help you stay on track, we’ll send you a reminder email when any changes are made in website.You can view all books <br><br><br><br>
            </td>
         </tr>
          <tr align="center">
            <td style="font-size:20px;color: red">
               Your OTP IS : '.$this->otp.'
            </td>
         </tr>
        
      </tbody>
   </table>
   <table align="center" width="100%" style="font-family:Helvetica,Arial,serif;background-color:#fff;padding:0px 20px 20px 20px;border-bottom:1px solid #4cb96b">
      <tbody>
        
         
      </tbody>
   </table>
   <div class="yj6qo"></div>
   <div class="adL">
   </div>
</div>';

					$this->mail = mail($this->email, "Bookstore OTP", $this->massage,$this->headers);
						if($this->mail)
						{
						  echo "success";

							$_SESSION['email'] = $this->email;
						}
						else
						{
							echo "faild to send otp on your email";
						}
				}
				else
				{
					echo "unable to store data";
				}

			}
			else
			{
				echo " unable to create table";
			}
		}



	}

	
	


}


class check_user{
	private $email;
	private $mobile;
	private $db;
	private $query;
	private $response;
	function __construct()
	{
		$this->db = new db();
		$this->db = $this->db->database();
		$this->email = trim($_POST['email']);
		$this->email = htmlspecialchars($_POST['email'],ENT_QUOTES);
		$this->email = mysqli_real_escape_string($this->db, $this->email);
		$this->mobile = trim($_POST['mobile']);
		$this->mobile = htmlspecialchars($_POST['mobile'],ENT_QUOTES);
		$this->mobile = mysqli_real_escape_string($this->db, $this->mobile);
		$this->query = $this->db->prepare("SELECT * FROM users WHERE email=? OR mobile=?");
		$this->query->bind_param('si',$this->email,$this->mobile);
		$this->query->execute();
		$this->response = $this->query->get_result();
		if($this->response->num_rows !=0)
		{
			echo "This email already registerd";
		}
		else
		{
			new main();
		}
	}
}

class check_table{
	private $db;
	private $query;
	private $response;
	function __construct()
	{
		$this->db = new db();
		$this->db = $this->db->database();
		$this->query = "SELECT city FROM users";
		$this->response = $this->db->query($this->query);
		if($this->response)
		{
			new check_user();
		}
		else
		{
			new main();
		}
	}
}

new check_table();



?>