import React, { useRef, useState } from "react";
import Slider from 'rc-slider';
import Timeline from "./Timeline";
import Tile from "./Tile";
import FormSummary from "./FormSummary";
import { useDropzone } from 'react-dropzone';
import DatePicker, { registerLocale, setDefaultLocale } from "react-datepicker";
import pl from "date-fns/locale/pl";

registerLocale("pl", pl);
setDefaultLocale("pl");

const createSliderWithTooltip = Slider.createSliderWithTooltip;
const Range = createSliderWithTooltip(Slider.Range);

const FormWizard = () => {
  const [currentTile, setCurrentTile] = useState(0);
  const [formStatus, setFormStatus] = useState("unsent");
  const [budget, setBudget] = useState({min: 20000, max: 50000});

  const [topic, setTopic] = useState("Opcja 1");

  const [companyGoalDeadline, setCompanyGoalDeadline] = useState(new Date());

  const [attachment, setAttachment] = useState(null);
  const [tooManyAttachments, setTooManyAttachments] = useState(false);
  const { getRootProps, getInputProps, isDragActive, inputRef } = useDropzone({ onDrop: onFileDrop, onDropRejected: onFileDropRejected, maxFiles: 1, multiple: false });

  const formEl = useRef(null);

  const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  function handleTopicStep(topic) {
    setTopic(topic);
    setCurrentTile(currentTile+1);
  }

  function onFileDrop(files) {
    setAttachment(files[0]);
    setTooManyAttachments(false);
  };

  function onFileDropRejected(files) {
    if (files[0].errors[0].code === "too-many-files") {
      setTooManyAttachments(true);
    }
  }

  function removeAttachment() {
    setAttachment(null);
    inputRef.current.value = "";
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

    formData.append("topic", topic);

    formData.append("budget_min", `${budget.min} zł`);
    formData.append("budget_max", `${budget.max} zł`);

    let companyGoalDeadlineFormatted = companyGoalDeadline.toLocaleDateString("pl-PL", {weekday: "long", year: "numeric", month: "long", day: "numeric"});
    formData.append("company_goal_deadline", companyGoalDeadlineFormatted);

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
      <Timeline currentTile={currentTile} setCurrentTile={setCurrentTile} tileCount={8} formComplete={formStatus === "success" ? true : false} />
      <div className="formwizard--container">
        <form className={`formwizard ${formStatus === "success" ? "hide" : ""}`} ref={formEl} onSubmit={formSubmitHandler} onScroll={event => { event.target.scrollLeft = 0 }}>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={0} hideNext={true} title="Z czym możemy Ci pomóc?">
            <div className="formwizard--topic-container">
              <button type="button" onClick={() => handleTopicStep("Opcja 1")}><i className="formwizard--topic-icon fas fa-user"></i> Opcja 1</button>
              <button type="button" onClick={() => handleTopicStep("Opcja 2")}><i className="formwizard--topic-icon fas fa-user"></i> Opcja 2</button>
              <button type="button" onClick={() => handleTopicStep("Opcja 3")}><i className="formwizard--topic-icon fas fa-user"></i> Opcja 3</button>
              <button type="button" onClick={() => handleTopicStep("Opcja 4")}><i className="formwizard--topic-icon fas fa-user"></i> Opcja 4</button>
            </div>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={1} validationFunction={validateFormElement} validate={["company_goal"]} title="Cel twojej firmy">
            <label htmlFor="formwizard-company_goal">Jaki jest cel Twojej firmy?*</label>
            <textarea className="form-control" name="company_goal" id="formwizard-company_goal" enterKeyHint="enter" ></textarea>
            <label htmlFor="formwizard-company_goal_deadline">Do kiedy Twoja firma chce go osiągnąć?*</label>
            <DatePicker id="formwizard-company_goal_deadline" name="company_goal_deadline" selected={companyGoalDeadline} onChange={(date) => setCompanyGoalDeadline(date)} inline minDate={new Date()} />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={2} title="Budżet">
            <p>Ile wynosi budżet przeznaczony na realizację tego celu?*</p>
            <Range 
              min={10000} 
              max={100000}
              defaultValue={[20000, 50000]}
              value={[budget.min, budget.max]}
              step={5000}
              onChange={values => {
                setBudget({min: values[0], max: values[1]});
              }}
              marks={{10000: "10 000 zł", 25000: "25 000 zł", 50000: "50 000 zł", 75000: "75 000 zł", 100000: "100 000 zł",}}
              tipFormatter={value => `${value / 1000} 000 zł`}
              />
            <p>lub wpisz ręcznie:</p>
            <input type="number" name="budget_min" value={budget.min} onInput={event => setBudget({min: parseInt(event.target.value), max: budget.max})} onBlur={() => budget.min > budget.max ? setBudget({min: budget.max, max: budget.min}) : null} /> zł - 
            <input type="number" name="budget_max" value={budget.max} onInput={event => setBudget({min: budget.min, max: parseInt(event.target.value)})} onBlur={() => budget.min > budget.max ? setBudget({min: budget.max, max: budget.min}) : null} /> zł
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={3} validationFunction={validateFormElement} validate={["why_us"]} title="Dlaczego my?">
            <label htmlFor="formwizard-why_us">Dlaczego wybrałeś/aś nas?*</label>
            <textarea className="form-control" name="why_us" id="formwizard-why_us" enterKeyHint="enter"></textarea>
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={4} validationFunction={validateFormElement} validate={["name", "company_name"]} title="Dane osobowe">
            <label htmlFor="formwizard-name">Imię i nazwisko*</label>
            <input className="form-control" type="text" name="name" id="formwizard-name" placeholder="Imię i nazwisko" autoComplete="name" enterKeyHint="next" />
            <label htmlFor="formwizard-company_name">Nazwa firmy*</label>
            <input className="form-control" type="text" name="company_name" id="formwizard-company_name" placeholder="Nazwa firmy" autoComplete="organization" enterKeyHint="next" />
            <label htmlFor="formwizard-company_job_title">Stanowisko</label>
            <input className="form-control" type="text" name="company_job_title" id="formwizard-company_job_title" placeholder="Stanowisko" autoComplete="organization-title" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={5} validationFunction={validateFormElement} validate={["email"]} title="Dane kontaktowe">
            <label htmlFor="formwizard-email">Adres e-mail*</label>
            <input className="form-control" type="email" name="email" id="formwizard-email" placeholder="Adres e-mail" autoComplete="email" enterKeyHint="next" />
            <label htmlFor="formwizard-phone">Numer telefonu</label>
            <input className="form-control" type="text" name="phone" id="formwizard-phone" placeholder="Numer telefonu" autoComplete="tel" enterKeyHint="next" />
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={6} title="Dodatkowe informacje">
            <label htmlFor="formwizard-extra_info">Dodaktowe informacje:</label>
            <textarea className="form-control" name="extra_info" id="formwizard-extra_info" enterKeyHint="enter"></textarea>
            <label htmlFor="formwizard-file">Załącznik:</label>
            <div className='dropzone' {...getRootProps()}>
              <input id="formwizard-file" {...getInputProps()} />
              {isDragActive ?
                <p>Upuść plik tutaj...</p>
              : 
                <>
                  Przeciągnij tutaj plik lub kliknij tu, aby go wybrać.<br />
                  Możesz załączyć wyłącznie 1 plik.
                </> 
              }
            </div>
            {tooManyAttachments ? <p>Błąd: Za dużo załączonych plików. Możesz załączyć wyłącznie 1 plik.</p> : ""}
            {attachment ? 
              <>
                <div className='mb-3'>
                  Załączono plik:<br />
                  <strong>{attachment.name}</strong> - {(attachment.size / 1024 / 1024).toFixed(2)} MB <button className="btnDarkCustom formwizard--detach-btn" type="button" onClick={removeAttachment}><i className="fas fa-fw fa-times"></i></button>
                </div>
              </>
            : ''}
          </Tile>

          <Tile currentTile={currentTile} setCurrentTile={setCurrentTile} tileNum={7} showSubmit={true} hideNext={true} formStatus={formStatus} title="Przegląd danych">
            <FormSummary currentTile={currentTile} formEl={formEl.current} tileCount={8} additionalFields={{attachment, companyGoalDeadline, topic}} />
            <div className={`formwizard--loading-overlay ${formStatus === "waiting" || formStatus === "success" ? "show" : ""}`}>
              <i className="fas fa-2x fa-circle-notch fa-spin"></i>
            </div>
          </Tile>

        </form>

        <div className={`formwizard--success ${formStatus === "success" ? "show" : ""}`}>
          <h2>Wysłano formularz</h2>
          <p>Dziękujemy! Skontaktujemy się wkrótce.</p>
          <p>Wysłaliśmy na podany adres e-mail potwierdzenie razem z kopią danych formularza.</p>
        </div>
      </div>
    </div>
  )
}

export default FormWizard;
