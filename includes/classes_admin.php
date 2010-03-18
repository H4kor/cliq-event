<?php
//includes/classes_admin.php


class admin_user_output {

	protected $id;	
	protected $name;
	protected $rights;
	protected $email;
	
    public function __construct($id = "", $name = "", $rights = "0", $email = "0") {
		$this->id = $id;
		$this->name = $name;
		$this->rights = $rights;
		$this->email = $email;
    }
	
	public function output() {
		include "templates/admin_user_row.php";
	}
}
				
?>