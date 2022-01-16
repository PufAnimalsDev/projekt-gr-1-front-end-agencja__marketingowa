import React, { useState } from "react";
import { useDropzone } from 'react-dropzone';

const FormCareer = () => {
    let [formStatus, setFormStatus] = useState("unsent");

    let [cv, setCv] = useState(null);
    let [extraFile, setExtraFile] = useState(null);

    const cvDropzone = useDropzone({ onDrop: onCvDrop, maxFiles: 1, multiple: false });
    const extraFileDropzone = useDropzone({ onDrop: onExtraFileDrop, maxFiles: 1, multiple: false });

    function onCvDrop(file) {
        setCv(file[0]);
    }

    function removeCv() {
        setCv(null);
        cvDropzone.inputRef.current.value = "";
    }

    function onExtraFileDrop(file) {
        setExtraFile(file[0]);
    }

    function removeExtraFile() {
        setExtraFile(null);
        extraFileDropzone.inputRef.current.value = "";
    }

    async function formSubmitHandler(event) {
        event.preventDefault();

        setFormStatus("waiting");

        let formData = new FormData(formEl.current);

        formData.append("file", cv);
        formData.append("file", extraFile);

        let response = await fetch(`${page.api_url}workon/formcareer`, {
            method: 'POST',
            body: formData
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
            <label htmlFor="career-form-cv">CV:</label>
            <div className='dropzone' {...cvDropzone.getRootProps()}>
                <input id="career-form-cv" {...cvDropzone.getInputProps()} />
                {cvDropzone.isDragActive ?
                    <p>Upuść tutaj CV...</p>
                : 
                    <>
                        <p>Przeciągnij tutaj CV lub kliknij tu, aby je wybrać.</p>
                        <p>Możesz załączyć wyłącznie 1 plik.</p>
                    </> 
                }
            </div>
            {cv ? 
                <>
                    <div className='mb-3'>
                        Załączono plik:<br />
                        <strong>{cv.name}</strong> - {(cv.size / 1024 / 1024).toFixed(2)} MB
                    </div>
                    <button type="button" onClick={removeCv}>Usuń plik</button>
                </>
            : ''}
            <label htmlFor="career-form-extra_file">Dodatkowy załącznik:</label>
            <div className='dropzone' {...extraFileDropzone.getRootProps()}>
                <input id="career-form-extra_file" {...extraFileDropzone.getInputProps()} />
                {extraFileDropzone.isDragActive ?
                    <p>Upuść tutaj plik...</p>
                : 
                    <>
                        <p>Przeciągnij tutaj plik lub kliknij tu, aby go wybrać.</p>
                        <p>Możesz załączyć wyłącznie 1 plik.</p>
                    </> 
                }
            </div>
            {extraFile ? 
                <>
                    <div className='mb-3'>
                        Załączono plik:<br />
                        <strong>{extraFile.name}</strong> - {(extraFile.size / 1024 / 1024).toFixed(2)} MB
                    </div>
                    <button type="button" onClick={removeExtraFile}>Usuń plik</button>
                </>
            : ''}
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