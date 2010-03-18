<?php
//templates/comments.php
?>

<?php
//header einfügen
$seite = "Kommentare";
include "templates/overall_header.php"; 

?>

<h2>Kommentare zu <?php echo $event; ?></h2>

<h4>Kommentar schreiben</h4>

<td class='formular'>
<form action="functions/import_kommentar.php?id= <?php echo $_GET['id'] ?> " method="post" name="input">
Kommentar<br>
<textarea cols="40" rows="5" class="textfeld" name="kommentar">
Hier Kommentar schreiben
</textarea>
<br>
<input type="submit" value="OK">
</form>

<hr>
<?php
foreach($output as $post):
?>
	Von: <?php echo $post['name']; ?>
	<br><br>
	<?php echo $post['comment']; ?><br><hr><br>
<?php
endforeach
?>

<?php include "templates/overall_menu.php"; ?>

</body>
</html>