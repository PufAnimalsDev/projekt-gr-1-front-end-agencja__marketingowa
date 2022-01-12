import React, { useEffect, useState, useRef } from "react";

const Tile = ({ children, currentTile, setCurrentTile, tileNum, replaceNextWithSubmit, validationFunction, validate, formStatus }) => {

  const FOCUSABLE_ELEMENTS_QUERY = 'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input:not([disabled]), select:not([disabled])';

  let [currentClass, setCurrentClass] = useState("active");
  let [zIndex, setZIndex] = useState(null);
  let tileElement = useRef(null);
  let firstRender = useRef(true);

  useEffect(() => {
    if (currentTile - 1 > tileNum) {
      setCurrentClass("done");
      setZIndex(0);
    } else if (currentTile > tileNum) {
      setCurrentClass("donelast");
      setZIndex(0);
    } else if (currentTile == tileNum) {
      setCurrentClass("active");
      setZIndex(100);
      if (!firstRender.current) {
        tileElement.current.querySelector(FOCUSABLE_ELEMENTS_QUERY).focus({ preventScroll: true });
      }
    } else if (currentTile + 1 == tileNum) {
      setCurrentClass("next");
      setZIndex(99);
    } else { // currentTile + 1 > tileNum
      setCurrentClass("upcoming");
      setZIndex(100 - Math.abs(currentTile - tileNum));
    }
    firstRender.current = false;
  }, [currentTile]);

  useEffect(() => {
    // Prevent focusable elements from being focused if tile is not currently active

    let focusableElements = tileElement.current.querySelectorAll(FOCUSABLE_ELEMENTS_QUERY);
    if (currentClass === "active") {
      focusableElements.forEach(el => {
        el.tabIndex = 0;
      })
    } else {
      focusableElements.forEach(el => {
        el.tabIndex = -1;
      })
    }
  }, [currentClass])

  useEffect(() => {
    // Prevent elements inside tile from being focusable if waiting for form response or if submission was successful

    let focusableElements = tileElement.current.querySelectorAll(FOCUSABLE_ELEMENTS_QUERY);
    if (formStatus === "waiting" || formStatus === "success") {
      focusableElements.forEach(el => {
        el.tabIndex = -1;
      });
      // if (formStatus === "waiting") {
      //   document.activeElement.blur();
      // }
    } else {
      focusableElements.forEach(el => {
        el.tabIndex = 0;
      });
    }
  }, [formStatus])

  useEffect(() => {
    // Prevent Enter key from sending form early when used on text, email and tel inputs
    // Instead, move to the next step of the form

    tileElement.current.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"]').forEach(el => {
      el.addEventListener("keydown", function (event) {
        if (event.keyCode == 13 || event.which == 13) { // Enter key
          event.preventDefault();
          moveNextTile();
          return false;
        }
      })
    })
  }, [])

  function moveNextTile() {
    if (validationFunction) {
      let validationResult = validationFunction(validate);
      if (validationResult.status) {
        setCurrentTile(tileNum + 1);
      } else {
        alert(`Validation failed for ${validate}. Reason: ${validationResult.error}`);
      }
    } else {
      setCurrentTile(tileNum + 1);
    }
  }

  return (
    <div className={`formwizard--tile ${currentClass}`} style={{ zIndex: zIndex }} ref={tileElement}>
      <div className="formwizard--tile-border">
        <div className="overlay"></div>
        {children}
        {tileNum != 0 ? (
          <button type="button" className="btn btn-secondary" onClick={() => setCurrentTile(tileNum - 1)}>Prev</button>
        ) : (null)}
        {replaceNextWithSubmit ? (
          <button type="submit" className="btn btn-success">Wyślij</button>
        ) : (
          <button type="button" className="btn btn-primary" onClick={moveNextTile}>Next</button>
        )}
      </div>
    </div>
  )
};

export default Tile;