import React from "react";

const Timeline = ({ currentTile, formComplete, tileCount }) => {
    function getNodeClass(index) {
        if (index < currentTile || formComplete) {
            return "done";
        } else if (index == currentTile) {
            return "current";
        } else { // index > currentTile
            return "";
        }
    }

    function renderNodes() {
        let nodeArray = [];
        for (let i=0; i < tileCount; i++) {
            nodeArray.push((
                <div className={`timeline--node ${getNodeClass(i)}`} key={i}>
                    {i + 1}
                </div>
            ))
        }
        return nodeArray;
    }

    const distanceBetweenNodes = 100 / tileCount;

    return (
        <div className="timeline">
            <div className="timeline--line" style={{ left: `${distanceBetweenNodes / 2}%`, width: `${distanceBetweenNodes * currentTile}%` }}></div>
            <div className="timeline--line-shadow" style={{ left: `${distanceBetweenNodes / 2}%`, width: `${distanceBetweenNodes * (tileCount - 1)}%` }}></div>
            {renderNodes().map(item => item)}
        </div>
    );
}

export default Timeline;