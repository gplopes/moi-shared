import AOS from "aos";
import "aos/dist/aos.css";

export default () =>
  AOS.init({ easing: "ease-in-out", duration: 300, once: true });
