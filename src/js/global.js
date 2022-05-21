const toasteur = new Toasteur();

$$(".sideBarTitle").forEach(element => {
  element.classList.add("section")
  element.classList.add("box")
  element.classList.add("glowing")
})

document.body.ondragover = function(e) {
  e.preventDefault()
  return false;
}
document.body.ondrop = function(event) {
  event.preventDefault()
  if (!event.target.classList.contains('drop'))
    if (event.dataTransfer.files.length > 0)
      toasteur.success("Very interesting file!")

};
