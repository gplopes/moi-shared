import PhotoSwipe from "photoswipe";
import PhotoSwipeUI_Default from "photoswipe/dist/photoswipe-ui-default";

const pswpElement = document.querySelectorAll(".pswp")[0];

class Gallery {
  images = [];
  $links = [];
  $target = null;
  single = false;
  constructor({ target, single = false }) {
    this.$target = document.querySelector(target);
    this.single = single;
    this.onInit();
  }
  onInit() {
    if (!this.$target) return null;
    console.log("GALLERY INIT");

    this.$target.setAttribute("data-pswp-uid", "1");
    this.$links = this.single
      ? [this.$target]
      : [...this.$target.querySelectorAll("a")];
    this.loadImages();
    this.attachClickHandler();
  }

  loadImages = () => {
    this.images = this.$links.map(link => {
      const src = link.href;
      const w = link.dataset.width;
      const h = link.dataset.height;

      return {
        src,
        w,
        h
      };
    });
  };
  attachClickHandler = () => {
    this.$links.forEach($el => {
      $el.addEventListener("click", this.clickHandler);
    });
  };

  clickHandler = evt => {
    const { target } = evt;
    const { id } = target.dataset;

    evt.preventDefault();
    const options = {
      index: id,
      bgOpacity: 0.85,
      showHideOpacity: true
    };

    console.log({ options });

    const gallery = new PhotoSwipe(
      pswpElement,
      PhotoSwipeUI_Default,
      this.images,
      options
    );

    gallery.init();
  };
}

export default function init() {
  new Gallery({ target: ".js-gallery" });
  new Gallery({ target: ".js-gallerySingle", single: true });
}
