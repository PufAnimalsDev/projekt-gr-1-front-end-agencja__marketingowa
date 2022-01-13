import React from "react";

const Timeline = ({ currentTile, formComplete }) => {
    let nodeTitles = [
        "Z czym możemy Ci pomóc?",
        "Cel Twojej firmy",
        "Budżet",
        "Dlaczego my?",
        "Pomoc w podjęciu decyzji",
        "Dane osobiste",
        "Dane kontaktowe",
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