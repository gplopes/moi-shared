import axios from "axios";

const CACHE_KEY = "MOI_FORECAST";

const next30mins = (time: Date) => new Date(new Date(time).setMinutes(30));
const getCache = () => {
  const cached = window.localStorage.getItem(CACHE_KEY);
  let data = null;
  const setCache = dataToCache => {
    window.localStorage.setItem(
      CACHE_KEY,
      JSON.stringify({
        data: dataToCache,
        timestamp: Date.now()
      })
    );
  };

  if (cached) {
    const parsedCached = JSON.parse(cached);
    if (parsedCached.timestamp < next30mins(parsedCached.timestamp)) {
      data = parsedCached.data;
    }
  }

  return {
    data,
    setCache
  };
};

const getForecast = async () => {
  const $forecast = document.querySelector(".js-forecast");
  if (!$forecast) return null;

  const skycons = new window.Skycons();
  const $degrees = $forecast.querySelector(".js-forecast-c");

  const url = `${window.location.origin}/${document.documentElement.lang}`;
  // const url = document.location.href;

  const dataCached = getCache();
  let forecastResult = dataCached.data;

  if (!forecastResult) {
    const result = await axios(`${url}/private/forecast`);
    forecastResult = result.data.currently;
    dataCached.setCache(forecastResult);
  }

  const { temperature, icon, summary } = forecastResult;
  const fToCel = ((temperature - 32) * 5) / 9;
  $degrees.innerHTML = `${Math.floor(fToCel)}&#8451;, ${summary}`;
  skycons.add("forecastIcon", icon);
  skycons.play();
  // $forecast.style.display = "flex";
};

export default function init() {
  getForecast();
}
