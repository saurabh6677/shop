<?php
session_start();

class db{
	private $db;
	function database(){
		$this->db = new mysqli("localhost","root","","bookstore");
		if(!$this->db->connect_error)
		{
			return $this->db;
		}
		else
		{

		}
	}
}


class main{
	private $db;
	private $otp;
	private $query;
	private $email;
	function __construct(){
		$this->email = $_SESSION['email'];
		$this->db = new db();
		$this->db = $this->db->database();
		$this->otp = rand(637343,834839);
		$this->query = $this->db->prepare("UPDATE users SET otp=? WHERE email=?");
		$this->query->bind_param('is',$this->otp,$this->email);
		$this->query->execute();

		if($this->query->affected_rows !=0)
		{
			new send($this->email,$this->otp);
		}
		else
		{
			echo "otp send faild";
		}

	}



}



class send
{
	private $massage;
	private $headers;
	private $check;
	private $otp;
	private $email;
	function __construct($one,$two)
	{
		$this->email = $one;
		$this->otp = $two;
		$this->headers = "From: saurabh@gmail.com" . "\r\n";
		$this->headers = "MIME-Version: 1.0" . "\r\n";
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

	$this->check = mail($this->email, "Bookstore otp", $this->massage,$this->headers);
	if($this->check)
	{
		echo "success";
	}
	else
	{
		echo "faild";
	}
	}
}



new main();












?>