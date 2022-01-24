import React, { forwardRef, useRef, useState } from "react";
import Slider from 'rc-slider';
import ReactTooltip from "react-tooltip";
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
  const [fromSummary, setFromSummary] = useState(false);
  const [formStatus, setFormStatus] = useState("unsent");
  const [budget, setBudget] = useState({ min: 20000, max: 50000 });
  const [formErrors, setFormErrors] = useState({});

  const [topic, setTopic] = useState("Opcja 1");

  const [companyGoalDeadline, setCompanyGoalDeadline] = useState(new Date());

  const [attachment, setAttachment] = useState(null);
  const [tooManyAttachments, setTooManyAttachments] = useState(false);
  const { getRootProps, getInputProps, isDragActive, inputRef } = useDropzone({ onDrop: onFileDrop, onDropRejected: onFileDropRejected, maxFiles: 1, multiple: false });

  const formEl = useRef(null);

  const commonTileProps = {
    currentTile: currentTile,
    setCurrentTile: setCurrentTile,
    fromSummary: fromSummary,
    setFromSummary: setFromSummary,
    validationFunction: validateFormElement
  }

  const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

  function handleTopicStep(topic) {
    setTopic(topic);
    if (fromSummary) {
      setCurrentTile(7);
      setFromSummary(false);
    } else {
      setCurrentTile(currentTile + 1);
    }
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

    let output = true;
    let errors = {};

    for (let formField of formFields) {
      let formValue = formData.get(formField);
      switch (formField) {
        case "name":
        case "company_name":
        case "company_goal":
        case "company_goal_deadline":
        case "why_us":
        case "decision_help":
          if (!formValue) {
            output = false;
            errors[formField] = "To pole jest obowiązkowe";
          }
          break;
        case "email":
          if (!VALID_EMAIL_REGEX.test(formValue) && formValue) {
            output = false;
            errors[formField] = "Adres e-mail jest nieprawidłowy"
          } else if (!formValue) {
            output = false;
            errors[formField] = "To pole jest obowiązkowe";
          }
          break;
      }
    }

    setFormErrors(errors);
    return output;
  }

  async function formSubmitHandler(event) {
    event.preventDefault();

    setFormStatus("waiting");

    let formData = new FormData(formEl.current);

    formData.append("topic", topic);

    formData.append("budget_min", `${budget.min} zł`);
    formData.append("budget_max", `${budget.max} zł`);

    let companyGoalDeadlineFormatted = companyGoalDeadline.toLocaleDateString("pl-PL", { weekday: "long", year: "numeric", month: "long", day: "numeric" });
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
      setFormStatus("error");
    }
  }

  return (
    <div>
      <Timeline currentTile={currentTile} tileCount={8} formComplete={formStatus === "success" ? true : false} />
      <div className="formwizard--container">
        <form className={`formwizard ${formStatus === "success" ? "hide" : ""}`} ref={formEl} onSubmit={formSubmitHandler} onScroll={event => { event.target.scrollLeft = 0 }}>

          <Tile {...commonTileProps} tileNum={0} hideNext={true} title="Z czym możemy Ci pomóc?">
            <div className="formwizard--topic-container">
              <button type="button" onClick={() => handleTopicStep("SEO")}><i className="formwizard--topic-icon fas fa-search"></i> SEO</button>
              <button type="button" onClick={() => handleTopicStep("Analityka internetowa")}><i className="formwizard--topic-icon fas fa-chart-bar"></i> Analityka internetowa</button>
              <button type="button" onClick={() => handleTopicStep("Social Media")}><i className="formwizard--topic-icon fas fa-thumbs-up"></i> Social Media</button>
              <button type="button" onClick={() => handleTopicStep("Content Marketing")}><i className="formwizard--topic-icon fas fa-newspaper"></i> Content Marketing</button>
            </div>
          </Tile>

          <Tile {...commonTileProps} tileNum={1} validate={["company_goal", "company_goal_deadline"]} title="Cel twojej firmy">
            <div className="floating-label-group">
              <textarea className="inputCustom" name="company_goal" id="formwizard-company_goal" enterKeyHint="enter" placeholder="Cel twojej firmy"></textarea>
              <label className="floating-label" htmlFor="formwizard-company_goal">Jaki jest cel Twojej firmy?*</label>
              {formErrors.company_goal && <div className="validation-error">
                <span data-tip={formErrors.company_goal}><i className="fas fa-exclamation-circle"></i></span>
                <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
              </div>
              }
            </div>
            <label htmlFor="formwizard-company_goal_deadline">Do kiedy Twoja firma chce go osiągnąć?*</label>
            <div className="formwizard--datepicker-wrapper">
              <DatePicker
                dateFormat="dd.MM.yyyy"
                className="inputCustom"
                id="formwizard-company_goal_deadline"
                name="company_goal_deadline"
                selected={companyGoalDeadline}
                onChange={(date) => setCompanyGoalDeadline(date)}
                popperPlacement="top"
                popperModifiers={[
                  {
                    name: "offset",
                    options: {
                      offset: [0, 8],
                    },
                  }
                ]}
                minDate={new Date()}
              />
              {formErrors.company_goal_deadline && <div className="validation-error">
                <span data-tip={formErrors.company_goal_deadline}><i className="fas fa-exclamation-circle"></i></span>
                <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
              </div>
              }
            </div>
          </Tile>

          <Tile {...commonTileProps} tileNum={2} title="Budżet">
            <p>Ile wynosi budżet przeznaczony na realizację tego celu?*</p>
            <Range
              min={10000}
              max={100000}
              defaultValue={[20000, 50000]}
              value={[budget.min, budget.max]}
              step={5000}
              onChange={values => {
                setBudget({ min: values[0], max: values[1] });
              }}
              marks={{ 10000: "10 000 zł", 25000: "25 000 zł", 50000: "50 000 zł", 75000: "75 000 zł", 100000: "100 000 zł", }}
              tipFormatter={value => `${value / 1000} 000 zł`}
            />
            <p>lub wpisz ręcznie:</p>
            <div className="formwizard--budget-inputs">
              <input className="inputCustom" type="number" name="budget_min" value={budget.min} onInput={event => setBudget({ min: parseInt(event.target.value), max: budget.max })} onBlur={() => budget.min > budget.max ? setBudget({ min: budget.max, max: budget.min }) : null} /> -
              <input className="inputCustom" type="number" name="budget_max" value={budget.max} onInput={event => setBudget({ min: budget.min, max: parseInt(event.target.value) })} onBlur={() => budget.min > budget.max ? setBudget({ min: budget.max, max: budget.min }) : null} /> zł
            </div>
          </Tile>

          <Tile {...commonTileProps} tileNum={3} validate={["why_us"]} title="Dlaczego my?">
            <div className="floating-label-group">
              <textarea className="inputCustom" name="why_us" id="formwizard-why_us" enterKeyHint="enter" placeholder="Dlaczego my?"></textarea>
              <label className="floating-label" htmlFor="formwizard-why_us">Dlaczego wybrałeś/aś nas?*</label>
              {formErrors.why_us && <div className="validation-error">
                <span data-tip={formErrors.why_us}><i className="fas fa-exclamation-circle"></i></span>
                <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
              </div>}
            </div>
          </Tile>

          <Tile {...commonTileProps} tileNum={4} validate={["name", "company_name"]} title="Dane osobowe">
            <div className="floating-label-group">
              <input className="inputCustom" type="text" name="name" id="formwizard-name" placeholder="Imię i nazwisko" autoComplete="name" enterKeyHint="next" />
              <label htmlFor="formwizard-name" className="floating-label">Imię i nazwisko*</label>
              {formErrors.name && <div className="validation-error">
                <span data-tip={formErrors.name}><i className="fas fa-exclamation-circle"></i></span>
                <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
              </div>}
            </div>
            <div className="floating-label-group">
              <input className="inputCustom" type="text" name="company_name" id="formwizard-company_name" placeholder="Nazwa firmy" autoComplete="organization" enterKeyHint="next" />
              <label htmlFor="formwizard-company_name" className="floating-label">Nazwa firmy*</label>
              {formErrors.company_name && <div className="validation-error">
                <span data-tip={formErrors.company_name}><i className="fas fa-exclamation-circle"></i></span>
                <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
              </div>}
            </div>
            <div className="floating-label-group">
              <input className="inputCustom" type="text" name="company_job_title" id="formwizard-company_job_title" placeholder="Stanowisko" autoComplete="organization-title" enterKeyHint="next" />
              <label htmlFor="formwizard-company_job_title" className="floating-label">Stanowisko</label>
            </div>
          </Tile>

          <Tile {...commonTileProps} tileNum={5} validate={["email"]} title="Dane kontaktowe">
            <div className="floating-label-group">
              <input className="inputCustom" type="email" name="email" id="formwizard-email" placeholder="Adres e-mail" autoComplete="email" enterKeyHint="next" />
              <label className="floating-label" htmlFor="formwizard-email">Adres e-mail*</label>
              {formErrors.email && <div className="validation-error">
                <span data-tip={formErrors.email}><i className="fas fa-exclamation-circle"></i></span>
                <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
              </div>}
            </div>
            <div className="floating-label-group">
              <input className="inputCustom" type="text" name="phone" id="formwizard-phone" placeholder="Numer telefonu" autoComplete="tel" enterKeyHint="next" />
              <label className="floating-label" htmlFor="formwizard-phone">Numer telefonu</label>
            </div>
          </Tile>

          <Tile {...commonTileProps} tileNum={6} title="Dodatkowe informacje">
            <div className="floating-label-group">
              <textarea className="inputCustom" name="extra_info" id="formwizard-extra_info" enterKeyHint="enter" placeholder="Dodatkowe informacje"></textarea>
              <label className="floating-label" htmlFor="formwizard-extra_info">Dodaktowe informacje:</label>
            </div>
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

          <Tile {...commonTileProps} tileNum={7} showSubmit={true} hideNext={true} formStatus={formStatus} title="Przegląd danych">
            <FormSummary {...commonTileProps} formEl={formEl.current} tileCount={8} additionalFields={{ attachment, companyGoalDeadline, topic }} />
            {formStatus === "error" && <p>Błąd podczas wysyłania formularza. Spróbuj ponownie później.</p>}
            <div className={`circle-loader-container ${formStatus === "waiting" || formStatus === "success" ? "show" : ""}`}>
              <div className={`circle-loader ${formStatus === "success" ? "success" : ""}`}>
                <div className="status draw"></div>
              </div>
            </div>
          </Tile>

        </form>

        <div className={`formwizard--success ${formStatus === "success" ? "show" : ""}`}>
          <h2><i className="fas fa-check"></i> Sukces!</h2>
          <p><strong>Otrzymaliśmy Twoje zgłoszenie i wkrótce się z Tobą skontaktujemy.<br />Dziękujemy!</strong></p>
          <p>Wysłaliśmy na podany adres e-mail<br />potwierdzenie razem z kopią wprowadzonych danych.</p>
        </div>
      </div>
    </div>
  )
}

export default FormWizard;
