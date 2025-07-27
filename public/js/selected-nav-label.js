function handleClick(link, event) {
  var pageTitle = link.getAttribute("data-page-title");
  var pageHref = link.getAttribute("href");

  document.getElementById("selected-nav-label").innerHTML = pageTitle;

  localStorage.setItem("selectedPageTitle", pageTitle);

  event.preventDefault();

  window.location.href = pageHref;
}

document.addEventListener("DOMContentLoaded", function () {
  var initialPageTitle = localStorage.getItem("selectedPageTitle");
  if (initialPageTitle) {
    document.getElementById("selected-nav-label").innerHTML = initialPageTitle;
  }
});