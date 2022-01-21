import React, { useEffect, useRef } from "react";

const FOCUSABLE_FORM_ELEMENTS_QUERY = 'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled]), .rc-slider-handle, .react-datepicker__day, .dropzone';

const Modal = ({children, isOpen, setIsOpen}) => {
  let modalRef = useRef(null);

  useEffect(() => {
    let focusableElements = modalRef.current.querySelectorAll(FOCUSABLE_FORM_ELEMENTS_QUERY);
    let firstFocusable = focusableElements[0];
    let lastFocusable = focusableElements[focusableElements.length - 1];

    modalRef.current.addEventListener("keydown", event => {
      if (event.key === 'Tab' || event.keyCode === 9) {
        if ( event.shiftKey ) { // Shift + Tab
          if (document.activeElement === firstFocusable || firstFocusable.disabled) {
            lastFocusable.focus();
            event.preventDefault();
          }
        } else { // Tab
          if (document.activeElement === lastFocusable) {
            firstFocusable.focus();
            event.preventDefault();
          }
        }
      }
    })
  }, [])

  return (
    <div className={`newsletter--modal ${isOpen ? "open" : ""}`} ref={modalRef}>
      <div className="newsletter--modal-container">
        {children}
        <button type="button" className="newsletter--modal-close" onClick={() => setIsOpen(false)}>
          <i className="fas fa-2x fa-times"></i>
        </button>
      </div>
    </div>
  )
}

export default Modal;