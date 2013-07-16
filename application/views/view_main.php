<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
	<link rel="stylesheet" type = "text/css" href="<?=base_url()?>css/main.css">
	<script src="<?=base_url()?>js/jquerymin.js"></script>
	<script src="<?=base_url()?>js/bootstrap.js"> </script>
	<script src="<?=base_url()?>js/modals.js"></script>


	<script src="<?=base_url()?>js/chrome.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=base_url()?>js/mode-java.js" type="text/javascript" charset="utf-8"></script>
	
	<script src="<?=base_url()?>js/jquery.timers.js" ></script>
	<script src="<?=base_url()?>js/ace.js" ></script>
	
	
	<script>

		<?php 
			$rand = mt_rand(400,1500); 
		?>
		rand = <?="$rand;"?>
		urlSend = "<?=base_url()?>index.php/main/updateData";
		$(document).ready(function(){
			$("#editor").keyup(function(){
				var data = editor.getSession().getValue();
				var myObj = {};
				myObj["dataX"] = data;
				var json = "json=" + JSON.stringify(myObj);
				$.post(urlSend,json,function(){

				});

			});
		});
	</script>	
	<script >
		urlReceive = "<?=base_url()?>index.php/main/getData";
		$(document).ready(function(){
			$("#editor").everyTime(2000,function(){
				$.getJSON(urlReceive,function(response){
					if(response){
						var curPosition = editor.getCursorPosition();
						editor.getSession().setValue(response.data);
						editor.moveCursorToPosition(curPosition);
					}
				});
			});
			
		});
	</script>

	<script>
		urlCollaborate = "<?=base_url()?>index.php/main/getCollaborators";
		$(document).ready(function(){
			$("#window").everyTime(5000,function(){
				$.getJSON(urlCollaborate,function(response){
					if(response){
						$('#window').val(response.data);
					}
				});

			});
		});
	</script>

	<script>
		urlChat = "<?=base_url()?>index.php/main/getMsg";
		$(document).ready(function(){
			$("#chat-window").everyTime(1000,function(){
				$.getJSON(urlChat, function(response){
					if(response){
						$("#chat-window").val(response.data);
					}
				});
			});
			
		});


	</script>
	 <script>
		var user =  "<?=$_SESSION['user']->first?> ";
		urlChatSend = "<?=base_url()?>index.php/main/postMsg";
		$(document).ready(function(){
			$("#chat-send").click(function(){
				var chat_history = $('#chat-window').val();
				var new_message = $('#message').val();
				var myObj = {};
				new_message = chat_history + "\n" + user+" : "+new_message;
				myObj["message"] = new_message;
				var json = "json=" + JSON.stringify(myObj);
				$.post(urlChatSend,json,function(){

				});

			});
		});
	</script>
	
<head>
<body>
	<header>
		<div  id="header_title" >
			Collaborative Edit 
			<table class="span2" id="header_session_id" border="solid"> <tr><th> <?= $id ?> </th><tr></table> 
		</div>
		<div  id="header_hello"> Hello, <?=$_SESSION['user']->first?> 
			<?= anchor('index.php/welcome/logout','(Logout)') ?> 
			<a href="#modalwinx" data-toggle="modal">[ Share ]</a>


		</div>
	</header>
	<div class="container-fluid" id="main">
		<div class="row-fluid">
			<div class="well span9" id="leftSide">
				<div  id="editor">
					<script>
					 editor = ace.edit("editor");	//Binding the object
					 editor.getSession().setValue("public static void main(){}"); //setting the default value
					 editor.setTheme("aceedit/theme/chrome");	//setting theme
					 
    		 		 document.getElementById('editor').style.fontSize='15px'; //setting the font 

    				</script>
    				<script type="text/javascript">
						$(document).ready(function(){
							$('#selectLang').change(function() {
								str = "ace/mode/"+$('#selectLang option:selected').text();
								editor.getSession().setMode(str); // setting the lang 
    				 		});
						});
					</script>

					
				</div>
			</div>
			
			<div class="well span3" id="rightSide">
				<div id="selectLang">
					<h4>Select Language:<br>
					</h4>
					<select id="langOptions">
						<option selected>plain text</option>
						<option >c_cpp</option>
						<option >java</option>
						<option>python</option>
						<option>ruby</option>
						<option>php</option>
						<option>javascript</option>
					</select>
				</div>
				<div id="collaborator-window">
					<h4>Collaborators:<br>
					</h4>
					<textarea id="window" rows="4" cols="25" style="width: 250px; font: bold 15px Georgia, serif;" readonly></textarea>
				</div>

				<div id="chatbox">
					<!--  ============================== -->
					<h4>Chat</h4>
					<textarea id="chat-window" rows="10" cols="25" style="width: 250px" ></textarea>
					<!-- <form method="post" action=""> -->
					<input type="text" value="" id="message" name="message" style="margin-top: 5px; margin-right: 5px;" required>
					<input id="chat-send" class="btn btn-primary" type="button" value="Send" name="submit" >
					<!-- </form> -->

					

				</div>
			</div>
		</div>
	</div>
	

	<div id="modalwinx" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">x</a>
        <h3>Share Session Id</h3>
      </div>
      
      <div class="modal-body">
   			<?php
				echo form_open('index.php/welcome/sendEmail');
				echo form_label('Email'); 
				echo form_error('email');
				echo form_input('email',set_value('email'),"required");
			?>
			<input type="hidden" name="string" id="string" value="<?= $_SESSION['id'] ?>"></input>
      </div>
      <footer class="modal-footer">
       <?php
        echo form_submit('submit', 'Share', "class='btn btn-primary'  ");
		echo form_close();
        ?>
        <a href="#" class="btn" id="okwin01">Close</a>
      </footer>
    </div> <!-- @end @modalwin -->


	<footer></footer>
</body>
</html>
