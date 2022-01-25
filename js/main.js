//start navbar hidding

import "../styles/main.scss";
import "@fortawesome/fontawesome-free/js/all.min.js";

import $ from "jquery"
import AOS from "aos";
import slick from 'slick-carousel';
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
      document.getElementById("scrollMenu").style.display = "block";
      document.querySelector("header.header").classList.add("scrolleds");

    }
    else {
      document.getElementById("navHider").style.display = "";
      document.getElementById("scrollMenu").style.display = "none";
      document.querySelector("header.header").classList.remove("scrolleds");
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

  $('.testimonials--slider').slick({
    dots: true,
  });

  $('.portfolio--slider').slick({
    adaptiveHeight: true,
    dots: true,
    mobileFirst: true,
    responsive: [
      {
        breakpoint: 799,
        settings: {
          centerMode: true,
          centerPadding: "0px",
          slidesToShow: 3
        }
      }
    ]
  });

  AOS.init({
    offset: 300
  });

  if (document.getElementById("newsletter_form")) {
    ReactDOM.render(<Newsletter />, document.getElementById("newsletter_form"));
  }
  if (document.getElementById("formwizard")) {
    ReactDOM.render(<FormWizard />, document.getElementById("formwizard"));
  }
  if (document.getElementById("career-form")) {
    ReactDOM.render(<FormCareer />, document.getElementById("career-form"));
  }
});
