// const canvas = document.querySelector("canvas");
// const ctx = canvas.getContext("2d");

// fitToContainer(canvas);

// function fitToContainer(canvas) {
//     // Make it visually fill the positioned parent
//     canvas.style.width = "100%";
//     canvas.style.height = "100%";
//     // ...then set the internal size to match
//     canvas.width = canvas.offsetWidth;
//     canvas.height = canvas.offsetHeight;
// }

// const velocityMin = -0.075;
// const velocityMax = 0.075;

// class Dot {
//     constructor() {
//         this.x = Math.random() * canvas.width;
//         this.y = Math.random() * canvas.height;
//         this.velocity = { x: (Math.random() * (velocityMax - velocityMin) + velocityMin), y: (Math.random() * (velocityMax - velocityMin) + velocityMin) };
//     }

//     update() {
//         this.x += this.velocity.x;
//         this.y += this.velocity.y;
//     }

//     checkEdges() {
//         if (this.x < 0 || this.x > canvas.width) this.velocity.x *= -1;
//         if (this.y < 0 || this.y > canvas.height) this.velocity.y *= -1;
//     }
// }

// const dotsNb = Math.floor(map_range(canvas.width, 320, 2560, 20, 115));

// let dots = [];
// for (let i = 0; i < dotsNb; i++) {
//     dots.push(new Dot());
// }

// const maxLinkSize = map_range(canvas.width, 320, 2560, 125, 200);

// function drawLines() {
//     for (let i = 0; i < dots.length; i++) {
//         for (let j = 0; j < dots.length; j++) {
//             const dist = Math.hypot(dots[j].x - dots[i].x, dots[j].y - dots[i].y);
//             if (dist < maxLinkSize) {
//                 ctx.beginPath();
//                 ctx.moveTo(dots[i].x, dots[i].y);
//                 ctx.lineTo(dots[j].x, dots[j].y);
//                 ctx.strokeStyle = "white";
//                 ctx.stroke();
//             }
//         }
//     }
// }

// function map_range(value, low1, high1, low2, high2) {
//     return low2 + (high2 - low2) * (value - low1) / (high1 - low1);
// }

// function animate() {
//     requestAnimationFrame(animate);
//     ctx.clearRect(0, 0, canvas.width, canvas.height);
//     ctx.rect(0, 0, canvas.width, canvas.height);
//     ctx.fillStyle = "rgb(26, 188, 156)";
//     ctx.fill();

//     dots.forEach((dot) => {
//         dot.update();
//         dot.checkEdges();

//     });

//     drawLines();
// }
// animate();

///////////////////////////////////////////////////////////////////////////
// Minified
const canvas = document.querySelector("canvas"), ctx = canvas.getContext("2d"); function fitToContainer(t) { t.style.width = "100%", t.style.height = "100%", t.width = t.offsetWidth, t.height = t.offsetHeight } fitToContainer(canvas); const velocityMin = -.075, velocityMax = .075; class Dot { constructor() { this.x = Math.random() * canvas.width, this.y = Math.random() * canvas.height, this.velocity = { x: .15 * Math.random() - .075, y: .15 * Math.random() - .075 } } update() { this.x += this.velocity.x, this.y += this.velocity.y } checkEdges() { (this.x < 0 || this.x > canvas.width) && (this.velocity.x *= -1), (this.y < 0 || this.y > canvas.height) && (this.velocity.y *= -1) } } const dotsNb = Math.floor(map_range(canvas.width, 320, 2560, 20, 115)); let dots = []; for (let t = 0; t < dotsNb; t++)dots.push(new Dot); const maxLinkSize = map_range(canvas.width, 320, 2560, 125, 200); function drawLines() { for (let t = 0; t < dots.length; t++)for (let a = 0; a < dots.length; a++) { Math.hypot(dots[a].x - dots[t].x, dots[a].y - dots[t].y) < maxLinkSize && (ctx.beginPath(), ctx.moveTo(dots[t].x, dots[t].y), ctx.lineTo(dots[a].x, dots[a].y), ctx.strokeStyle = "white", ctx.stroke()) } } function map_range(t, a, e, i, s) { return i + (s - i) * (t - a) / (e - a) } function animate() { requestAnimationFrame(animate), ctx.clearRect(0, 0, canvas.width, canvas.height), ctx.rect(0, 0, canvas.width, canvas.height), ctx.fillStyle = "rgb(26, 188, 156)", ctx.fill(), dots.forEach((t => { t.update(), t.checkEdges() })), drawLines() } animate();