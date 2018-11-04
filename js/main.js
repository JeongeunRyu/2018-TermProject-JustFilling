function move(){
    $('#mcr').animate( {top:'-0.8%'},800,move).animate( {top:'0.8%'},800,move);
}
$(document).ready(function () {
  move();
  $("body").css("display", "none");
  $("body").fadeIn(1000);


    $("#file").load("../pages/b.html");


 });
