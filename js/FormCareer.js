import React, { useEffect, useRef, useState } from "react";
import { useDropzone } from 'react-dropzone';
import ReactTooltip from "react-tooltip";
import { useForm, Controller } from "react-hook-form";

const errorMessages = {
    required: "To pole jest obowiązkowe",
    validate: "Adres e-mail jest niewłaściwy",
    maxLength: "Za długi tekst"
}

const FOCUSABLE_FORM_ELEMENTS_QUERY = 'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), .rc-slider-handle, .react-datepicker__day, .dropzone';
const VALID_EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

const FormCareer = () => {

    let formEl = useRef(null);

    let [formStatus, setFormStatus] = useState({status: "unsent"});
    let [cv, setCv] = useState(null);
    let [extraFile, setExtraFile] = useState(null);

    const { register, handleSubmit, control, resetField, formState: { errors } } = useForm({ mode: "onTouched" });

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

    async function formSubmitHandler() {

        setFormStatus({status: "waiting"});

        let formData = new FormData(formEl.current);

        formData.append("cv", cv);
        formData.append("extra_file", extraFile);

        let response = await fetch(`${page.api_url}workon/formcareer`, {
            method: 'POST',
            body: formData
        });

        try {
            const result = await response.json();
            if (result.response === "success") {
                setFormStatus({status: "success"});
            } else {
                setFormStatus({status: "error", reason: result.reason})
            }
        } catch {
            setFormStatus({status: "error", reason: "Błąd przy wysyłaniu formularza. Spróbuj ponownie później"})
        }
    }

    useEffect(() => {
        if (formStatus.status === "waiting" || formStatus.status === "success") {
            formEl.current.querySelectorAll(FOCUSABLE_FORM_ELEMENTS_QUERY).forEach(el => {
                el.tabIndex = -1;
            });
        } else {
            formEl.current.querySelectorAll(FOCUSABLE_FORM_ELEMENTS_QUERY).forEach(el => {
                el.tabIndex = 0;
            });
        }
    }, [formStatus])

    return (
        <form className="career-form-container row" onSubmit={handleSubmit(formSubmitHandler)} ref={formEl}>
            <h2>Formularz aplikacyjny</h2>
            <div className="col-12 col-xl-6">
                <div className="floating-label-group">
                    <input type="text" name="name" className="inputCustom" id="career-form-first-name" placeholder="Imię" autoComplete="given-name" enterKeyHint="next" {...register("first_name", { required: true, maxLength: 255 })} />
                    <label className="floating-label" htmlFor="career-form-first-name">Imię*:</label>
                    {errors.first_name && <div className="validation-error">
                        <span data-tip={errorMessages[errors.first_name.type]}><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
            </div>
            <div className="col-12 col-xl-6">
                <div className="floating-label-group">
                    <input type="text" name="career-form-last-name" className="inputCustom" id="career-form-last-name" placeholder="Nazwisko*" autoComplete="family-name" enterKeyHint="next" {...register("last_name", { required: true, maxLength: 255 })} />
                    <label className="floating-label" htmlFor="career-form-last-name">Nazwisko*:</label>
                    {errors.last_name && <div className="validation-error">
                        <span data-tip={errorMessages[errors.last_name.type]}><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
            </div>
            <div className="col-12 col-xl-6">
                <div className="floating-label-group">
                    <input type="text" name="career-form-email" className="inputCustom" id="career-form-email" placeholder="Adres e-mail*" autoComplete="email" enterKeyHint="next" {...register("email", { required: true, validate: value => VALID_EMAIL_REGEX.test(value), maxLength: 255 })} />
                    <label className="floating-label" htmlFor="career-form-email">Adres e-mail*:</label>
                    {errors.email && <div className="validation-error">
                        <span data-tip={errorMessages[errors.email.type]}><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
            </div>
            <div className="col-12 col-xl-6">
                <div className="floating-label-group">
                    <input type="text" name="career_form_email" className="inputCustom" id="career-form-phone" placeholder="Numer telefonu*" autoComplete="tel" enterKeyHint="next" {...register("phone", { required: true })} />
                    <label className="floating-label" htmlFor="career-form-phone">Numer telefonu*:</label>
                    {errors.phone && <div className="validation-error">
                        <span data-tip={errorMessages[errors.phone.type]}><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
            </div>
            <div className="col-12">
                <div className="floating-label-group">
                    <textarea name="form_salary" className="inputCustom" id="career-form-salary" placeholder="Jakich stawek oczekujesz?*" enterKeyHint="enter" {...register("salary", { required: true, maxLength: 5000 })} ></textarea>
                    <label className="floating-label" htmlFor="career-form-salary">Jakich stawek oczekujesz?*</label>
                    {errors.salary && <div className="validation-error">
                        <span data-tip={errorMessages[errors.salary.type]}><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
                <div className="floating-label-group">
                    <textarea name="join_reason" className="inputCustom" id="career-form-join_reason" placeholder="Dlaczego chcesz do nas dołączyć?*" enterKeyHint="enter" {...register("join_reason", { required: true, maxLength: 5000 })} ></textarea>
                    <label className="floating-label" htmlFor="career-form-join_reason">Dlaczego chcesz do nas dołączyć?*</label>
                    {errors.join_reason && <div className="validation-error">
                        <span data-tip={errorMessages[errors.join_reason.type]}><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
                <div className="floating-label-group">
                    <textarea name="extra_questions" className="inputCustom" id="career-form-extra_questions" placeholder="Dodatkowe pytania" enterKeyHint="enter" {...register("extra_questions", { maxLength: 5000 })} ></textarea>
                    <label className="floating-label" htmlFor="career-form-extra_questions">Dodatkowe pytania:</label>
                </div>
            </div>
            <div className="col-12 col-xl-6">
                <label htmlFor="career-form-cv">CV*:</label>
                <Controller
                    name="cv"
                    render={({ field: { onChange } }) => (
                        <div className='dropzone dropzone-colored' {...cvDropzone.getRootProps()}>
                            <input id="career-form-cv" {...cvDropzone.getInputProps({ onChange: e => onChange(e.target.files[0]) })} />
                            {cvDropzone.isDragActive ?
                                <p>Upuść plik tutaj...</p>
                                :
                                <>
                                    <p>Przeciągnij tutaj plik lub kliknij tu, aby go wybrać.</p>
                                    <p>Możesz wybrać tylko 1 plik.</p>
                                </>
                            }
                            {errors.cv && <div className="validation-error">
                                <span data-tip={errorMessages[errors.cv.type]}><i className="fas fa-exclamation-circle"></i></span>
                                <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                            </div>
                            }
                        </div>
                    )}
                    control={control}
                    defaultValue=''
                    rules={{ required: true }}
                />
                {cv ?
                    <>
                        <div className='mb-3'>
                            Załączono plik:<br />
                            <strong>{cv.name}</strong><br />
                            {(cv.size / 1024 / 1024).toFixed(2)} MB <button className="btnOutlineCustom btn-remove-attachment" type="button" onClick={removeCv}><i className="fas fa-fw fa-times"></i></button>
                        </div>
                    </>
                    : ''}
            </div>
            <div className="col-12 col-xl-6">
                <label htmlFor="career-form-extra_file">Dodatkowy załącznik:</label>
                <Controller
                    name="extra_file"
                    render={({ field: { onChange } }) => (
                        <div className='dropzone dropzone-colored' {...extraFileDropzone.getRootProps()}>
                            <input id="career-form-cv" {...extraFileDropzone.getInputProps({ onChange: e => onChange(e.target.files[0]) })} />
                            {extraFileDropzone.isDragActive ?
                                <p>Upuść plik tutaj...</p>
                                :
                                <>
                                    <p>Przeciągnij tutaj plik lub kliknij tu, aby go wybrać.</p>
                                    <p>Możesz wybrać tylko 1 plik.</p>
                                </>
                            }
                        </div>
                    )}
                    control={control}
                    defaultValue=''
                />
                {extraFile ?
                    <>
                        <div className='mb-3'>
                            Załączono plik:<br />
                            <strong>{extraFile.name}</strong><br />
                            {(extraFile.size / 1024 / 1024).toFixed(2)} MB <button className="btnOutlineCustom btn-remove-attachment" type="button" onClick={removeExtraFile}><i className="fas fa-fw fa-times"></i></button>
                        </div>
                    </>
                    : ''}
            </div>
            <div className="col-12">
                <div className="checkbox-wrapper validation-under">
                    <input type="checkbox" id="career-form-agreement1" {...register("agreement1", { required: true })} />
                    <label htmlFor="career-form-agreement1">Zgodnie z ustawą z dnia 18 lipca 2002 roku o świadczeniu usług drogą elektroniczną wyrażam zgodę na kontakt ze mną przez spółkę pod firmą: Peacocko Agency z siedzibą w Warszawie wpisaną do Rejestru Przedsiębiorców Krajowego Rejestru Sądowego, prowadzonego przez Sąd Rejonowy dla m. st. Warszawy w Warszawie, XIII Wydział Gospodarczy Krajowego Rejestru Sądowego pod numerem KRS 00000 („Spóła”) oraz podmioty współpracujące ze Spółką celem wykonania czynności kontaktowych.</label>
                    {errors.agreement1 && <div className="validation-error">
                        <span data-tip="Musisz wyrazić zgodę na kontakt"><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
                <div className="checkbox-wrapper validation-under">
                    <input type="checkbox" id="career-form-agreement2" {...register("agreement2", { required: true })} />
                    <label htmlFor="career-form-agreement2">Zgodnie z art. 6 ust. 1 lit. a) Rozporządzenia Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 roku w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE (ogólne rozporządzenie o ochronie danych) wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb bieżącej oraz przyszłych procesów rekrutacji.</label>
                    {errors.agreement2 && <div className="validation-error">
                        <span data-tip="Musisz wyrazić zgodę na przetwarzanie danych osobowych"><i className="fas fa-exclamation-circle"></i></span>
                        <ReactTooltip backgroundColor="#dc3545" place="left" type="error" effect="solid" />
                    </div>
                    }
                </div>
                <button type="submit" className="btnOutlineCustom">Wyślij</button>
                {formStatus.status === "error" && <p>{formStatus.reason}</p>}
            </div>
            <div className={`circle-loader-container ${formStatus.status === "waiting" || formStatus.status === "success" ? "show" : ""}`}>
                <div className={`circle-loader ${formStatus.status === "success" ? "success" : ""}`}>
                    <div className="status draw"></div>
                </div>
                {formStatus.status === "success" && <p><strong>Dziękujemy za wysłanie aplikacji!</strong><br />Skontaktujemy się z Tobą wkrótce.</p>}
            </div>
        </form>
    )
};

export default FormCareer;