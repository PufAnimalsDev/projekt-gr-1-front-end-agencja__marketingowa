import React from "react";

const Modal = ({children, isOpen, setIsOpen}) => {
  return (
    <div className={`newsletter--modal ${isOpen ? "open" : ""}`}>
      <div className="newsletter--modal-container">
        <button type="button" className="newsletter--modal-close" onClick={() => setIsOpen(false)}>
          <i className="fas fa-2x fa-times"></i>
        </button>
        {children}
      </div>
    </div>
  )
}

export default Modal;