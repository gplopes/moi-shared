//////////////////////////////////////////////////////////////// LISTENER

const listenMenusToClose = (eventFn: (cb: any, event?: any) => void) => {
  const listenerFn = clickEvt => eventFn(removeListener, clickEvt);

  const listener = () =>
    document.addEventListener("mouseup", listenerFn, {
      passive: true
    });

  function removeListener() {
    document.removeEventListener("mouseup", listenerFn);
  }

  return listener;
};

//////////////////////////////////////////////////////////////// LANG

const lang = $lang => {
  const $langParent = $lang.parentElement;
  if (!$lang) return false;

  // Click Event
  const eventFn = function(removeSelf, evt) {
    if (
      evt.target.parentElement !== $langParent &&
      $langParent.classList.contains("is-shown")
    ) {
      $langParent.classList.remove("is-shown");
      removeSelf();
    }
  };

  // Event Listener
  const listener = listenMenusToClose(eventFn);

  // Click Listener
  $lang.addEventListener("click", function(e) {
    $lang.parentElement.classList.toggle("is-shown");
    listener();
  });
};

const langs = () => {
  // Elements
  const $langs = document.querySelectorAll(".js-lang");
  $langs.forEach(lang);
};

//////////////////////////////////////////////////////////////// NAV

const nav = () => {
  // Elements
  const $burger = document.querySelector(".js-burger");
  const $menu = document.querySelector(".js-menu");
  if (!$burger && !$menu) return false;

  // Toggle Menu
  const toggleMenu = () => {
    $burger.classList.toggle("is-shown");
    $menu.classList.toggle("is-shown");
  };

  // Click Event
  const eventFn = function(removeSelf, evt) {
    if (evt.target !== $burger && $burger.classList.contains("is-shown")) {
      toggleMenu();
      removeSelf();
    }
  };

  // Event Listener
  const listener = listenMenusToClose(eventFn);

  // Listener
  $burger.addEventListener("click", function(evt) {
    evt.stopPropagation();
    evt.stopImmediatePropagation();
    toggleMenu();
    listener();
  });
};

//////////////////////////////////////////////////////////////// EXPORT

export default function init() {
  langs();
  nav();
}
