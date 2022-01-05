//start navbar hidding
window.onscroll = function() {scrollFunctionHide()};

function scrollFunctionHide() {

  window.addEventListener("scroll", function (event) {
  let scrolled = this.scrollY;  

  if (scrolled > 20) {
    document.getElementById("navHider").style.display = "none";
  }
  else {
    document.getElementById("navHider").style.display = "1";
  }});  
}
//end navbar hidding

/*Start function of toggling navbar*/
/* Open */
function openNav() {
    document.getElementById("myNav").style.height = "100%";
}  
/* Close */
function closeNav() {
    document.getElementById("myNav").style.height = "0%";
}
/*End function of toggling navbar*/