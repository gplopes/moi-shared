import Siema from "siema";

export default () => {
  const slider = document.querySelector(".js-slider");
  if (!slider) {
    return null;
  }

  const $pagination = document.createElement("div");
  $pagination.className = "hero-pagination";

  const currentPagination = () => {
    const children = $pagination.querySelectorAll("button");
    children.forEach((child, index) => {
      if (index === mySiema.currentSlide) {
        child.className = "current";
      } else {
        child.className = "";
      }
    });
  };

  const mySiema = new Siema({
    selector: ".js-slider",
    perPage: 1,
    startIndex: 0,
    onChange: currentPagination
  });

  Siema.prototype.addPagination = function() {
    for (let i = 0; i < this.innerElements.length; i++) {
      const btn = document.createElement("button");

      if (i == 0) {
        btn.className = "current";
      }

      // btn.textContent = i;
      btn.addEventListener("click", () => this.goTo(i));
      $pagination.appendChild(btn);
    }
    this.selector.appendChild($pagination);
  };

  mySiema.addPagination();
};
