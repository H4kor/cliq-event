<?php
//includes/classes_events.php

class formular_output {
    public function __construct() {
    }
	
	public function output() {
		include "templates/eventplaner_formular.php";
	}
}

class count_headline_output {

    public function __construct() {
    }
	
	public function output() {
		include "templates/eventplaner_count_headline.php";
	}
}

class comments_headline_output {

    public function __construct() {
    }
	
	public function output() {
		include "templates/eventplaner_comments_headline.php";
	}
}

class user_output {
	
	protected $name;
	protected $id;
	protected $away;
	
    public function __construct($name = "", $id = "", $away = "FALSE") {
		$this->name = $name;
		$this->id = $id;
		$this->away = $away;
    }
	
	public function output() {
		include "templates/eventplaner_user.php";
	}
}

class event_output {

    protected $event;
    protected $location;
	protected $initiator;
	protected $date;
	protected $time;
	protected $participants;
	protected $note;
	protected $logged;
	protected $id;

    public function __construct($event= "", $location= "", $initiator= "", $date= "", $time= "", $participants= "", $note= "", $logged = "FALSE", $id = "") {
      $this->event = $event;
	  $this->location = $location;
	  $this->initiator = $initiator;
	  $this->date = $date;
	  $this->time = $time;
      $this->participants = $participants;
	  $this->note = $note;
	  $this->logged = $logged;
	  $this->id = $id;
    }
	
	public function output() {
		include "templates/eventplaner_event.php";
	}
}

class participation_output {

    protected $style_id;
    protected $text;
	protected $date;

    public function __construct($style_id= "", $text= "", $date= "") {
      $this->style_id = $style_id;
	  $this->text = $text;
	  $this->date = $date;
    }
	
	public function output() {
		include "templates/eventplaner_participation.php";
	}
}

class comments_link_output {
	
	protected $amount;
	protected $id;
	
    public function __construct($amount = "0", $id = "") {
		$this->amount = $amount;
		$this->id = $id;
    }
	
	public function output() {
		include "templates/eventplaner_comments_link.php";
	}
}

class count_output {
	
	protected $amount;
	protected $enough;
	
    public function __construct($amount = "0", $enough = "FALSE") {
		$this->amount = $amount;
		$this->enough = $enough;
    }
	
	public function output() {
		include "templates/eventplaner_count.php";
	}
}
?>
