import React, { useState } from "react";
import { useDropzone } from 'react-dropzone';

const FormCareer = () => {
    let [formStatus, setFormStatus] = useState("unsent");

    let [cv, setCv] = useState(null);
    let [extraFile, setExtraFile] = useState(null);

    async function formSubmitHandler(event) {
        event.preventDefault();

        setFormStatus("waiting");

        let response = await fetch(`${page.api_url}workon/formcareer`, {
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
        <form className="career-form-container" onSubmit={formSubmitHandler}>
            <input type="text" name="first_name" id="career-form-first-name" placeholder="Imię" autoComplete="given-name" enterKeyHint="next" />
            <input type="text" name="last_name" id="career-form-last-name" placeholder="Nazwisko" autoComplete="family-name" enterKeyHint="next" />
            <input type="text" name="email" id="career-form-email" placeholder="Adres e-mail" autoComplete="email" enterKeyHint="next" />
            <input type="text" name="phone" id="career-form-phone" placeholder="Numer telefonu" autoComplete="tel" enterKeyHint="next" />
            <textarea name="salary" id="career-form-salary" enterKeyHint="enter" ></textarea>
            <textarea name="join_reason" id="career-form-join_reason" enterKeyHint="enter" ></textarea>
            <textarea name="extra_questions" id="career-form-extra_questions" enterKeyHint="enter" ></textarea>
            <input type="file" name="cv" id="career-form-cv" />
            <input type="file" name="extra_file" id="career-form-extra_file" />
            <div className="checkbox-field-container">
                <div className="checkbox-check-container">
                    <input type="checkbox" name="gdpr_agreement" id="career-form-gdpr_agreement" />
                </div>
                <div className="checkbox-label-container">
                    <label htmlFor="career-form-gdpr_agreement">Wyrażam zgodę na to i to</label>
                </div>
            </div>
            <button type="submit">Wyślij</button>
        </form>
    )
};

export default FormCareer;