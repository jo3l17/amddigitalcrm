<?php 
require URLINC.'nav_dash.php';
require URLINC.'check_session.php';
?>
<form name="frmChat" id="frmChat">
			<div id="chat-box"></div>
			<input type="text" name="chat-user" id="chat-user" placeholder="Name" class="chat-input" required />
			<input type="text" name="chat-message" id="chat-message" placeholder="Message"  class="chat-input chat-message" required />
			<input type="submit" id="btnSend" name="send-chat-message" value="Send" >
		</form>
