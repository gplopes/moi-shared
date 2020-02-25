const bookingButtons = () => {
  const $buttons = document.querySelector(".js-bookingButtons");
  const $wrap = document.querySelector(".js-bookingWrap");

  if (!$wrap && !$buttons) {
    return null;
  }

  window.addEventListener("scroll", evt => {
    const { top } = $wrap.getBoundingClientRect();
    const OFFSET = -160;
    if (top < OFFSET && !$buttons.classList.contains("bottom")) {
      $buttons.classList.add("bottom");
    }

    if (top > OFFSET && $buttons.classList.contains("bottom")) {
      $buttons.classList.remove("bottom");
    }
  });
};

export default function init() {
  bookingButtons();
}
