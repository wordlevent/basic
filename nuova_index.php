<?php 
session_start();
if(isset($_GET['barcode']) )
{
	$_SESSION['barcode'] = $_GET['barcode'];
	if(isset($_GET['id']) && isset($_GET['livello'])) 	
	{
		$_SESSION['id'] = $_GET['id'];
		$_SESSION['livello'] = $_GET['livello'];
		
	}
	if(isset($_GET['livello'])) 	
		$_SESSION['livello'] = $_GET['livello'];
}
//header("location:play.php?livello=". $_GET['livello']);
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Torino FC</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
   
  </head>

  <body >

    <div class="container" >
     

      <div class="jumbotron">
        <p class="lead">Ciao <b><?= $_GET['nome']; ?>!</b></p>
	<p>
	<a href="http://www.concorsi-worldevent.com/torinofc/gioco" class="btn btn-danger">Indietro</a>		
  <!--<a href="play.php?livello=<?= $_GET['livello']; ?>" class="btn btn-primary rbutton">GIOCA</a>		-->
  <button class="btn btn-primary rbutton">GIOCA</button>


		
      </div>

      

      <footer class="footer">
        <p>&copy; 2017 Worldevent srl.</p>
      </footer>

    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
	$(function(){
		$('#popupbutton').click();
	});
  
  
  
  $('.rbutton').on('click',function() {
    $(this).prop("disabled",true);
    location.href="play.php?livello=<?= $_GET['livello']; ?>";
});
  
</script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	<script src="js/jquery-2.1.3.min.js"></script>
	<script src="dist/sweetalert.min.js"></script>
<script>
document.querySelector('.timer').onclick = function(){
	swal({
		title: "Caricamento ...",
		text: "Vediamo quanto sei VELOCE!",
		timer: <?php echo $var *1000; ?>,
		showConfirmButton: false
	});
};
</script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
  </body>
</html>
