(function() {

  // När en positionering har lyckats, använd ajax för att kontrollera om det finns några pizzerior i närheten
  function success(position) {
    
    var url = document.location.href + '/find.php?lat=' + position.coords.latitude + '&lng=' + position.coords.longitude;

    jQuery.ajax(url, {
      dataType: 'json',
      
      // När ajax-anropet misslyckas
      error: function() {
        jQuery("#searching").hide();
        jQuery("#error").text("Ett internt fel uppstod vid sökning.").show('fast');
      },
      
      // När ajax-anropet lyckas
      success: function(data, textStatus, jqXHR) {
        if (data.spots == 0) {
          jQuery("#searching").hide();
          jQuery("#error").text('Fick din position men kunde inte hitta några pizzerior i närheten.').show('fast');          
        } else {
          window.location.href = window.location.href + '/' + data.key; 
        }
      }
    });
  }
  
  // När en positionering misslyckas
  function error(msg) {
    jQuery("#searching").hide();
    jQuery("#error").text('Ett fel uppstod när vi försökte hitta din position.').show('fast');
  }

  // Klick handler för hitta mig knappen.     
  jQuery("#findme").click(function() {
    if (navigator.geolocation) {
      
      jQuery("#searching").show();
      navigator.geolocation.getCurrentPosition(success, error);
    } else {
      jQuery("#error").text('Tyvärr verkar du inte ha stöd för positionering i din webbläsare.').show('fast');
    }    
  })  
})();




