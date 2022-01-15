import React, { useEffect, useState, useRef } from "react";
import Modal from "./Modal";

const Newsletter = () => {

  let [newsletterStatus, setNewsletterStatus] = useState("unsent");
  let [showModal, setShowModal] = useState(false);
  let newsletterEl = useRef(null);

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
    <>
      <div className="container" data-aos="fade-up">
        <div className="row">
          <div className="col-lg-8 col-xl-7 col-xxl-6">
            <form onSubmit={newsletterSubmitHandler} ref={newsletterEl}>
              <div className="input-group">
                <input type="email" name="email" id="newsletter-email" placeholder="Adres e-mail" autoComplete="email" enterKeyHint="send" required />
                <button type="button" onClick={() => setShowModal(true)}>Subskrybuj</button>
              </div>
              <Modal isOpen={showModal} setIsOpen={setShowModal}>
                <p>modal</p>
                <input type="text" name="name" id="newsletter-name" placeholder="Imię" autoComplete="given-name" enterKeyHint="send" />
                <button type="submit">Wyślij</button>
              </Modal>
            </form>
          </div>
        </div>
      </div>
    </>
  )
}

export default Newsletter;