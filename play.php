

<?php 

session_start();

if(isset($_GET['livello']))
{

	$livello = $_GET['livello'];
	$id = $_SESSION['id'];
}
sleep(5);
//echo shell_exec("python3 /home/pi/GIOCO/gioco_random.py 'Mario' 'Rossi' 3"); 
		
//$punti = exec("sudo python3 /home/pi/GIOCO/gioco_random.py $livello $id"); 

?>
<br>

 
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
        <h1>PUNTI : <?php echo $punti; ?></h1>
      </div>
<?php $index = "http://www.concorsi-worldevent.com/torinofc/gioco/classifica.php?punti=".$punti."&id=".$_SESSION['id']; ?>
      <a href="<?php echo $index; ?>" class="btn btn-info">Confermi</button>
      <a href="http://www.concorsi-worldevent.com/torinofc/gioco/" class="btn btn-danger">Cancella</a>



        <?php 
		
		header("Refresh:5; url=".$index); 
	?>
      </div>

      

      <footer class="footer">
        <p>&copy; 2017 Worldevent srl.</p>
      </footer>
