<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		/*call CodeIgniter's default Constructor*/
		parent::__construct();

		/*load database libray manually*/
		$this->load->database();

		/*load Model*/
		$this->load->model('User_model');

		$this->load->library('session');


		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	}

	public function index()
	{

		// Validation
		$this->form_validation->set_rules('uname', 'Username', 'required|alpha|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('email', 'email', 'required|valid_email|valid_emails|is_unique[user.email]', array('is_unique' => 'Email Already Register'));

		$this->form_validation->set_rules('pass', 'password', 'required|alpha|exact_length[8]|alpha');

		if ($this->form_validation->run()) {

			// get form data and store in local variable
			$uname = $this->input->post('uname');
			$email = $this->input->post('email');
			$pass = $this->input->post('pass');

			$otp = rand(1111, 9999);

			$this->session->set_userdata('session_id', $email); //SET SESSION
			// echo $this->session->userdata('session_id');

			$this->User_model->cust_register($uname, $email, $pass, $otp);

			if ($this->session->userdata('session_id')) {

				echo 'session set';
				$html = '<h2>YOUR OTP VERIFICATION is</h2>' . $otp;

				$this->smtp_mailer($email, 'OTP VERFICIATION', $html);

				$send_email = $this->email->send();	
				// echo 'exist';

				redirect('User/check_otp'); //redirect to checkotp page
			}
			//Send mail
		} else {
			// echo 'not_exist';
		}

		$this->load->view('index');
	}

	public function check_otp() //CHECK OTP
	{

		$this->load->view('otp');
		if ($this->input->post('otp')) {

			$otp = $this->input->post('otp');
			// echo $otp;
			$email = $this->session->userdata('session_id');
			// echo $email;
			$this->User_model->check($otp, $email);
			// redirect('User/');
			// $this->session->unset_userdata('session_id');
		}
	}


	function smtp_mailer($to, $subject, $msg) //SMTP MAILER
	{

		$this->load->library('PHPMailer');

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 1;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'TLS';
		$mail->Host = "smtp.sendgrid.net";
		$mail->Port = 587;
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Username = ""; // Username sendgrid
		$mail->Password = ""; // password of sendgrid
		$mail->SetFrom(""); // sendgrid
		$mail->Subject = $subject;
		$mail->Body = $msg;
		$mail->AddAddress($to);
		if (!$mail->Send()) {
			return 0;
		} else {
			return 1;
		}
	}


	public function check_email() //check email validate through ajax
	{
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo "<div id='email_result' class='error'>invalid Email</div>";
		} else {
			if ($this->User_model->is_available_email($_POST['email'])) {

				echo "<div id='email_result' style='color:red;font-weight:700'>Email Already Register</div>";
			} else {
				echo "<div id=`email_result` style='color:green;font-weight:700'>Email Available </div>";
			}
		}
	}




	public function logout()
	{

		if ($this->session->userdata('session_id')) { //check session
			echo 'session set';
		} else {
			echo 'not set';
		}
		$this->session->unset_userdata('session_id');

		if ($this->session->userdata('session_id')) {

			echo 'session set';
		} else {

			echo 'not set';
		}
	}
}
