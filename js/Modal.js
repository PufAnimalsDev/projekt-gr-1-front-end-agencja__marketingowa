import React, { useEffect, useState, useRef } from "react";

const Modal = ({children, isOpen, setIsOpen}) => {
  return (
    <div className={`newsletter--modal ${isOpen ? "open" : ""}`}>
      <div className="newsletter--modal-container">
        <div className="newsletter--modal-close" onClick={() => setIsOpen(false)}>X</div>
        {children}
      </div>
    </div>
  )
}

export default Modal;