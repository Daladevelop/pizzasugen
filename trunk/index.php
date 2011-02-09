<?php
/**
 * Pizzasugen main index file
 * 
 * @todo design
 * @todo add more data sources
 */

	require_once('apps/loader.php');
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>Pizzasugen</title>
  <link rel="stylesheet" href="styles/style.css" />
  <script type="text/javascript" src="js/modernizr-1.6.min.js"></script>
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
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
  <script type="text/javascript" src="js/geo.js"></script>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21274752-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

  </script>
</body>

</html>