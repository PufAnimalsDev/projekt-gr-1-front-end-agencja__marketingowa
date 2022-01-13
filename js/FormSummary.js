import React, { useEffect, useState, useRef } from "react";

const FormSummary = ({ currentTile, formEl }) => {
  let [formValues, setFormValues] = useState({});

  let selectOptions = {
    "op1": "Opcja 1",
    "op2": "Opcja 2",
    "op3": "Opcja 3",
    "op4": "Opcja 4"
  }

  useEffect(() => {
    if (currentTile >= 11) {
      let formObj = {};
      let formData = new FormData(formEl);

      formObj.name = formData.get("name");
      formObj.company_name = formData.get("company_name");
      formObj.email = formData.get("email");
      if (formData.has("phone")) {
        formObj.phone = formData.get("phone");
      } else {
        formObj.phone = "*nie podano*"
      }
      formObj.topic = selectOptions[formData.get("topic")];
      formObj.company_goal = formData.get("company_goal");
      formObj.company_goal_deadline = formData.get("company_goal_deadline");
      if (formData.get("file").size != 0) {
        formObj.file = `${formData.get("file").name} (${(formData.get("file").size / 1024 / 1024).toFixed(2)} MB)`;
      } else {
        formObj.file = "nie załączono"
      }
      formObj.why_us = formData.get("why_us");
      formObj.decision_help = formData.get("decision_help");
      if (formData.has("extra_info")) {
        formObj.extra_info = formData.get("extra_info");
      } else {
        formObj.extra_info = "brak"
      }

      setFormValues(formObj);
    }
  }, [currentTile])
  return (
    <>
      {formValues != null ? (
        <>
          <p>Imię i nazwisko:<br />{formValues.name}</p>
          <p>Nazwa firmy:<br />{formValues.company_name}</p>
          <p>Adres e-mail:<br />{formValues.email}</p>
          <p>Numer telefonu:<br />{formValues.phone}</p>
          <p>Z czym możemy Ci pomóc:<br />{formValues.topic}</p>
          <p>Jaki jest cel Twojej firmy:<br />{formValues.company_goal}</p>
          <p>Do kiedy Twoja firma chce go osiągnąć:<br />{formValues.company_goal_deadline}</p>
          <p>Załącznik:<br />{formValues.file}</p>
          <p>Dlaczego wybrałeś/aś nas?<br />{formValues.why_us}</p>
          <p>Jak możemy pomóc Ci podjąć decyzję?<br />{formValues.decision_help}</p>
          <p>Dodatkowe informacje:<br />{formValues.extra_info}</p>
        </>
      ) : ""}
    </>
  )
}

export default FormSummary;