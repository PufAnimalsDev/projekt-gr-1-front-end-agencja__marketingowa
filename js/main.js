//start navbar hidding
// When the user scrolls down 20px from the top of the document, slide down the navbar
// When the user scrolls to the top of the page, slide up the navbar (50px out of the top view)
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("navbar").style.top = "1rem";
  } else {
    document.getElementById("navbar").style.top = "-4rem";
  }
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