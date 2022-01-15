import React, { useEffect, useState, useRef } from "react";

const FormSummary = ({currentTile, tileCount, formEl, additionalFields}) => {
  let [formValues, setFormValues] = useState({});

  let selectOptions = {
    "op1": "Opcja 1",
    "op2": "Opcja 2",
    "op3": "Opcja 3",
    "op4": "Opcja 4"
  }

  useEffect(() => {
    if (currentTile >= tileCount - 2) {
      let formObj = {};
      let formData = new FormData(formEl);

      formObj.topic = selectOptions[formData.get("topic")];

      formObj.company_goal = formData.get("company_goal");
      formObj.company_goal_deadline = formData.get("company_goal_deadline");

      formObj.budget = `${formData.get("budget_min")} zł - ${formData.get("budget_max")} zł`;

      formObj.why_us = formData.get("why_us");

      formObj.name = formData.get("name");
      formObj.company_name = formData.get("company_name");
      if (formData.get("company_job_title")) {
        formObj.company_job_title = formData.get("company_job_title");
      } else {
        formObj.company_job_title = "*nie podano*"
      }

      formObj.email = formData.get("email");
      if (formData.get("phone")) {
        formObj.phone = formData.get("phone");
      } else {
        formObj.phone = "*nie podano*"
      }
      
      if (formData.get("extra_info")) {
        formObj.extra_info = formData.get("extra_info");
      } else {
        formObj.extra_info = "brak"
      }
      if (additionalFields.attachment) {
        formObj.file = `${additionalFields.attachment.name} (${(additionalFields.attachment.size / 1024 / 1024).toFixed(2)} MB)`;
      } else {
        formObj.file = "nie załączono";
      }

      setFormValues(formObj);
    }
  }, [currentTile, additionalFields])
  return (
    <>
      {formValues != null ? (
        <>
          <div>Z czym możemy Ci pomóc:<br />{formValues.topic}</div>
          <div>Jaki jest cel Twojej firmy:<br />{formValues.company_goal}</div>
          <div>Do kiedy Twoja firma chce go osiągnąć:<br />{formValues.company_goal_deadline}</div>
          <div>Budżet:<br />{formValues.budget}</div>
          <div>Dlaczego wybrałeś/aś nas?<br />{formValues.why_us}</div>
          <div>Imię i nazwisko:<br />{formValues.name}</div>
          <div>Nazwa firmy:<br />{formValues.company_name}</div>
          <div>Stanowisko:<br />{formValues.company_job_title}</div>
          <div>Adres e-mail:<br />{formValues.email}</div>
          <div>Numer telefonu:<br />{formValues.phone}</div>
          <div>Dodatkowe informacje:<br />{formValues.extra_info}</div>
          <div>Załącznik:<br />{formValues.file}</div>
        </>
      ) : ""}
    </>
  )
}

export default FormSummary;