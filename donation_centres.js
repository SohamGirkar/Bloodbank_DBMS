const areas = document.querySelectorAll(".area h2");
areas.forEach(area => {
  area.addEventListener("click", () => {
    const parent = area.parentElement;
    parent.classList.toggle("active");
  });
});