<?php
//output_chat.php
global $output;

function get_re($ids){
	$result = get_table_where("chat", "*", "`RE_TO` = ".$ids."", "`DATUM` ASC");
	if($result->num_rows != 0){
		while ($row = $result->fetch_assoc()) {  
			$re[] = array(		'id' => $row["ID"],
								'name' => get_name($row["OWNER_ID"]),
								'text' => $row["TEXT"],
								'date' => $row["DATE"],
								'RE' => get_re($row["ID"]));
		}
		return $re;
	}else{
		return "";
	}
}

	$result = get_table_where("chat", "*", "`RE_TO` = -1", "`DATUM` ASC");
	while ($row = $result->fetch_assoc()) {  
		$output[] = array(	'id' => $row["ID"],
							'name' => get_name($row["OWNER_ID"]),
							'text' => $row["TEXT"],
							'date' => $row["DATE"],
							'RE' => get_re($row["ID"]));	
	}


?>