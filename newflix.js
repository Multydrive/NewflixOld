// flèche
$(document).ready(function()
{
  $(window).scroll(function() {
      if ($(this).scrollTop() >= 50) {
          console.log("scroll");
          $("#fleche_haut").fadeIn(200);
      } else {
          console.log("PETIT scroll");
          $("#fleche_haut").fadeOut(200);
      }
  });

  console.log("pas de scroll");
});
$(document).ready(function()
{
  $("#fleche_haut").click(function(event)
  {
      event.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "slow");
      return false;
  });

});
