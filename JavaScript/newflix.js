// flèche
$(document).ready(function()
{
  // Apparition/disparition de la flèche back to top
  $(window).scroll(function()
  {
    $(".apparition").each(function()
    {
      valeur = window.scrollY;
      console.log(valeur);
      if (valeur<200)
      {
        $("#fleche_haut").addClass('disparition');
      }
      else
      {
        $("#fleche_haut").removeClass('disparition');
      }
    });
  });

  // Retour au top si click
  $("#fleche_haut").click(function(event)
  {
      event.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
  });


});
