// I'm using this dx, dy method with keypress and keyrelease because it makes switching between keys a lot smoother 
var dx,dy,x,y;
const moveSpeed = 2;
function setup() {
  createCanvas(400, 400);
  x = 200;
  y = 200;
  dx = 0;
  dy = 0;
}

function draw() {
  x += dx;
  y += dy;
  ellipse(x, y, 30, 30);
}
function keyPressed() {
  switch (key) {
    case 'a':
      dx = -moveSpeed;
      break;
    case 'd':
      dx = moveSpeed;
      break;
      case 's':
      dy = moveSpeed;
      break;
      case 'w':
      dy = -moveSpeed;
      break;
  }
}

function keyReleased() {
  switch (key) {
  case 'a':
      if (dx == -moveSpeed)
      dx = 0;
      break;
    case 'd':
      if (dx == moveSpeed)
      dx = 0;
      break;
      case 's':
      if (dy == moveSpeed)
      dy = 0;
      break;
      case 'w':
      if (dy == -moveSpeed)
      dy = 0;
      break;
  }
}
