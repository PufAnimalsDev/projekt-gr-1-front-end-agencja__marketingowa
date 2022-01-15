import React, { useEffect, useRef, useState, useCallback } from "react";
import Slider from 'rc-slider';
import Timeline from "./Timeline";
import Tile from "./Tile";
import FormSummary from "./FormSummary";
import { useDropzone } from 'react-dropzone';

const createSliderWithTooltip = Slider.createSliderWithTooltip;
const Range = createSliderWithTooltip(Slider.Range);

const FormWizard = () => {
  let [currentTile, setCurrentTile] = useState(0);
  let [formStatus, setFormStatus] = useState("unsent");
  let [budget, setBudget] = useState({min: 5000, max: 20000});

  let [attachment, setAttachment] = useState(null);
  let [tooManyAttachments, setTooManyAttachments] = useState(false);
  const { getRootProps, getInputProps, isDragActive } = useDropzone({ onDrop: onFileDrop, onDropRejected: onFileDropRejected, maxFiles: 1, multiple: false });

  let formEl = useRef(null);

  const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  function onFileDrop(files) {
    setAttachment(files[0]);
    setTooManyAttachments(false);
  };

  function onFileDropRejected(files) {
    if (files[0].errors[0].code === "too-many-files") {
      setTooManyAttachments(true);
    }
  }

  function validateFormElement(formFields) {
    let formData = new FormData(formEl.current);

    let output = [];

    for (let formField of formFields) {
      let formValue = formData.get(formField);
      switch (formField) {
        case "name":
        case "company_name":
        case "company_goal":
        case "company_goal_deadline":
        case "why_us":
        case "decision_help":
          if (formValue) {
            output.push({ field: formField, status: true });
          } else {
            output.push({ field: formField, status: false, error: "empty" });
          }
          break;
        case "email":
          if (VALID_EMAIL_REGEX.test(formValue)) {
            output.push({ field: formField, status: true });
          } else if (formValue) {
            output.push({ field: formField, status: false, error: "invalid" });
          } else {
            output.push({ field: formField, status: false, error: "empty" });
          }
          break;
      }
    }

    return output;
  }

  async function formSubmitHandler(event) {
    event.preventDefault();

    setFormStatus("waiting");

    let formData = new FormData(formEl.current);

    formData.append("budget_min", `${budget.min} zł`);
    formData.append("budget_max", `${budget.max} zł`);

    formData.append("file", attachment);

    let response = await fetch(`${page.api_url}workon/formwizard`, {
      method: 'POST',
      body: formData
    });

    const result = await response.json();
    const check = JSON.parse(result);

    console.log(result);
    console.log(check);

    if (check.status === "success") {
      setFormStatus("success");
    } else {
      alert("Coś poszło nie tak")
    }

    formEl.current.value = "";
  }

  return (
    <div>
      <Timeline currentTile={currentTile} setCurrentTile={setCurrentTile} tileCount={9} formComplete={formStatus === "success" ? true : false} />
      <div className="formwizard--container">
        <form className={`formwizard ${formStatus === "success" ? "hide" : ""}`} ref={formEl} onSubmit={formSubmitHandler} onScroll={event => { event.target.scrollLeft = 0 }}>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={0}>
            <label htmlFor="formwizard-topic">Z czym możemy Ci pomóc?*</label>
            <select className="form-select" name="topic" id="formwizard-topic">
              <option value="op1">Opcja 1</option>
              <option value="op2">Opcja 2</option>
              <option value="op3">Opcja 3</option>
              <option value="op4">Opcja 4</option>
            </select>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={1} validationFunction={validateFormElement} validate={["company_goal", "company_goal_deadline"]}>
            <label htmlFor="formwizard-company_goal">Jaki jest cel Twojej firmy?*</label>
            <textarea className="form-control" name="company_goal" id="formwizard-company_goal" enterKeyHint="enter" ></textarea>
            <label htmlFor="formwizard-company_goal_deadline">Do kiedy Twoja firma chce go osiągnąć?*</label>
            <textarea className="form-control" name="company_goal_deadline" id="formwizard-company_goal_deadline" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={2} validationFunction={validateFormElement} validate={""}>
            <p>Ile wynosi budżet przeznaczony na realizację tego celu?*</p>
            <Range 
              min={1000} 
              max={50000}
              defaultValue={[5000, 20000]}
              value={[budget.min, budget.max]}
              step={1000}
              onChange={values => {
                setBudget({min: values[0], max: values[1]});
              }}
              marks={{1000: "1 000 zł", 10000: "10 000 zł", 20000: "20 000 zł", 30000: "30 000 zł", 40000: "40 000 zł", 50000: "50 000 zł"}}
              tipFormatter={value => `${value / 1000} 000 zł`}
              />
            <p>lub wpisz ręcznie:</p>
            <input type="number" name="budget_min" value={budget.min} onInput={event => setBudget({min: parseInt(event.target.value), max: budget.max})} onBlur={() => budget.min > budget.max ? setBudget({min: budget.max, max: budget.min}) : null} /> zł - 
            <input type="number" name="budget_max" value={budget.max} onInput={event => setBudget({min: budget.min, max: parseInt(event.target.value)})} onBlur={() => budget.min > budget.max ? setBudget({min: budget.max, max: budget.min}) : null} /> zł
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={3} validationFunction={validateFormElement} validate={["why_us"]}>
            <label htmlFor="formwizard-why_us">Dlaczego wybrałeś/aś nas?*</label>
            <textarea className="form-control" name="why_us" id="formwizard-why_us" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={4} validationFunction={validateFormElement} validate={["decision_help"]}>
            <label htmlFor="formwizard-decision_help">Jak możemy pomóc Ci podjąć decyzję?*</label>
            <textarea className="form-control" name="decision_help" id="formwizard-decision_help" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={5} validationFunction={validateFormElement} validate={["name", "company_name"]}>
            <label htmlFor="formwizard-name">Imię i nazwisko*</label>
            <input className="form-control" type="text" name="name" id="formwizard-name" placeholder="Imię i nazwisko" autoComplete="name" enterKeyHint="next" />
            <label htmlFor="formwizard-company_name">Nazwa firmy*</label>
            <input className="form-control" type="text" name="company_name" id="formwizard-company_name" placeholder="Nazwa firmy" autoComplete="organization" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={6} validationFunction={validateFormElement} validate={["email"]}>
            <label htmlFor="formwizard-email">Adres e-mail*</label>
            <input className="form-control" type="email" name="email" id="formwizard-email" placeholder="Adres e-mail" autoComplete="email" enterKeyHint="next" />
            <label htmlFor="formwizard-phone">Numer telefonu</label>
            <input className="form-control" type="text" name="phone" id="formwizard-phone" placeholder="Numer telefonu" autoComplete="tel" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={7}>
            <label htmlFor="formwizard-extra_info">Dodaktowe informacje:</label>
            <textarea className="form-control" name="extra_info" id="formwizard-extra_info" enterKeyHint="enter"></textarea>
            <label htmlFor="formwizard-file">Załącznik:</label>
            <div className='dropzone' {...getRootProps()}>
              <input {...getInputProps()} />
              {isDragActive ?
                <p>Upuść plik tutaj ...</p>
              : 
                <>
                  <p>Przeciągnij tutaj plik lub kliknij tu, aby go wybrać.</p>
                  <p>Możesz załączyć wyłącznie 1 plik.</p>
                </> 
              }
            </div>
            {tooManyAttachments ? <p>Błąd: Za dużo załączonych plików. Możesz załączyć wyłącznie 1 plik.</p> : ""}
            {attachment ? <div className='mb-3'>Załączono plik:<br /><b>{attachment.name}</b> - {(attachment.size / 1024 / 1024).toFixed(2)} MB</div> : ''}
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={8} replaceNextWithSubmit={true} formStatus={formStatus}>
            <h2>Przejrzyj dane</h2>
            <FormSummary currentTile={currentTile} formEl={formEl.current} tileCount={9} additionalFields={{attachment}} />
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
