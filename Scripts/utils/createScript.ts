export default function createScript(url) {
  const s = document.createElement("script");
  s.type = "text/javascript";
  s.async = true;
  s.src = url;
  const x = document.getElementsByTagName("head")[0];
  x.appendChild(s);
}
