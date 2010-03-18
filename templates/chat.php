<?php
//header einfügen
$seite = "Chat";
include "templates/overall_header.php"; 

?>

<h2 align="center">Chat</h2>

<?php 
include("templates/chat_formular.php");
if($_GET['re_id'] == -1)
	output_chat($output, 0, 0); //templates/chat_posting.php
?>

<?php include "templates/overall_menu.php"; ?>

</body>
</html>