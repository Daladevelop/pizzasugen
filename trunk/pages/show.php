<div class="section result">

  <?php if(count($spots) > 0) : ?>
 
  <p>Vi hittade  <?php echo count($spots) ?> pizzerior i din närhet.</p>
  <ul>
 
  <?php  foreach($spots as $spot) : ?>
  
    <li class="pizzeria"><a href="<?php echo $spot->getURL() ?>"><?php echo htmlspecialchars($spot->getName()) ?></a>, cirka <?php echo $spot->getDistance() ?> meter ifrån dig.</li>

  <?php endforeach; // spots as spot ?> 
  
  </ul>
   
  <?php else : // count spots ?>
   
  <p>Kunde inte hitta några pizzerior i din närhet. Ta en banan och var glad.</p>
  
  <?php endif; // count spots ?>
  
</div>