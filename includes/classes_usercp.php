<?php

class usercp_event_output {

    protected $event;
    protected $location;
	protected $date;
	protected $time;
	protected $participants_logged;
	protected $participants_needed;
	protected $note;
	protected $id;

    public function __construct($event= "", $location= "", $date= "", $time= "", $participants_logged= "", $participants_needed= "", $note= "", $id = "") {
      $this->event = $event;
	  $this->location = $location;
	  $this->date = $date;
	  $this->time = $time;
      $this->participants_logged = $participants_logged;
	  $this->participants_needed = $participants_needed;
	  $this->note = $note;
	  $this->id = $id;
    }
	
	public function output() {
		include "templates/usercp_event.php";
	}
}

?>
