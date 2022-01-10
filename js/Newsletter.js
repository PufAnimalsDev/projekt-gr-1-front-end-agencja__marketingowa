import React, { useEffect, useState, useRef } from "react";
import Modal from "./Modal";

const Newsletter = () => {

  let [newsletterStatus, setNewsletterStatus] = useState("unsent");
  let [showModal, setShowModal] = useState(false);
  let newsletterEl = useRef(null);

  async function newsletterSubmitHandler() {
    event.preventDefault();

    setNewsletterStatus("waiting");

    let response = await fetch(`${page.api_url}workon/newsletter`, {
      method: 'POST',
      body: new FormData(newsletterEl.current)
    });

    let result = await response.json();

    console.log(response);
    console.log(JSON.parse(result));

    setTimeout(() => {
      setNewsletterStatus("success");
    }, 8000)
  }

  return (
    <>
      <form onSubmit={newsletterSubmitHandler} ref={newsletterEl}>
      <input type="email" name="email" id="newsletter-email" placeholder="Adres e-mail" autoComplete="email" enterKeyHint="send" />
      <button type="button" onClick={() => setShowModal(true)}>Wyślij</button>
        <Modal isOpen={showModal} setIsOpen={setShowModal}>
          <p>modal</p>
          <input type="text" name="name" id="newsletter-name" placeholder="Imię" autoComplete="given-name" enterKeyHint="send" />
          <button type="submit">Wyślij</button>
        </Modal>
      </form>
    </>
  )
}

export default Newsletter;