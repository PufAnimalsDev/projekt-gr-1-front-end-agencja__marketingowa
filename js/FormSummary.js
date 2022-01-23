import React, { useEffect, useState, useRef } from "react";

const FormSummary = ({ currentTile, setCurrentTile, setFromSummary, tileCount, formEl, additionalFields }) => {
  let [formValues, setFormValues] = useState({});

  function summaryTileSwitch(tile, fieldName) {
    setCurrentTile(tile);
    setFromSummary(true);
    if (fieldName && formEl.querySelector(fieldName)) {
      formEl.querySelector(fieldName).focus();
    }
  }


  useEffect(() => {
    if (currentTile >= tileCount - 2) {
      let formObj = {};
      let formData = new FormData(formEl);

      formObj.topic = additionalFields.topic;

      formObj.company_goal = formData.get("company_goal");
      formObj.company_goal_deadline = additionalFields.companyGoalDeadline.toLocaleDateString("pl-PL", { weekday: "long", year: "numeric", month: "long", day: "numeric" });

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
        formObj.extra_info = "*nie podano*"
      }
      if (additionalFields.attachment) {
        formObj.file = `${additionalFields.attachment.name} (${(additionalFields.attachment.size / 1024 / 1024).toFixed(2)} MB)`;
      } else {
        formObj.file = "*nie załączono*";
      }

      setFormValues(formObj);
    }
  }, [currentTile, additionalFields])
  return (
    <div>
      {formValues != null ? (
        <div className="formwizard--summary-container">
          <div onClick={() => summaryTileSwitch(0, "[name=topic]")}>
            <div className="formwizard--summary-title">Z czym możemy Ci pomóc:</div>
            {formValues.topic}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(1, "[name=company_goal]")}>
            <div className="formwizard--summary-title">Jaki jest cel Twojej firmy:</div>
            {formValues.company_goal}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(1, ".react-datepicker__day:not(.react-datepicker__day--disabled)")}>
            <div className="formwizard--summary-title">Do kiedy Twoja firma chce go osiągnąć:</div>
            {formValues.company_goal_deadline}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(2, ".rc-slider-handle")}>
            <div className="formwizard--summary-title">Budżet:</div>
            {formValues.budget}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(3, "[name=why_us]")}>
            <div className="formwizard--summary-title">Dlaczego wybrałeś/aś nas?</div>
            {formValues.why_us}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(4, "[name=name]")}>
            <div className="formwizard--summary-title">Imię i nazwisko:</div>
            {formValues.name}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(4, "[name=company_name]")}>
            <div className="formwizard--summary-title">Nazwa firmy:</div>
            {formValues.company_name}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(4, "[name=company_job_title]")}>
            <div className="formwizard--summary-title">Stanowisko:</div>
            {formValues.company_job_title}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(5, "[name=email]")}>
            <div className="formwizard--summary-title">Adres e-mail:</div>
            {formValues.email}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(5, "[name=phone]")}>
            <div className="formwizard--summary-title">Numer telefonu:</div>
            {formValues.phone}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(6, "[name=extra_info]")}>
            <div className="formwizard--summary-title">Dodatkowe informacje:</div>
            {formValues.extra_info}
          </div>
          <hr />
          <div onClick={() => summaryTileSwitch(6, ".dropzone")}>
            <div className="formwizard--summary-title">Załącznik:</div>
            {formValues.file}
          </div>
        </div>
      ) : ""}
    </div>
  )
}

export default FormSummary;