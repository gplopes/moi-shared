import LazyLoad from "vanilla-lazyload";
import nav from "./nav";
import gallery from "./gallery";
import trackers from "./tracking";
import bgMove from "./move-bg";
import slider from "./slider";
import booking from "./bookingButtons";

export default () => {
  nav();
  gallery();
  bgMove();
  trackers();
  slider();
  booking();
  const pageLazyLoad = new LazyLoad({
    elements_selector: ".jsLazy"
  });
};
