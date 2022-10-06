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

// const speedMin = -0.15;
// const speedMax = 0.15;

// const dotsNb = Math.floor(map_range(canvas.width, 320, 2560, 15, 135));

// class Dot {
//     constructor() {
//         this.x = Math.random() * canvas.width;
//         this.y = Math.random() * canvas.height;
//         this.radius = 1;
//         this.color = "rgb(26, 188, 156)";
//         this.velocity = { x: (Math.random() * (speedMax - speedMin) + speedMin), y: (Math.random() * (speedMax - speedMin) + speedMin) };
//     }

//     draw() {
//         ctx.beginPath();
//         ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
//         ctx.fillStyle = this.color;
//         ctx.fill();
//     }

//     update() {
//         this.draw();
//         this.x += this.velocity.x;
//         this.y += this.velocity.y;
//     }

//     checkEdges() {
//         if (this.x < 0 || this.x > canvas.width) this.velocity.x *= -1;
//         if (this.y < 0 || this.y > canvas.height) this.velocity.y *= -1;
//     }
// }

// let dots = [];
// for (let i = 0; i < dotsNb; i++) {
//     dots.push(new Dot());
// }

// function drawLines() {
//     for (let i = 0; i < dots.length; i++) {
//         for (let j = 0; j < dots.length; j++) {
//             const dist = Math.hypot(dots[j].x - dots[i].x, dots[j].y - dots[i].y);
//             if (dist < 175) {
//                 ctx.beginPath();
//                 ctx.moveTo(dots[i].x, dots[i].y);
//                 ctx.lineTo(dots[j].x, dots[j].y);
//                 ctx.strokeStyle = "white";
//                 ctx.stroke();
//             }
//         }
//     }
// }

// function animate() {
//     requestAnimationFrame(animate);
//     ctx.clearRect(0, 0, canvas.width, canvas.height);
//     ctx.rect(0, 0, canvas.width, canvas.height);
//     ctx.fillStyle = "rgb(26, 188, 156)";
//     ctx.fill();

//     dots.forEach((dot) => {
//         dot.draw();
//         dot.update();
//         dot.checkEdges();
//     });

//     drawLines();
// }

// animate();

// function map_range(value, low1, high1, low2, high2) {
//     return low2 + (high2 - low2) * (value - low1) / (high1 - low1);
// }

const canvas = document.querySelector("canvas"), ctx = canvas.getContext("2d"); function fitToContainer(t) { t.style.width = "100%", t.style.height = "100%", t.width = t.offsetWidth, t.height = t.offsetHeight } fitToContainer(canvas); const speedMin = -.15, speedMax = .15, dotsNb = Math.floor(map_range(canvas.width, 320, 2560, 15, 135)); class Dot { constructor() { this.x = Math.random() * canvas.width, this.y = Math.random() * canvas.height, this.radius = 1, this.color = "rgb(26, 188, 156)", this.velocity = { x: .3 * Math.random() - .15, y: .3 * Math.random() - .15 } } draw() { ctx.beginPath(), ctx.arc(this.x, this.y, this.radius, 0, 2 * Math.PI), ctx.fillStyle = this.color, ctx.fill() } update() { this.draw(), this.x += this.velocity.x, this.y += this.velocity.y } checkEdges() { (this.x < 0 || this.x > canvas.width) && (this.velocity.x *= -1), (this.y < 0 || this.y > canvas.height) && (this.velocity.y *= -1) } } let dots = []; for (let t = 0; t < dotsNb; t++)dots.push(new Dot); function drawLines() { for (let t = 0; t < dots.length; t++)for (let s = 0; s < dots.length; s++) { Math.hypot(dots[s].x - dots[t].x, dots[s].y - dots[t].y) < 175 && (ctx.beginPath(), ctx.moveTo(dots[t].x, dots[t].y), ctx.lineTo(dots[s].x, dots[s].y), ctx.strokeStyle = "white", ctx.stroke()) } } function animate() { requestAnimationFrame(animate), ctx.clearRect(0, 0, canvas.width, canvas.height), ctx.rect(0, 0, canvas.width, canvas.height), ctx.fillStyle = "rgb(26, 188, 156)", ctx.fill(), dots.forEach((t => { t.draw(), t.update(), t.checkEdges() })), drawLines() } function map_range(t, s, a, i, e) { return i + (e - i) * (t - s) / (a - s) } animate();