function hangman(lives) {
  const canvas = document.getElementById('canvas');
  ctx = canvas.getContext('2d');

  gallows(ctx);
  if (lives <= 5) head(ctx);
  if (lives <= 4) body(ctx);
  if (lives <= 3) leftArm(ctx);
  if (lives <= 2) rightArm(ctx);
  if (lives <= 1) leftLeg(ctx);
  if (lives <= 0) rightLeg(ctx);

  stroke(ctx);
}

function gallows(ctx) {
  ctx.beginPath();
  ctx.moveTo(100, 250);
  ctx.lineTo(100, 50);
  ctx.lineTo(250, 50);
  ctx.lineTo(250, 75);
  ctx.moveTo(100, 100);
  ctx.lineTo(150, 50);
  ctx.moveTO(50, 250);
  ctx.lineTo(300, 250);
}

function head(ctx) {
  ctx.moveTo(275, 100);
  ctx.arc(250, 100, 25, 0, 2 * Math.PI);
}

function body(ctx) {
  ctx.moveTo(250, 125);
  ctx.lineTo(250, 175);
}

function leftArm(ctx) {
  ctx.moveTo(250, 125);
  ctx.lineTo(220, 150);
}

function rightArm(ctx) {
  ctx.moveTo(250, 125);
  ctx.lineTo(280, 150);
}

function leftLeg(ctx) {
  ctx.moveTo(250, 175);
  ctx.lineTo(220, 200);
}

function rightLeg(ctx) {
  ctx.moveTo(250, 175);
  ctx.lineTo(280, 200);
}

function stroke(ctx) {
  ctx.strokeStyle = 'black';
  ctx.lineWidth = 3;
  ctx.stroke();
}