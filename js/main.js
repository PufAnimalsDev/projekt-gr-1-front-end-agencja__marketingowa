import "../scss/main.scss";

import React from "react";
import ReactDOM from "react-dom";
import FormWizard from "./FormWizard";
import Newsletter from "./Newsletter"

window.addEventListener("load", () => {
    ReactDOM.render(<FormWizard />, document.getElementById("formwizard"));
    ReactDOM.render(<Newsletter />, document.getElementById("newsletter"));
})