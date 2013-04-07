<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.css">
	<script src="<?=base_url()?>js/jquerymin.js"></script>
	<script src="<?=base_url()?>js/bootstrap.js"> </script>
	<script src="<?=base_url()?>js/modals.js"></script>
</head>
<body> 
		<div id="modalwin" class="modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">x</a>
        <h3>Collaborative Edit </h3>
      </div>
      
      <div class="modal-body">
   			<?php
   				 echo anchor('index.php/welcome/createNew','Create New' , "class='span2 btn btn-inverse' "); 
   				 echo anchor('#joinModal',' Join ' , "data-toggle='modal' class='span2 btn btn-danger' ");
           
   			?>
      </div>
      <footer class="modal-footer">

      	<a href="<?=base_url()?>index.php/welcome/logout" class="btn">Close</a>
      </footer>
    </div> <!-- @end @modalwin -->


<div id="joinModal" class="modal hide fade" role="dialog" aria-labelledby="joinModal" aria-hidden="true">
      <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">x</a>
        <h3>Enter Session String </h3>
      </div>
      
      <div class="modal-body">
        <form class="span5" action="<?=base_url()?>index.php/welcome/Join" method="post">
        <label class="lead">Enter Session String </label>
        <input type="text" class="span3" name="sessionString" placeholder="Type String here..." required /><br>
      </div>
      <footer class="modal-footer">
       <?php
        echo form_submit('submit', 'Submit', "class='btn btn-primary'  ");
        echo form_close();
        ?>
        
      </footer>
    </div> <!-- @end @modalwin -->




</body>
</html>