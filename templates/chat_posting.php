<?php 
//templates/chat_posting.html
?>

<div style="margin-left:<?php echo $chat_layer*50;?>px; border:1px groove #4E8994; max-width:30%; background-color:#7EA9C4;">
<h4><?php echo $chat_name; ?>:</h4>
<p><?php echo $chat_text; ?></p>
<p style="font-size:8pt;">geschrieben am <?php echo $chat_date; ?> 
<a href="chat.php?re_id=<?php echo $chat_id;?>">antworten</a>
</p>

</div>