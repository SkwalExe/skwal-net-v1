var inputs = {
  titleInput: $("input.title"),
  messageInput: $("input.message"),
  typeInput: $("select.type"),
  buttonContentInput: $("input.buttonContent"),
  positionInput: $("select.position"),
}



var jsResult = $("input.javascript");

jsResult.onclick = function() {
  copy(this.value)
  toasteur.success("Text copied to clipboard", "Copied!")
}

$("button.messageBox").onclick = function() {

  windowsMessageBox.show(inputs.titleInput.value, inputs.messageInput.value, inputs.typeInput.value, [
    [inputs.buttonContentInput.value]
  ], inputs.positionInput.value == "random" ? "random" : undefined);
  updateJsResult()
}

updateJsResult = () => {
  jsResult.value = "windowsMessageBox.show(\"" + inputs.titleInput.value + "\", \"" + inputs.messageInput.value + "\", \"" + inputs.typeInput.value + "\", [[\"" + inputs.buttonContentInput.value + "\"]]" + (inputs.positionInput.value == "random" ? ", \"random\"" : "") + ");"
}
updateJsResult()

for (let input in inputs) {
  input = inputs[input]
  input.oninput = updateJsResult
}
