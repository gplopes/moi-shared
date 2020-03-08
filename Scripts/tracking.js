/* tslint:disable */

// import "cookieconsent";
import CookiesEuBanner from "cookies-eu-banner";
import LogRocket from "logrocket";
import createScript from "./utils/createScript";

const hotJar = HOTJAR_KEY => {
  return (function(h, o, t, j, a, r) {
    h.hj =
      h.hj ||
      function() {
        (h.hj.q = h.hj.q || []).push(arguments);
      };
    h._hjSettings = { hjid: HOTJAR_KEY, hjsv: 6 };
    a = o.getElementsByTagName("head")[0];
    r = o.createElement("script");
    r.async = 1;
    r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
    a.appendChild(r);
  })(window, document, "https://static.hotjar.com/c/hotjar-", ".js?sv=");
};

const GA = GA_KEY => {
  createScript(`https://www.googletagmanager.com/gtag/js?id=${GA_KEY}`);
  window.dataLayer = window.dataLayer || [];
  window.gtag = function gtag() {
    dataLayer.push(arguments);
  };
  window.gtag("js", new Date());
  window.gtag("config", GA_KEY);
};

const errorTracker = LOG_KEY => LogRocket.init(LOG_KEY);

export default function initTrackers() {
  const { hotjarKey, gaKey, logErrKey } = window.MOI_SETTINGS;
  new CookiesEuBanner(() => {
    hotjarKey && hotJar(hotjarKey);
    gaKey && GA(gaKey);
    logErrKey && errorTracker(logErrKey);
  }, false);
}
