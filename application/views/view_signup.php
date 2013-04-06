<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
	<script src="<?=base_url()?>js/bootstrap.js"> </script>
	<script src="<?=base_url()?>js/jquerymin.js"></script>
	
	<script>
		$(document).ready(function(){
			$('#butt').click(function(){
				$('#signupModal').toggle();
			});
		});
	</script>
	
</head>
<body> 
		<!-- Button to trigger modal -->
<button id="butt">modal</button>
 
	<div class="modal " id="signupModal" aria-hidden = "true" aria-labelledby="signupModal"\>
		<div class= "modal-header">
			 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h3> Sign Up Form </h3>
		</div>
		<div class= "modal-body">
			<?php
				echo form_open('index.php/createNewUser');
				echo form_label('Username'); 
				echo form_error('username');
				echo form_input('username',set_value('username'),"required");
				echo form_label('Password'); 
				echo form_error('password');
				echo form_password('password','',"id='pass1' required");
				echo form_label('Password Confirmation'); 
				echo form_error('passconf');
				echo form_password('passconf','',"id='pass2' required oninput='checkPassword();'");
				echo form_label('First');
				echo form_error('first');
				echo form_input('first',set_value('first'),"required");
				echo form_label('Last');
				echo form_error('last');
				echo form_input('last',set_value('last'),"required");
				echo form_label('Email');
				echo form_error('email');
				echo form_input('email',set_value('email'),"required");
				echo form_submit('submit', 'Register');
				echo form_close();
			?>
		</div>
		<div class= "modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true"> Close </button>
		</div>
	</div>


</body>
</html>