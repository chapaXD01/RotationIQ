

    const players = document.querySelectorAll('.player');
const court = document.getElementById('court');

players.forEach(player => {
    let offsetX = 0;
    let offsetY = 0;

    player.addEventListener('mousedown', e => {
        offsetX = e.offsetX;
        offsetY = e.offsetY;

        function move(e) {
            const rect = court.getBoundingClientRect();

            let x = e.clientX - rect.left - offsetX;
            let y = e.clientY - rect.top - offsetY;

            
            x = Math.max(0, Math.min(x, court.clientWidth - player.clientWidth));
            y = Math.max(0, Math.min(y, court.clientHeight - player.clientHeight));

            player.style.left = x + 'px';
            player.style.top = y + 'px';
        }

        document.addEventListener('mousemove', move);

        document.addEventListener('mouseup', () => {
            document.removeEventListener('mousemove', move);
        }, { once: true });
    });
});

function getPlayers() {
    const data = {};

    document.querySelectorAll('.player').forEach(p => {
        const pos = p.dataset.pos;

        data[pos] = {
            top: parseFloat(p.style.top),
            left: parseFloat(p.style.left),
            el: p
        };
    });

    return data;
}


function checkRotationWithVisuals() {
    const players = getPlayers();
    const svg = document.getElementById("lines");
    svg.innerHTML = ""; // clear old lines

    let errors = [];

    // ❌ Rule: P1 behind P2
    if (players[1].top < players[2].top) {
        errors.push("Player 1 is in front of Player 2");

        drawHorizontalFaultLine(players[2], "front");
    }

    // ❌ Rule: P6 behind P3
    if (players[6].top < players[3].top) {
        errors.push("Player 6 is in front of Player 3");
        drawHorizontalFaultLine(players[3], "front");
    }

    // ❌ Rule: P5 behind P4
    if (players[5].top < players[4].top) {
        errors.push("Player 5 is in front of Player 4");
        drawHorizontalFaultLine(players[4], "front");
    }

    // LEFT / RIGHT checks
    if (players[6].left > players[1].left) {
        errors.push("Player 6 is right of Player 1");
        drawVerticalFaultLine(players[1], "right");
    }

    if (players[5].left > players[6].left) {
        errors.push("Player 5 is right of Player 6");
        drawVerticalFaultLine(players[6], "right");
    }

    showErrors(errors);
}

function drawHorizontalFaultLine(player, side) {
    const svg = document.getElementById("lines");
    const y = side === "front"
        ? player.top - 5
        : player.top + 50;

    const line = document.createElementNS("http://www.w3.org/2000/svg", "line");

    line.setAttribute("x1", 0);
    line.setAttribute("x2", 500);
    line.setAttribute("y1", y);
    line.setAttribute("y2", y);
    line.setAttribute("stroke", "red");
    line.setAttribute("stroke-width", "4");

    svg.appendChild(line);
}

function drawVerticalFaultLine(player, side) {
    const svg = document.getElementById("lines");
    const x = side === "right"
        ? player.left + 50
        : player.left - 5;

    const line = document.createElementNS("http://www.w3.org/2000/svg", "line");

    line.setAttribute("y1", 0);
    line.setAttribute("y2", 400);
    line.setAttribute("x1", x);
    line.setAttribute("x2", x);
    line.setAttribute("stroke", "red");
    line.setAttribute("stroke-width", "4");

    svg.appendChild(line);
}

function showErrors(errors) {
    if (errors.length === 0) {
        alert("in rotation");
    } else {
        alert("out of rotation:\n\n" + errors.join("\n"));
    }
}

function getCenter(player) {
    return {
        x: player.left + 22.5,
        y: player.top + 22.5
    };
}


/* rotate */

// Temporary save + redirect back to welcome page
function saveRotation() {
    const typeSelect = document.getElementById('rotationType');
    const nameInput = document.getElementById('rotation-name');

    const type = typeSelect ? typeSelect.value : '';
    const name = nameInput ? nameInput.value : '';

    // You can replace this with a real POST to the server later
    alert('Rotation "' + (name || 'unnamed') + '" (' + (type || 'no type') + ') saved.');    // Go back to the welcome page
    window.location.href = '/';
}

const zoneCenters = {
    1: { top: 278, left: 395 },
    2: { top: 78,  left: 395 },
    3: { top: 78,  left: 228 },
    4: { top: 78,  left: 61  },
    5: { top: 278, left: 61  },
    6: { top: 278, left: 228 }
};

function rotateClockwise() {

    const rotationMap = {
        1: 6,
        6: 5,
        5: 4,
        4: 3,
        3: 2,
        2: 1
    };

    const players = document.querySelectorAll('.player');

    players.forEach(player => {

        const currentPos = parseInt(player.dataset.pos);
        const newPos = rotationMap[currentPos];

        player.dataset.pos = newPos;

        player.style.top = zoneCenters[newPos].top + "px";
        player.style.left = zoneCenters[newPos].left + "px";
    });

    handleLiberoSub();

    document.getElementById("lines").innerHTML = "";
}

