let lFollowX = 0;
let lFollowY = 0;
let x = 0;
let y = 0;
const friction = 1 / 30;

function moveBackground(bgMove) {
  x += (lFollowX - x) * friction;
  y += (lFollowY - y) * friction;

  const translate = `translate(${0}px,${y}px) scale(1.1)`;
  bgMove["style"].transform = translate;
  window.requestAnimationFrame(() => moveBackground(bgMove));
}

window.addEventListener("mousemove", function(evt) {
  const min = -200;
  const getMax = clientMove => Math.min(100, 200 / 2 - clientMove);

  const lMouseX = Math.max(min, getMax(evt.clientX));
  const lMouseY = Math.max(min, getMax(evt.clientY));

  lFollowX = (20 * lMouseX) / 100;
  lFollowY = (10 * lMouseY) / 100;
});

function getElements() {
  const elements = document.querySelectorAll(".jsBgMove");
  if (elements) [].forEach.call(elements, el => el && moveBackground(el));
}

export default function init() {
  getElements();
}
