<?php
	require_once('apps/loader.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Pizzasugen</title>
    <link rel="stylesheet" href="styles/style.css" />
</head>

<body>
	<h1>#Pizzasugen?</h1>	
	<?php 	
	if (isset($_GET['key'])) {
	  
    $spots = get_spots($_GET['key']);    
	  require "pages/show.php";
	} else {
	  require "pages/main.php";
	}
  ?>
  <div id="credits">
    <p>
      #daladevelop, <a href="http://twitter.com/mikaeljorhult">@mikaeljorhult</a>, <a href="http://twitter.com/synvila">@synvila</a>, <a href="http://twitter.com/rickard2">@rickard2</a>
    </p>    
  </div>
</body>

</html>