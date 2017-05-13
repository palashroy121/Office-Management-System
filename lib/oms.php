<?php
include "database.php";
include "session.php";

class Oms {

	private $db;
	public function __construct(){
		$this->db = new Database();
	}

	//Login Check Function
	public function login_check($data){
		$email		= $data['email'];
		$password	= $data['password'];

		$result = $this->login_value_check($email, $password);

		$id1 = $result->id;
		$report = $this->save_attendance($id1);

		if($email == ""){
			$msg['email'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		else if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
			$msg['email'] = '<p class="text-danger"><strong>Error! </strong>The email address is not valid!</p>';
		}
		if($password == ""){
			$msg['password'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}
		if($result){
			Session::init();
			Session::set("login", true);
			Session::set("id", $result -> id);
			Session::set("name", $result -> name);
			Session::set("username", $result -> username);
			Session::set("loginmsg", '<p class="text-success"><strong>Success! </strong>You are Login.</p>');
			header("Location: dashboard.php");
		}
		else{
			$msg = '<p class="text-danger"><strong>Error! </strong>Data Not Found!</p>';
			return $msg;
		}
	}
	public function login_value_check($email, $password) {
		$sql = "SELECT * FROM employee WHERE email = :email AND password = :password LIMIT 1";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":email", $email);
		$query->bindValue(":password", $password);
		$query->execute();
		$result = $query-> fetch(PDO::FETCH_OBJ);
		return $result;
	}

	//Save Attendance
	public function save_attendance($id1){
		$daily_date = date('Y-m-d');
		$entry_time = date('H:i:s');

		$checkAtten = $this->check_attendance($id1, $daily_date);

		if(empty($checkAtten)){
			$sql = "INSERT INTO attendance (employee_id, daily_date, entry_time) VALUES (:employee_id, :daily_date, :entry_time)";
			$query = $this->db->conn->prepare($sql);
			$query -> bindValue(":employee_id", $id1);
			$query -> bindValue(":daily_date", $daily_date);
			$query -> bindValue(":entry_time", $entry_time);
			$query->execute();
		}
		else{
			echo "Not";
		}
	}
	public function check_attendance($daily_date, $id1){
		$sql = "SELECT * FROM attendance WHERE id=:id AND daily_date = :daily_date LIMIT 1";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":id", $id1);
		$query->bindValue(":daily_date", $daily_date);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	public function ckeckout_time($id){
		$exit_time = date('H:i:s');
		$daily_date = date('Y-m-d');
		$sql = "UPDATE attendance SET exit_time=:exit_time WHERE id=:id AND daily_date=:daily_date";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":exit_time", $exit_time);
		$query -> bindValue(":id", $id);
		$query -> bindValue(":daily_date", $daily_date);
		$result = $query->execute();
		if($result){
			header("Location: dashboard.php");
		}
	}
	public function view_attendance(){
		$sql = "SELECT * FROM attendance";
		$query = $this->db->conn->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	// Save Designation
	public function save_designation($data){
		$designation_name = $data['designation_name'];

		$check_des = $this->check_designation($designation_name);

		if($designation_name == ""){
			$msg['designation_name'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		else if($designation_name == $check_des->designation){
			$msg['designation_name'] = '<p class="text-danger"><strong>Error! </strong>Designation already exists!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "INSERT INTO tbl_designation (designation) VALUES (:designation_name)";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":designation_name", $designation_name);
		$result = $query->execute();
		if($result){
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
			return $msg;
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			return $msg;
		}
		if(!empty($msg)){
			return $msg;
		}
	}
	// Check designation
	public function check_designation($designation_name){
		$sql = "SELECT * FROM tbl_designation WHERE designation = :designation LIMIT 1";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":designation", $designation_name);
		$query->execute();
		$result = $query-> fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//view_designation
	//select_designation
	public function select_designation(){
		$sql = "SELECT * FROM tbl_designation";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}
	//Select Designation by id
	public function select_designation_by_id($getId){
		$sql = "SELECT * FROM tbl_designation WHERE id=:getId";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":getId", $getId);
		$query -> execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//Edit Designation
	public function edit_designation($data){
		$designation_name = $data['designation_name'];
		$id = $data['id'];

		$check_des = $this->check_designation($designation_name);

		if($designation_name == ""){
			$msg['designation_name'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		else if($designation_name == $check_des->designation){
			$msg['designation_name'] = '<p class="text-danger"><strong>Error! </strong>Designation already exists!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "UPDATE tbl_designation SET designation=:designation WHERE id=:id";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":designation", $designation_name);
		$query -> bindValue(":id", $id);
		$result = $query->execute();
		if($result){
			header("Location: add-designation.php");
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			return $msg;
		}
		if(!empty($msg)){
			return $msg;
		}
	}

	//save leave type
	public function save_leave_type($data){
		$leave_type = $data['leave_type'];
		$check_lea = $this->check_leave($leave_type);
		if($leave_type == ""){
			$msg['leave_type'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		else if($leave_type == $check_lea->leave_type){
			$msg['leave_type'] = '<p class="text-danger"><strong>Error! </strong>Leave Type already exists!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}
		
		$sql = "INSERT INTO tbl_leave_type (leave_type) VALUES (:leave_type)";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":leave_type", $leave_type);
		$result = $query->execute();
		if($result){
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
			return $msg;
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			return $msg;
		}
		if(!empty($msg)){
			return $msg;
		}
	}
	//Edit Leave
	public function select_leave_by_id($getId){
		$sql = "SELECT * FROM tbl_leave_type WHERE id=:getId";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":getId", $getId);
		$query -> execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//Save Edit Leave Type
	public function edit_leave_type($data){
		$leave_type = $data['leave_type'];
		$id = $data['id'];

		if($leave_type == ""){
			$msg['leave_type'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "UPDATE tbl_leave_type SET leave_type=:leave_type WHERE id=:id";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":leave_type", $leave_type);
		$query -> bindValue(":id", $id);
		$result = $query->execute();
		if($result){
			header("Location: add-leave-type.php");
		}
		else{
			header("Location: edit-leave-type.php");
		}		
	}
	// Check Leave Type
	public function check_leave($leave_type){
		$sql = "SELECT * FROM tbl_leave_type WHERE leave_type = :leave_type LIMIT 1";
		$query = $this->db->conn->prepare($sql);
		$query->bindValue(":leave_type", $leave_type);
		$query->execute();
		$result = $query-> fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//view_leave_type
	public function view_leave_type(){
		$sql = "SELECT * FROM tbl_leave_type";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}

	// save_employee
	public function save_employee($data){
		$name			= $data['name'];
		$designation	= $data['designation'];
		$address		= $data['address'];
		$phone			= $data['phone'];
		$joining_date	= $data['joining_date'];
		$date 			= date('d-m-Y', strtotime($joining_date));
		$email			= $data['email'];
		$user_name		= $data['user_name'];
		$password		= $data['password'];
		$status			= $data['status'];

		if($name == ""){
			$msg['name'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if($designation == ""){
			$msg['designation'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if($address == ""){
			$msg['address'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if($phone == ""){
			$msg['phone'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if($email == ""){
			$msg['email'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if($user_name == ""){
			$msg['user_name'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if($password == ""){
			$msg['password'] = '<p class="text-danger"><strong>Error! </strong>Field must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "INSERT INTO employee (name, designation, address, phone, joining_date, email, username, password, status) VALUES (:name, :designation, :address, :phone, :joining_date, :email, :username, :password, :status)";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":name", $name);
		$query -> bindValue(":designation", $designation);
		$query -> bindValue(":address", $address);
		$query -> bindValue(":phone", $phone);
		$query -> bindValue(":joining_date", $date);
		$query -> bindValue(":email", $email);
		$query -> bindValue(":username", $user_name);
		$query -> bindValue(":password", $password);
		$query -> bindValue(":status", $status);
		$result = $query->execute();
		if($result){
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

	}
	//view_employee
	public function view_employee(){
		$sql = "SELECT * FROM employee";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}

	//Save Message
	public function save_message($id, $data){
		$receiver_id 	= $data['receiver_id'];
		$subject		= $data['subject'];
		$body			= $data['body'];
		$date_times		= date('Y-m-d H:i:s');

		if($receiver_id == ""){
			$msg['receiver_id'] = '<p class="text-danger"><strong>Error! </strong>Receiver must not be empty!</p>';
		}
		if($subject == ""){
			$msg['subject'] = '<p class="text-danger"><strong>Error! </strong>Subject must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "INSERT INTO message (sender_id, receiver_id, subject, body, date_times) VALUES (:sender_id, :receiver_id, :subject, :body, :date_times)";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":sender_id", $id);
		$query -> bindValue(":receiver_id", $receiver_id);
		$query -> bindValue(":subject", $subject);
		$query -> bindValue(":body", $body);
		$query -> bindValue(":date_times", $date_times);
		$result = $query->execute();
		if($result){
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
			//return $msg;
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			//return $msg;
		}
		if(!empty($msg)){
			return $msg;
		}
	}

	//view Inbox
	public function view_inbox($id){
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.receiver_id WHERE receiver_id=$id ORDER BY id DESC";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}
	
	public function count_inbox($id){
		$sql = "SELECT receiver_id FROM message WHERE receiver_id=$id";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		$cou_result = count($result);
		return $cou_result;
	}

	public function view_inbox_message_by_id($viewId){
		$readMessage = $this->read_message($viewId);
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.sender_id WHERE message.id=$viewId";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function read_message($viewId){
		$sql = "UPDATE message SET message_read=1 WHERE id=$viewId";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
	}

	//Count sent
	public function view_sent($id){
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.receiver_id WHERE sender_id=$id";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}
	public function count_sent($id){
		$sql = "SELECT receiver_id FROM message WHERE sender_id=$id";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		$cou_result = count($result);
		return $cou_result;
	}

	public function view_sent_message_by_id($viewId){
		$sql = "SELECT employee.name, message.* FROM employee INNER JOIN message ON employee.id=message.receiver_id WHERE message.id=$viewId";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}

	//Setting Function
	public function save_setting($data){
		$company_name		= $data['company_name'];
		$company_address	= $data['company_address'];
		$office_start_time	= date('H:i:s', strtotime($data['office_start_time']));
		$office_end_time	= date('H:i:s', strtotime($data['office_end_time']));

		$permited = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'xlsx', 'zip', 'rar');
		$file_name = $_FILES['company_logo']['name'];
		$file_size = $_FILES['company_logo']['size'];
		$file_temp = $_FILES['company_logo']['tmp_name'];
		$folder = "image/";
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$file_f_name = rtrim($file_name, '.'.$file_ext);
		$company_logo =$file_f_name.time().'.'.$file_ext;
		move_uploaded_file($file_temp, $folder.$company_logo);

		if($company_name == ""){
			$msg['company_name'] = '<p class="text-danger"><strong>Error! </strong>Company Name must not be empty!</p>';
		}
		if($company_address == ""){
			$msg['company_address'] = '<p class="text-danger"><strong>Error! </strong>Company Address must not be empty!</p>';
		}
		if($file_name == ""){
			$msg['company_logo'] = '<p class="text-danger"><strong>Error ! </strong>Select any files!</p>';
		}
		else if($file_size > 10000000){
			$msg['company_logo'] = '<p class="text-danger"><strong>Error ! </strong>File size too large!</p>';
		}
		else if(in_array($file_ext, $permited) === false){
			$msg['company_logo'] = '<p class="text-danger"><strong>Error ! </strong>You can uploded only: '.implode(', ', $permited).'.</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "INSERT INTO setting (company_name, company_logo, company_address, office_start_time, office_end_time) VALUES (:company_name, :company_logo, :company_address, :office_start_time, :office_end_time)";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":company_name", $company_name);
		$query -> bindValue(":company_logo", $company_logo);
		$query -> bindValue(":company_address", $company_address);
		$query -> bindValue(":office_start_time", $office_start_time);
		$query -> bindValue(":office_end_time", $office_end_time);
		$result = $query->execute();
		if($result){
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
			//return $msg;
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			//return $msg;
		}
		if(!empty($msg)){
			return $msg;
		}
	}
	//View Setting
	public function view_setting(){
		$sql = "SELECT * FROM setting";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}
	//Edit Setting
	public function edit_setting($data){
		$id 				= $data['id'];
		$company_name		= $data['company_name'];
		$company_address	= $data['company_address'];
		$office_start_time	= date('H:i:s', strtotime($data['office_start_time']));
		$office_end_time	= date('H:i:s', strtotime($data['office_end_time']));

		$permited = array('jpg', 'jpeg', 'png', 'gif');
		$file_name = $_FILES['company_logo']['name'];
		$file_size = $_FILES['company_logo']['size'];
		$file_temp = $_FILES['company_logo']['tmp_name'];
		$folder = "image/";
		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$file_f_name = rtrim($file_name, '.'.$file_ext);
		$company_logo =$file_f_name.time().'.'.$file_ext;
		move_uploaded_file($file_temp, $folder.$company_logo);

		if($company_name == ""){
			$msg['company_name'] = '<p class="text-danger"><strong>Error! </strong>Company Name must not be empty!</p>';
		}
		if($company_address == ""){
			$msg['company_address'] = '<p class="text-danger"><strong>Error! </strong>Company Address must not be empty!</p>';
		}
		if($file_size > 10000000){
			$msg['company_logo'] = '<p class="text-danger"><strong>Error ! </strong>File size too large!</p>';
		}
		else if(in_array($file_ext, $permited) === true){
			$msg['company_logo'] = '<p class="text-danger"><strong>Error ! </strong>You can uploded only: '.implode(', ', $permited).'.</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "UPDATE setting SET company_name=:company_name, company_logo=:company_logo, company_address=:company_address, office_start_time=:office_start_time, office_end_time=:office_end_time WHERE id=:id";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":company_name", $company_name);
		$query -> bindValue(":company_logo", $company_logo);
		$query -> bindValue(":company_address", $company_address);
		$query -> bindValue(":office_start_time", $office_start_time);
		$query -> bindValue(":office_end_time", $office_end_time);
		$query -> bindValue(":id", $id);
		$result = $query->execute();
		if($result){
			header("Location: setting.php");
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}
	}

	//Leave Function
	public function save_leave($data){
		$employee_id	= $data['employee_id'];
		$leave_type 	= $data['leave_type'];
		$reason 		= $data['reason'];
		$date_from 		= date('Y-m-d', strtotime($data['date_from']));
		$date_to		= date('Y-m-d', strtotime($data['date_to']));

		if($employee_id == ""){
			$msg['employee_id'] = '<p class="text-danger"><strong>Error! </strong>Name must not be empty!</p>';
		}
		if($leave_type == ""){
			$msg['leave_type'] = '<p class="text-danger"><strong>Error! </strong>Leave Type must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "INSERT INTO leave (employee_id, leave_type, reason, date_from, date_to) VALUES (:employee_id, :leave_type, :reason, :date_from, :date_to)";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":employee_id", $employee_id);
		$query -> bindValue(":leave_type", $leave_type);
		$query -> bindValue(":reason", $reason);
		$query -> bindValue(":date_from", $date_from);
		$query -> bindValue(":date_to", $date_to);
		$result = $query->execute();
		if($result){
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
			//return $msg;
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
			//return $msg;
		}
		if(!empty($msg)){
			return $msg;
		}

	}

	//Task Function
	public function save_task($data){
		$employee_id	= $data['employee_id'];
		$task_name	 	= $data['task_name'];
		$task_details	= $data['task_details'];
		$start_date 	= date('Y-m-d', strtotime($data['start_date']));
		$end_date 		= date('Y-m-d', strtotime($data['end_date']));

		if($employee_id == ""){
			$msg['employee_id'] = '<p class="text-danger"><strong>Error! </strong>Name must not be empty!</p>';
		}
		if($task_name == ""){
			$msg['task_name'] = '<p class="text-danger"><strong>Error! </strong>Task name must not be empty!</p>';
		}
		if($start_date == ""){
			$msg['start_date'] = '<p class="text-danger"><strong>Error! </strong>Start Date must not be empty!</p>';
		}
		if($end_date == ""){
			$msg['end_date'] = '<p class="text-danger"><strong>Error! </strong>End Date must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "INSERT INTO task (employee_id, task_name, task_details, start_date, end_date) VALUES (:employee_id, :task_name, :task_details, :start_date, :end_date)";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":employee_id", $employee_id);
		$query -> bindValue(":task_name", $task_name);
		$query -> bindValue(":task_details", $task_details);
		$query -> bindValue(":start_date", $start_date);
		$query -> bindValue(":end_date", $end_date);
		$result = $query->execute();
		if($result){
			$msg['su'] = '<p class="text-success"><strong>Success! </strong>Data Inserted.</p>';
		}
		else{
			$msg['su'] = '<p class="text-danger"><strong>Error! </strong>Data Not Insert!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}
	}

	//View Task
	public function view_task(){
		$sql = "SELECT employee.name, task.* FROM employee INNER JOIN task ON employee.id=task.employee_id";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}
	//View Task by Limit
	public function view_task_limit(){
		$sql = "SELECT * FROM task ORDER BY id DESC LIMIT 0, 3";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetchAll();
		return $result;
	}

	//view_task_by_id
	public function view_task_by_id($getID){
		$sql = "SELECT employee.name, task.* FROM employee INNER JOIN task ON employee.id=task.employee_id WHERE task.id=$getID";
		$query = $this->db->conn->prepare($sql);
		$query -> execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	//Edit Task
	public function edit_task($data){
		$id 			= $data['id'];
		$employee_id	= $data['employee_id'];
		$task_name	 	= $data['task_name'];
		$task_details	= $data['task_details'];
		$start_date 	= date('Y-m-d', strtotime($data['start_date']));
		$end_date 		= date('Y-m-d', strtotime($data['end_date']));
		$completion		= $data['completion'];
		$status			= $data['status'];

		if($employee_id == ""){
			$msg['employee_id'] = '<p class="text-danger"><strong>Error! </strong>Name must not be empty!</p>';
		}
		if($task_name == ""){
			$msg['task_name'] = '<p class="text-danger"><strong>Error! </strong>Task name must not be empty!</p>';
		}
		if($status == ""){
			$msg['status'] = '<p class="text-danger"><strong>Error! </strong>Status must not be empty!</p>';
		}
		if(!empty($msg)){
			return $msg;
		}

		$sql = "UPDATE task SET employee_id=:employee_id, task_name=:task_name, task_details=:task_details, start_date=:start_date, end_date=:end_date, completion=:completion, status=:status WHERE id=:id";
		$query = $this->db->conn->prepare($sql);
		$query -> bindValue(":employee_id", $employee_id);
		$query -> bindValue(":task_name", $task_name);
		$query -> bindValue(":task_details", $task_details);
		$query -> bindValue(":start_date", $start_date);
		$query -> bindValue(":end_date", $end_date);
		$query -> bindValue(":completion", $completion);
		$query -> bindValue(":status", $status);
		$query -> bindValue(":id", $id);
		$result = $query->execute();
		if($result){
			header('Location: lask-list.php');
		}
		else{
			$msg['error'] = '<p class="text-danger"><strong>Error! </strong>Data Not Update!</p>';
		}
	}


}