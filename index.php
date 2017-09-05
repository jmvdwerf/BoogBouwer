<?php 

require_once("./src/Instellingen.php");
require_once("./src/Vorm.php");
require_once("./src/Boog.php");

$settings = new Instellingen(30, 80);

//var_dump($settings);

$boog = new Boog($settings);

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

    <title>BoogBouwer</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    	<style>
.wrap svg {
    width: 100%;
    height: 100%;
    display: block;
}
    	</style>

  </head>

  <body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">BoogBouwer</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <!-- voor als we meer dan bogen willen... -->
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="container">

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Instellingen</div>
            <div class="panel-body">Formulier</div>
            <div class="panel-footer">Knoppen</div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Voorbeeld</div>
            <div class="panel-body">
            	<div class="wrap">
					<?php echo $boog->printSVG(); ?>
				</div>
            </div>
        </div>
    </div>
      
    </div> <!-- /container -->
    <div class="container">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">OpenSCAD Code</div>
                <div class="panel-body form-horizontal">
                    <textarea rows="10" class="form-control"><?php 
                        echo $boog->printScad();
                    ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

