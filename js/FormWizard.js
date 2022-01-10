import React, { useRef, useState } from "react";
import Tile from "./Tile";
import Timeline from "./Timeline";

const FormWizard = () => {
  let [currentTile, setCurrentTile] = useState(0);
  let [formStatus, setFormStatus] = useState("unsent");

  let formEl = useRef(null);

  const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  function validateFormElement(element) {
    let formData = new FormData(formEl.current);
    let elValue = formData.get(element);

    switch (element) {
      case "name":
      case "company_name":
      case "company_goal":
      case "company_goal_deadline":
      case "why_us":
      case "decision_help":
        if (elValue) {
          return { status: true };
        } else {
          return { status: false, error: "empty" };
        }
      case "email":
        if (VALID_EMAIL_REGEX.test(elValue)) {
          return { status: true };
        } else if (elValue) {
          return { status: false, error: "invalid" };
        } else {
          return { status: false, error: "empty" };
        }
    }
  }

  async function formSubmitHandler(event) {
    event.preventDefault();

    setFormStatus("waiting");

    let response = await fetch(`${page.api_url}workon/formwizard`, {
      method: 'POST',
      body: new FormData(formEl.current)
    });

    let result = await response.json();

    console.log(response);
    console.log(JSON.parse(result));

    setTimeout(() => {
      setFormStatus("success");
    }, 8000)
  }

  return (
    <div>
      <Timeline currentTile={currentTile} setCurrentTile={setCurrentTile} tileCount={13} formComplete={formStatus === "success" ? true : false} />
      <div className="formwizard--container">
        <form className={`formwizard ${formStatus === "success" ? "hide" : ""}`} ref={formEl} onSubmit={formSubmitHandler} onScroll={event => { event.target.scrollLeft = 0 }}>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={0}>
            <h1>Formularz zgłoszeniowy</h1>
            <p>Witaj w kreatorze formularza zgłoszeniowego.<br />
              Pokierujemy cię krok po kroku przez proces zgłoszenia.<br />
              Kliknij dalej, aby zacząć wypełnianie formularza.</p>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={1} validationFunction={validateFormElement} validate={"name"}>
            <label htmlFor="formwizard-name">Imię i nazwisko</label>
            <input className="form-control" type="text" name="name" id="formwizard-name" placeholder="Imię i nazwisko" autoComplete="name" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={2} validationFunction={validateFormElement} validate={"company_name"}>
            <label htmlFor="formwizard-company_name">Nazwa firmy</label>
            <input className="form-control" type="text" name="company_name" id="formwizard-company_name" placeholder="Nazwa firmy" autoComplete="organization" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={3} validationFunction={validateFormElement} validate={"email"}>
            <label htmlFor="formwizard-email">Adres e-mail</label>
            <input className="form-control" type="email" name="email" id="formwizard-email" placeholder="Adres e-mail" autoComplete="email" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={4}>
            <label htmlFor="formwizard-phone">Numer telefonu (opcjonalnie)</label>
            <input className="form-control" type="text" name="phone" id="formwizard-phone" placeholder="Numer telefonu" autoComplete="tel" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={5}>
            <label htmlFor="formwizard-topic">Z czym możemy Ci pomóc?</label>
            <select className="form-select" name="topic" id="formwizard-topic">
              <option value="op1">Opcja 1</option>
              <option value="op2">Opcja 2</option>
              <option value="op3">Opcja 3</option>
              <option value="op4">Opcja 4</option>
            </select>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={6} validationFunction={validateFormElement} validate={"company_goal"}>
            <label htmlFor="formwizard-company_goal">Jaki jest cel Twojej firmy?</label>
            <textarea className="form-control" name="company_goal" id="formwizard-company_goal" enterKeyHint="enter" ></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={7} validationFunction={validateFormElement} validate={"company_goal_deadline"}>
            <label htmlFor="formwizard-company_goal_deadline">Do kiedy Twoja firma chce go osiągnąć?</label>
            <textarea className="form-control" name="company_goal_deadline" id="formwizard-company_goal_deadline" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={8}>
            <label htmlFor="formwizard-file">Plik (opcjonalnie)</label>
            <input className="form-control" type="file" name="file" id="formwizard-file" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={9} validationFunction={validateFormElement} validate={"why_us"}>
            <label htmlFor="formwizard-why_us">Dlaczego wybrałeś/aś nas?</label>
            <textarea className="form-control" name="why_us" id="formwizard-why_us" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={10} validationFunction={validateFormElement} validate={"decision_help"}>
            <label htmlFor="formwizard-decision_help">Jak możemy pomóc Ci podjąć dezycję?</label>
            <textarea className="form-control" name="decision_help" id="formwizard-decision_help" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={11}>
            <label htmlFor="formwizard-extra_info">Dodaktowe informacje</label>
            <textarea className="form-control" name="extra_info" id="formwizard-extra_info" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={12} replaceNextWithSubmit={true} formStatus={formStatus}>
            <h2>Przejrzyj dane</h2>
            <p>tu wszystkie dane</p>
            <div className={`formwizard--loading-overlay ${formStatus === "waiting" || formStatus === "success" ? "show" : ""}`}>
              <i className="fas fa-2x fa-circle-notch fa-spin"></i>
            </div>
          </Tile>

        </form>

        <div className={`formwizard--success ${formStatus === "success" ? "show" : ""}`}>
          <h2>Wysłano formularz</h2>
          <p>Dziękujemy! Skontaktujemy się wkrótce.</p>
        </div>
      </div>
    </div>
  )
}

export default FormWizard;