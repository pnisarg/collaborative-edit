<!DOCTYPE html>
<html lang="en-US">
<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
	<script src="<?=base_url()?>js/jquerymin.js"></script>
	<script src="<?=base_url()?>js/bootstrap.js"> </script>
	<script src="<?=base_url()?>js/modals.js"></script>
	<link rel="stylesheet" type = "text/css" href="<?=base_url()?>css/welcome.css">
	<script type="text/javascript">
		<?php
			if(isset($signUpError) && $signUpError){
		?>
				alert("Error Signing Up. Click SignUp button again to see the error.");
		<?php
			}

		?>
			
		
	</script>

</head>
<body> 
	<div  id="main" class="well" style="padding:10px;border:5px solid gray;width:60%;margin:auto;min-height:600px">
		<header>
			Collaborative Edit

		</header>
		
		<div id="mainBody">
			<div id="login"> 
				<form class="span5" action="<?=base_url()?>index.php/welcome/login" method="post">
					<label class="lead">Username </label>
					<input  type="text" class="span3" name="username" placeholder="Type Username here..." required /><br>
					<label class="lead">Password </label>
					<input  type="password" class="span3 " name="password" placeholder="Type Password here..." required/><br>
					<button type="submit" class="btn btn-primary " id="btn-login"> Login </button>
					<!-- <a href="#" id="signup" class="btn btn-danger " > Sign Up </a> -->
					<a href="#modalwin" data-toggle="modal" class="btn btn-danger  ">Sign Up</a>
					<?php
						if (isset($errorMsg)) {
							echo "<p>" . $errorMsg . "</p>";
						}
					?>
				</form>
			</div>
			

			<div> 
				<?php 
				echo form_open('index.php/welcome/createNew');
				echo "<button class='btn btn-inverse span3'>Create New</button>";
				echo form_close();
				?>
			</div>
		</div>
		
	</div> 

	<div id="modalwin" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">x</a>
        <h3>Sign Up Form </h3>
      </div>
      
      <div class="modal-body">
   			<?php
				echo form_open('index.php/welcome/createNewUser');
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
				echo form_input('email',set_value('email'));
				
			?>
      </div>
      <footer class="modal-footer">
       <?php
        echo form_submit('submit', 'Register', "class='btn btn-primary'  ");
		echo form_close();
        ?>
        <a href="#" class="btn" id="okwin01">Close</a>
      </footer>
    </div> <!-- @end @modalwin -->

</body>
</html>