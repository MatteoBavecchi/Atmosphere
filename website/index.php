<?php session_start();
include_once("include/config.php");
if(!isset($_COOKIE['LOGIN_ATMOSPHERE'])) header("location:login.php");
else{
	if(isset($_GET['out'])) if(logout()) header("location:login.php");
	
    date_default_timezone_set('Europe/Rome');
	$curdate = date("Y-n-d"); //ci si procura l' ora e la data dal server php
	
	$utente= getUtente($_COOKIE['LOGIN_ATMOSPHERE']);
	$tabella = createTable($_COOKIE['LOGIN_ATMOSPHERE']);
	
	?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Matteo Bavecchi">
    

    <title>Atmosphere</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Atmosphere</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           <li><a href="#"><?php echo $utente; ?></a></li>
            <li><a href="#">Stato</a></li>
            <li><a href="#">Impostazioni</a></li>
            <li><a href="index.php?out=yes">Esci</a></li>
            
          </ul>
         </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Stato <span class="sr-only">(current)</span></a></li>
            <li><a href="relazione.pdf">Progetto Atmosphere</a></li>
            <li><a href="https://goo.gl/5uIkO8">Codici usati</a></li>
           </ul>
          
          <ul class="nav nav-sidebar">
            
            <li><a href="https://it.linkedin.com/in/bavecchimatteo"><b>Matteo Bavecchi</b></a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Stato</h1>

          <div class="row placeholders">
            <div class="col-xs-12 col-sm-6 ">
             <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://thingspeak.com/channels/112040/charts/1?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Temperatura&type=spline&width=auto&height=auto&start=<?php echo $curdate." 00:00:00";?>">
              </iframe>
             </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 ">
             <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src=
"https://thingspeak.com/channels/112040/charts/2?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=Umidità&type=spline&width=auto&height=auto&start=<?php echo $curdate." 00:00:00";?>"></iframe>
             </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 ">
             <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://thingspeak.com/channels/112040/charts/3?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=GPL&type=spline&width=auto&height=auto&start=<?php echo $curdate." 00:00:00";?>"></iframe>
             </div>
            </div>
            
            <div class="col-xs-12 col-sm-6 ">
             <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://thingspeak.com/channels/112040/charts/4?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=CO2&type=spline&width=auto&height=auto&start=<?php echo $curdate." 00:00:00";?>"></iframe>
             </div>
            </div>

            <div class="col-xs-12 col-sm-6" >
             <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item" src="https://thingspeak.com/channels/112040/charts/5?bgcolor=%23ffffff&color=%23d62020&dynamic=true&results=60&title=CO&type=spline&width=auto&height=auto&start=<?php echo $curdate." 00:00:00";?>"></iframe>
             </div>
            </div>
          </div>

          <h2 class="sub-header">Ultime rilevazioni:</h2>
          <div class="table-responsive">
            <table class="table table-striped table-responsive">
              <thead>
                <tr>
                  <th>Data</th>
                  <th>Temperatura</th>
                  <th>Umidità</th>
                  <th>CO2(ppm)</th>
                  <th>CO(ppm)</th>
                  <th>GPL(ppm) </th>
                </tr>
              </thead>
              <tbody>
    
     <?php while($row=$tabella->fetch_assoc()){ ?>
      <tr>
        <td><?php echo $row['DATA_ORA']; ?></td>
        <td><?php echo $row['TEMPERATURA']; ?></td>
        <td><?php echo $row['UMIDITA']; ?></td>
        <td><?php echo $row['CO2']; ?></td>
        <td><?php echo $row['CO']; ?></td>
        <td><?php echo $row['GPL']; ?></td>
      </tr>
      <?php } ?>
      
    </tbody>
 
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
   </body>
</html>
<?php } ?>
