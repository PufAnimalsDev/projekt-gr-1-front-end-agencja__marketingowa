import React from "react";

const Timeline = ({ currentTile, formComplete }) => {
    let nodeTitles = [
        "Wstęp",
        "Imię i nazwisko",
        "Nazwa firmy",
        "Adres e-mail",
        "Numer telefonu",
        "Z czym możemy Ci pomóc?",
        "Cel Twojej firmy",
        "Termin osiągnięcia celu",
        "Załącznik",
        "Dlaczego my?",
        "Pomoc w podjęciu decyzji",
        "Dodatkowe informacje",
        "Przejrzyj dane"
    ]

    function getNodeClass(index) {
        if (index < currentTile || formComplete) {
            return "done";
        } else if (index == currentTile) {
            return "current";
        } else { // index > currentTile
            return "";
        }
    }

    const distanceBetweenNodes = 100 / nodeTitles.length;

    return (
        <div className="timeline">
            <div className="timeline--line" style={{ left: `${distanceBetweenNodes / 2}%`, width: `${distanceBetweenNodes * currentTile}%` }}></div>
            {nodeTitles.map((item, index) => (
                <div className="timeline--item" key={index}>
                    <div className="timeline--title">
                        {item}
                    </div>
                    <div className={`timeline--node ${getNodeClass(index)}`}>
                        {index + 1}
                    </div>
                </div>
            ))}
        </div>
    );
}

export default Timeline;