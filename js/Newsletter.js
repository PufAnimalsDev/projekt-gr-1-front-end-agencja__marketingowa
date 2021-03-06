import React, { useEffect, useState, useRef } from "react";
import Modal from "./Modal";
import ReactTooltip from "react-tooltip";

const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

const Newsletter = () => {

  let [newsletterStatus, setNewsletterStatus] = useState({ status: "unsent" });
  let [showModal, setShowModal] = useState(false);
  let newsletterEl = useRef(null);

  let [emailValid, setEmailValid] = useState(null);
  let [nameValid, setNameValid] = useState(null);

  useEffect(() => {
    if (showModal) {
      document.body.classList.add("no-scroll");
    } else {
      document.body.classList.remove("no-scroll");
      if (newsletterStatus.status === "success") {
        setTimeout(() => {
          setNewsletterStatus({ status: "unsent" });
        }, 1000)
      }
    }
  }, [showModal])

  function validateEmail() {
    let formData = new FormData(newsletterEl.current);

    if (VALID_EMAIL_REGEX.test(formData.get("email"))) {
      setEmailValid(true);
      setShowModal(true);
      setTimeout(() => {
        document.querySelector("#newsletter-name").focus();
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

    setNewsletterStatus({ status: "waiting" });

    let response = await fetch(`${page.api_url}workon/newsletter`, {
      method: 'POST',
      body: new FormData(newsletterEl.current)
    });

    try {
      const result = await response.json();
      if (result.response === "success") {
        setNewsletterStatus({ status: "success" });
      } else {
        setNewsletterStatus({ status: "error", reason: result.reason })
      }
    } catch {
      setNewsletterStatus({ status: "error", reason: "B????d przy wysy??aniu formularza. Spr??buj ponownie p????niej" })
    }

    newsletterEl.current.value = "";
  }

  return (
    <form onSubmit={newsletterSubmitHandler} ref={newsletterEl}>
      <div className="newsletter--content" data-aos="flip-up" data-aos-duration="1000">
        <h4>Email Newsletter</h4>
        <h2>Zapisz si?? na newsletter. Dostaniesz od nas to co najlepsze.</h2>
        <div className="newsletter--content-form">
          <div className="floating-label-group">
            <input onKeyDown={handleEmailEnterPress} type="email" name="email" id="newsletter-email" className="inputCustom" placeholder="Podaj sw??j adres e-mail" autoComplete="email" enterKeyHint="send" required />
            <label className="floating-label center" htmlFor="newsletter-email">Podaj sw??j adres e-mail</label>
            {emailValid === false && <div className="validation-error">
              <span data-tip="Adres e-mail jest niepoprawny"><i className="fas fa-exclamation-circle"></i></span>
              <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
            </div>}
          </div>
          <p>Nikomu nie udost??pnimy twojego adresu email.</p>
          <button type="button" className="btnOutlineCustom" onClick={validateEmail}>Zapisz si??</button>
        </div>
      </div>
      <Modal isOpen={showModal} setIsOpen={setShowModal}>
        <p>
          <strong>Dzi??kujemy, ??e chcesz do nas do????czy??!</strong><br />
          Prosimy Ci?? o jeszcze tylko jedn?? ma???? rzecz.<br />
          Podaj nam swoje imi?? i ciesz si?? nowinkami razem z nami!
        </p>
        <div className="floating-label-group">
          <input type="text" name="name" id="newsletter-name" className="inputCustom" placeholder="Imi??" autoComplete="given-name" enterKeyHint="send" disabled={newsletterStatus === "success"} />
          <label className="floating-label" htmlFor="newsletter-name">Imi??</label>
          {nameValid === false && <div className="validation-error">
            <span data-tip="Pole jest obowi??zkowe"><i className="fas fa-exclamation-circle"></i></span>
            <ReactTooltip backgroundColor="#dc3545" place="top" type="error" effect="solid" />
          </div>}
        </div>
        <button type="submit" onClick={validateName} className="btnDarkCustom" disabled={newsletterStatus.status === "success"}>Wy??lij</button>
        <div className={`circle-loader-container absolute ${newsletterStatus.status === "waiting" || newsletterStatus.status === "success" ? "showEl" : ""}`}>
          <div className={`circle-loader ${newsletterStatus.status === "success" ? "success" : ""}`}>
            <div className="status draw"></div>
          </div>
          {newsletterStatus.status === "success" && <strong>Do????czono do newslettera. Dzi??kujemy!</strong>}
        </div>
        {newsletterStatus.status === "error" && <p>{newsletterStatus.reason}</p>}
      </Modal>
    </form>
  )
}

export default Newsletter;