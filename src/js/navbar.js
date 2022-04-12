const toggleButton = $("#toggleButton");
const navList = $("#navList");

toggleButton.addEventListener("click", () => {
    navList.classList.toggle("active");
})

css("navbar")