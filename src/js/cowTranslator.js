var textInput = $(".textInput")
var cowInput = $(".cowInput")
var translationStatus = $(".status")

var timeout;



function updateCowInput() {

    let result = CowTranslator.textToCow(textInput.value)
    if (result.success) {
        translationStatus.innerText = "OK"
        cowInput.value = result.cow
        if (result.warning) {
            translationStatus.innerText = result.error
        }
    } else {
        translationStatus.innerText = "ERROR"
        cowInput.value = result.error;
    }

}


function updateTextInput() {
    let result = CowTranslator.cowToText(cowInput.value)
    if (result.success) {
        translationStatus.innerText = "OK"
        textInput.value = result.text
        if (result.warning) {
            translationStatus.innerText = result.error
        }
    } else {
        translationStatus.innerText = "ERROR"
        textInput.value = result.error;
    }
}


textInput.oninput = function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        updateCowInput()
    }, 200);
}
cowInput.oninput = function() {
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        updateTextInput()
    }, 200);

}


function copyHuman() {
    copy(textInput.value)
    notif("Copied!", "Text copied to clipboard")
}

function resetHuman() {
    textInput.value = ""
    updateCowInput()
}

function copyCow() {
    copy(cowInput.value)
    notif("Copied!", "Text copied to clipboard")
}

function resetCow() {
    cowInput.value = ""
    updateTextInput()
}


textInput.value = "Enter your text here"

textInput.oninput();

js("notifications")
css("cowTranslator")