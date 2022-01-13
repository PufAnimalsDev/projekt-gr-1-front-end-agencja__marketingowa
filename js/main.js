//start navbar hidding

import "../styles/main.scss";
import "@fortawesome/fontawesome-free/js/all.min.js";

import $ from "jquery"
import React from "react";
import ReactDOM from "react-dom";
import FormWizard from "./FormWizard";
import Newsletter from "./Newsletter";


window.onscroll = function () { scrollFunctionHide() };

function scrollFunctionHide() {

  window.addEventListener("scroll", function (event) {
    let scrolled = this.scrollY;

    if (scrolled > 20) {
      document.getElementById("navHider").style.display = "none";
    }
    else {
      document.getElementById("navHider").style.display = "";
    }
  });
}

document.getElementById('navOpen').addEventListener('click', function () {
  document.getElementById('myNav').style.height = '100%';
}, false);

document.getElementById('closeNav').addEventListener('click', function () {
  document.getElementById('myNav').style.height = '0';
}, false);

$(() => {
  ReactDOM.render(<Newsletter />, document.getElementById("newsletter"));
  ReactDOM.render(<FormWizard />, document.getElementById("formwizard"));
});
