<?php
error_reporting(0);
class Database
{

	private $db;
	private static $instance;

	// private constructor
	private function __construct()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";


		try {
			$this->db = new PDO("mysql:host=$servername;dbname=alcop_db;", $username, $password);
			// set the PDO error mode to exception
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
			// I won't echo thsi message but use it to for checking if you connected to the db
			//incase you don't get an error message
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}

	//This method must be static, and must return an instance of the object if the object
	//does not already exist.
	public static function getInstance()
	{
		if (!self::$instance instanceof self) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	// The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
	// thus eliminating the possibility of duplicate objects.
	public function __clone()
	{
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

	public function __wakeup()
	{
		trigger_error('Deserializing is not allowed.', E_USER_ERROR);
	}

	public function get_name_from_id($tab, $col, $whe, $id)
	{
		try {
			$que = $this->db->prepare("SELECT $tab FROM $col where $whe =?");
			$que->execute([$id]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function get_paycode($id)
	{

		try {
			$que = $this->db->prepare("SELECT a_user_id FROM users WHERE payrollID = ?");
			$que->execute([$id]);
			return $que->fetchColumn();
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	public function select_my_loans_by_paycode($user)
	{
		try {
			$que = $this->db->prepare("SELECT SUM(amount_to_pay - amount_paid) as total FROM loans WHERE `payrollID` = ? AND `payment_status` != 1");
			$que->execute([$user]);
			$SingleVar = $que->fetchColumn();
			return $SingleVar;
			$que = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//delete
	public function delete_from_where($table, $col, $id)
	{
		try {
			$stmt = $this->db->prepare("DELETE FROM $table WHERE $col = ?");
			$stmt->execute([$id]);
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}


	//alter
	public function alter_things($tab, $col, $where, $value)
	{
		try {
			$empty = "";
			$stmt = $this->db->prepare("UPDATE $tab SET $col = ? WHERE $where = ?")->execute([$empty, $value]);
			$stmt = null;
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	public function alter_things1($tab, $col, $empty, $where, $value)
	{
		try {

			$stmt = $this->db->prepare("UPDATE $tab SET $col = ? WHERE $where = ?")->execute([$empty, $value]);
			$stmt = null;
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//alter
	public function alter_things2($tab, $col, $val, $where, $value, $where2, $op, $value2)
	{
		try {
			$stmt = $this->db->prepare("UPDATE $tab SET $col = ? WHERE $where = ? AND $where2 $op ?")->execute([$val, $value, $value2]);
			$stmt = null;
			$success = 'Done';
			return $success;
			$stmt = null;
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
	public function addToSavings($amount, $user, $admin)
	{
		try {
			$type = 1;
			$stmt = $this->db->prepare("INSERT INTO savings(amount,user_id,particular,date_paid,`status`,`altered_by`,`date_altered`) 
				VALUES (?,?,?,NOW(),1,?,NOW())");
			$stmt->execute([$amount, $user, $type, $admin]);
			$stmt = null;
			echo 'Done';
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}

	//For user registration
	public function insert_user($paycode, $first, $middle, $last, $email, $hash, $department, $enrollment_year, $pnumber)
	{
		try {
			$role = 2;
			$res = null;
			$stmt = $this->db->prepare("INSERT INTO users(payrollID,first_name,middle_name,surname,email,role_id,`password`, department,enrollment_year,phone_number,image) 
										VALUES (?,?,?,?,?,?,?,?,?,?,null)");
			$stmt->execute([$paycode, $first, $middle, $last, $email, $role, $hash, $department, $enrollment_year, $pnumber]);
			$id = $this->db->lastInsertId();
			$stmt = null;
			return 'Done';
		} catch (PDOException $e) {
			// For handling error
			echo 'Error: ' . $e->getMessage();
		}
	}
}
