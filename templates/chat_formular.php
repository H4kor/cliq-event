<?php 
//templates/chat_formular.php
?>

<form action="functions/import_chat.php?re_id=<?php echo $_GET['re_id']; ?>" method="post" name="input">
Neuer Post<br>
<textarea cols="40" rows="5" class="textfeld" name="text">
Hier Text schreiben
</textarea>
<br>
<input type="submit" value="OK">
</form>