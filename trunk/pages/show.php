<div class="section result">

  <?php if(count($spots['spot_data']) > 0) : ?>
 
  <p>Vi hittade  <?php echo count($spots['spot_data']) ?> pizzerior i din närhet.</p>
  <ul>
 
  <?php  foreach($spots['spot_data'] as $spot) : ?>
  
    <li class="pizzeria"><a href="<?php echo $spot->getURL() ?>"><?php echo htmlspecialchars($spot->getName()) ?></a>, cirka <?php echo $spot->getDistance() ?> meter ifrån dig.</li>

  <?php endforeach; // spots as spot ?> 
  
  </ul>
  
  <p>Du har angett att du befinner dig på <?php echo $spots['latitude'] . "," . $spots['longitude'] ?></p> 

  <div id="map_canvas"></div>
   
  <?php else : // count spots ?>
   
  <p>Kunde inte hitta några pizzerior i din närhet. Ta en banan och var glad.</p>
  
  <?php endif; // count spots ?>
  
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  
  var latlng = new google.maps.LatLng(<?php echo $spots['latitude'] ?>, <?php echo $spots['longitude'] ?>);
  var myOptions = {
    zoom: 13,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  var map = new google.maps.Map(document.getElementById("map_canvas"),
      myOptions);

  var marker = new google.maps.Marker({
    clickable:false,
    draggable:false,
    flat:true,
    cursor:'<?php echo $spots['latitude'] ?>, <?php echo $spots['longitude'] ?>',
    map:map,
    title:'<?php echo $spots['latitude'] ?>, <?php echo $spots['longitude'] ?>',
    visible:true,
    position:latlng
  });

</script>