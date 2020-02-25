import PhotoSwipe from "photoswipe";
import PhotoSwipeUI_Default from "photoswipe/dist/photoswipe-ui-default";

const pswpElement = document.querySelectorAll(".pswp")[0];

// find nearest parent element
function closest(el, fn) {
  return el && (fn(el) ? el : closest(el.parentNode, fn));
}

function getItems() {
  const items = [];
  const $links = document.querySelectorAll(".js-gallery a");
  $links.forEach(function(el) {
    const src = el.href;
    const w = el.dataset.width;
    const h = el.dataset.height;
    const slide = {
      src: src,
      w: w,
      h: h
    };
    items.push(slide);
  });
  return items;
}


function openGallerySingle(evt) {
  evt.preventDefault();
  const { target } = evt;
  const src = target.href;
  const w = target.dataset.width;
  const h = target.dataset.height;
  const slide = [
    {
      src: src,
      w: w,
      h: h
    }
  ];
  openPhotoSwipe(slide, 0);
}

function openGallery(e) {
  e.preventDefault();
  const { target } = e;

  var clickedListItem = closest(target, function(el) {
    return el.tagName === "A";
  });

  if (!clickedListItem) {
    return;
  }

  const id = clickedListItem.dataset.id;
  const items = getItems();
  openPhotoSwipe(items, id);

  return false;
}


function openPhotoSwipe(items, index) {
  const galleryElement = pswpElement;
  const options = {
    mainClass: "pswp--minimal--dark",
    barsSize: { top: 20, bottom: 0 },
    captionEl: false,
    fullscreenEl: false,
    shareEl: false,
    bgOpacity: 0.85,
    tapToClose: true,
    index: Number(index),
    galleryUID: galleryElement.getAttribute("data-pswp-uid")
  };

  const gallery = new PhotoSwipe(
    galleryElement,
    PhotoSwipeUI_Default,
    items,
    options
  );
  gallery.init();
}

export default function init() {
  const gallery = document.querySelector(".js-gallery");
  if (gallery) {
    gallery.setAttribute("data-pswp-uid", "1");
    gallery.onclick = openGallery;
  }

  // Single Photo
  const single = document.querySelector(".js-gallerySingle");
  if (single) {
    single.setAttribute("data-pswp-uid", "1");
    single.onclick = openGallerySingle;
  }
}
