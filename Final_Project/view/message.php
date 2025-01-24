<?php
    session_start();
    require_once("../controller/authCheck.php");
    checkLoggedIn();
?>

<div id="display"></div>
<form method="POST" action="sendMessage.php">
    <input type="hidden" name="sender_id" value="<?php echo $_SESSION['user_id']; ?>">
    <input type="hidden" name="receiver_id" value="RECEIVER_ID">
    <textarea name="message_text" required></textarea>
    <button type="submit">Send</button>
</form>