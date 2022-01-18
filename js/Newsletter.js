import React, { useEffect, useState, useRef } from "react";
import Modal from "./Modal";

const Newsletter = () => {

  const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  let [newsletterStatus, setNewsletterStatus] = useState("unsent");
  let [showModal, setShowModal] = useState(false);
  let newsletterEl = useRef(null);

  let [emailValid, setEmailValid] = useState(null);

  function validateEmail() {
    let formData = new FormData(newsletterEl.current);

    if (VALID_EMAIL_REGEX.test(formData.get("email"))) {
      setEmailValid(true);
      setShowModal(true)
    } else {
      setEmailValid(false);
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
      alert("Daanke shone")

    } else {
      alert("Coś poszło nie tak")
    }

    newsletterEl.current.value = "";
  }

  return (
    <form onSubmit={newsletterSubmitHandler} ref={newsletterEl}>
      <div className="newsletter-content-form">
        <input type="email" name="email" id="newsletter-email" className="inputCustom" aria-describedby="emailHelp" placeholder="Please enter your email" autoComplete="email" enterKeyHint="send" required />
        {emailValid === false && <p>This email is invalid</p>}
        <p>We'll NOT share your email address to anyone else.</p>
        <label className="checkbox-inline" htmlFor="monthly">
          <input type="checkbox" name="monthly" id="monthly" value="" />Please send me a monthly newsletter.
        </label>   
        <button type="button" className="btnOutlineCustom" onClick={() => validateEmail()}>Sign up</button>
      </div>
      <Modal isOpen={showModal} setIsOpen={setShowModal}>
        <p>modal</p>
        <input type="text" name="name" id="newsletter-name" placeholder="Imię" autoComplete="given-name" enterKeyHint="send" />
        <button type="submit">Wyślij</button>
      </Modal>
    </form>
  )
}

export default Newsletter;