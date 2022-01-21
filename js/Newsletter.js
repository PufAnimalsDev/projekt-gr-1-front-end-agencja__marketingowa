import React, { useEffect, useState, useRef } from "react";
import Modal from "./Modal";
import ReactTooltip from "react-tooltip";

const Newsletter = () => {

  const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  let [newsletterStatus, setNewsletterStatus] = useState("unsent");
  let [showModal, setShowModal] = useState(false);
  let newsletterEl = useRef(null);

  let [emailValid, setEmailValid] = useState(null);
  let [nameValid, setNameValid] = useState(null);

  useEffect(() => {
    if (showModal) {
      document.body.classList.add("no-scroll");
    } else {
      document.body.classList.remove("no-scroll");
      if (newsletterStatus === "success") {
        setTimeout(() => {
          setNewsletterStatus("unsent");
        }, 1000)
      }
    }
  }, [showModal])

  function validateEmail() {
    let formData = new FormData(newsletterEl.current);

    if (VALID_EMAIL_REGEX.test(formData.get("email"))) {
      setEmailValid(true);
      setShowModal(true);
      console.log(newsletterEl.current.querySelector("#newsletter-name"));
      setTimeout(() => {
        newsletterEl.current.querySelector("#newsletter-name").focus();
      }, 100)
    } else {
      setEmailValid(false);
    }
  }

  function validateName(event) {
    let formData = new FormData(newsletterEl.current);
    
    if (formData.get("name")) {
      setNameValid(true);
      return true;
    } else {
      setNameValid(false);
      event.preventDefault();
      return false;
    }
  }

  function handleEmailEnterPress(event) {
    if (event.keyCode == 13 || event.which == 13) { // Enter key
      event.preventDefault();
      validateEmail();
      return false;
    }
  }

  async function newsletterSubmitHandler(event) {
    event.preventDefault();

    setNewsletterStatus("waiting");

    let response = await fetch(`${page.api_url}workon/newsletter`, {
      method: 'POST',
      body: new FormData(newsletterEl.current)
    });

    const result = await response.json();

    const check = JSON.parse(result);

    console.log(result);
    if (check.status === "success") {
      setNewsletterStatus("success");
    } else {
      setNewsletterStatus("error");
    }

    newsletterEl.current.value = "";
  }

  return (
    <form onSubmit={newsletterSubmitHandler} ref={newsletterEl}>
      <div className="newsletter--content-form">
        <div className="floating-label-group">
          <input onKeyDown={handleEmailEnterPress} type="email" name="email" id="newsletter-email" className="inputCustom" placeholder="Podaj swój adres e-mail" autoComplete="email" enterKeyHint="send" required/>
          <label className="floating-label center" htmlFor="newsletter-email">Podaj swój adres e-mail</label>
          {emailValid === false && <div className="validation-error">
            <span data-tip="Adres e-mail jest niepoprawny"><i className="fas fa-exclamation-circle"></i></span>
            <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid"/>
          </div>}
        </div>
        <p>Nikomu nie udostępnimy twojego adresu email.</p>
        <button type="button" className="btnOutlineCustom" onClick={validateEmail}>Zapisz się</button>
      </div>
      <Modal isOpen={showModal} setIsOpen={setShowModal}>
        <p>
          <strong>Dziękujemy, że chcesz do nas dołączyć!</strong><br />
          Prosimy Cię o jeszcze tylko jedną małą rzecz.<br />
          Podaj nam swoje imię i ciesz się nowinkami razem z nami!
        </p>
        <div className="floating-label-group">
          <input type="text" name="name" id="newsletter-name" className="inputCustom" placeholder="Imię" autoComplete="given-name" enterKeyHint="send" disabled={newsletterStatus === "success"}/>
          <label className="floating-label" htmlFor="newsletter-name">Imię</label>
          {nameValid === false && <div className="validation-error">
            <span data-tip="Pole jest obowiązkowe"><i className="fas fa-exclamation-circle"></i></span>
            <ReactTooltip backgroundColor="#dc3545" place="top" type="error" effect="solid"/>
          </div>}
        </div>
        <button type="submit" onClick={validateName} className="btnDarkCustom" disabled={newsletterStatus === "success"}>Wyślij</button>
        <div className={`circle-loader-container absolute ${newsletterStatus === "waiting" || newsletterStatus === "success" ? "show" : ""}`}>
          <div className={`circle-loader ${newsletterStatus === "success" ? "success" : ""}`}>
            <div className="status draw"></div>
          </div>
          {newsletterStatus === "success" && <strong>Dołączono do newslettera. Dziękujemy!</strong>}
        </div>
        {newsletterStatus === "error" && <p>Błąd podczas wysyłania formularza.<br />Spróbuj ponownie później.</p>}
      </Modal>
    </form>
  )
}

export default Newsletter;