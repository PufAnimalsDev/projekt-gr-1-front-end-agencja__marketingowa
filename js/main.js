//start navbar hidding
window.onscroll = function() {scrollFunctionHide()};

function scrollFunctionHide() {

  window.addEventListener("scroll", function (event) {
  let scrolled = this.scrollY;  

  if (scrolled > 20) {
    document.getElementById("navHider").style.display = "none";
    document.getElementById("scrollMenu").style.display = "block";
  }
  else {
    document.getElementById("navHider").style.display = "";
    document.getElementById("scrollMenu").style.display = "none";
  }});  
}
//end navbar hidding

/*Start function of toggling navbar*/
/* Open */
function openNav() {
    document.getElementById("myNav").style.height = "100vh";
}  
/* Close */
function closeNav() {
    document.getElementById("myNav").style.height = "0vh";
}
/*End function of toggling navbar*/