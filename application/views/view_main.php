<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
	<link rel="stylesheet" type = "text/css" href="<?=base_url()?>css/main.css">
	<script src="<?=base_url()?>js/bootstrap.js"> </script>
	<script src="<?=base_url()?>js/jquerymin.js" ></script>
	<script src="<?=base_url()?>js/jquery.timers.js" ></script>
	<script src="<?=base_url()?>js/aceedit.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?=base_url()?>js/chrome.js" type="text/javascript" charset="utf-8"></script>
	<script >
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
	
<head>
<body>
	<header>
		<div  id="header_title" > Collaborative Edit</div>
		<div  id="header_hello"> Hello, <?=$_SESSION['user']->first?> 
			<?= anchor('index.php/welcome/logout','(Logout)') ?> 
		</div>
	</header>
	<div class="container-fluid" id="main">
		<div class="row-fluid">
			<div class="well span9" id="leftSide">
				<div  id="editor">
					<script>
					 editor = ace.edit("editor");	//Binding the object
					 editor.getSession().setValue("public static void main(){}"); //setting the default value
					 // editor.setTheme("aceedit/theme/chrome");	//setting theme
    		// 		 editor.getSession().setMode("ace/mode/java"); // setting the lang 
    				 document.getElementById('editor').style.fontSize='15px'; //setting the font 

   					
					</script>
					
				</div>
			</div>
			
			<div class="well span3" id="rightSide">
				<div id="selectLang">
					<h4>Select Language:<br>
					</h4>
					<select >
						<option>C</option>
						<option>C++</option>
						<option>Java</option>
						<option>Python</option>
						<option>Ruby</option>
						<option>PHP</option>
						<option>Javascript</option>
					</select>
				</div>
			</div>
		</div>
	</div>



	<footer></footer>
</body>
</html>
