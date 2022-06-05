const toggleButton = $("#toggleButton");
const navList = $("#navList");
const logo = $(".logo");

toggleButton.addEventListener("click", () => {
  navList.classList.toggle("active");
})

logo.oncontextmenu = (e) => {
  e.preventDefault();
  copy("https://skwal.net")
  toasteur.success('Website URL copied to clipboard', "Copied!");
}
