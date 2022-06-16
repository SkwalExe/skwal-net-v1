let button = $('.big-button')
let morseInput = $('.morse-input')
let textInput = $('.text-input')
let morse = new morseLib();
let clicked;
let timeouts = [];
let durationInput = $('.duration-input')
let options;


button.onmousedown = button.ontouchstart = (e) => {
  e.preventDefault();
  e.stopPropagation();
  clicked = new Date().getTime();
  timeouts.forEach(clearTimeout);
  timeouts = [];
}

button.onmouseup = button.ontouchend = (e) => {
  e.preventDefault();
  e.stopPropagation();
  let now = new Date().getTime();
  let diff = now - clicked;

  morseInput.value += (diff > options.long) ? '-' : '.';

  timeouts.push(
    setTimeout(() => {
      morseInput.value += '/ ';
    }, options.newWord)
  )

  timeouts.push(
    setTimeout(() => {
      morseInput.value += ' ';
    }, options.newLetter)
  )

  updateText();
}

const updateText = () =>
  textInput.value = morse.decode(morseInput.value);

const updateMorse = () =>
  morseInput.value = morse.encode(textInput.value);

morseInput.oninput = updateText;
textInput.oninput = updateMorse;

durationInput.oninput = () => {
  let unit = durationInput.value;
  options = {
    long: unit * 3,
    newLetter: unit * 3,
    newWord: unit * 7
  }
}


durationInput.oninput();



let morseCopy = $('.morse-input-copy')
let textCopy = $('.text-input-copy')
let morseClear = $('.morse-input-clear')
let textClear = $('.text-input-clear')

morseClear.onclick = () => {
  morseInput.value = '';
  updateText();
}

textCopy.onclick = () => {
  copy(textInput.value);
  toasteur.success('Text copied to the clipboard', 'Copied!')
}

textClear.onclick = () => {
  textInput.value = '';
  updateMorse();
}

morseCopy.onclick = () => {
  copy(morseInput.value);
  toasteur.success('Morse code copied to the clipboard', 'Copied!')
}
