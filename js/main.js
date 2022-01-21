//start navbar hidding

import "../styles/main.scss";
import "@fortawesome/fontawesome-free/js/all.min.js";

import $ from "jquery"
import React from "react";
import ReactDOM from "react-dom";
import FormWizard from "./FormWizard";
import Newsletter from "./Newsletter";
import FormCareer from "./FormCareer";

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
  if (document.getElementById("newsletter_form")) {
    ReactDOM.render(<Newsletter />, document.getElementById("newsletter_form"));
  }
  if (document.getElementById("formwizard")) {
    ReactDOM.render(<FormWizard />, document.getElementById("formwizard"));
  }
  if (document.getElementById("formcareer")) {
    ReactDOM.render(<FormCareer />, document.getElementById("formcareer"));
  }
});
