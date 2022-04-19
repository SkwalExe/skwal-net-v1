css("terminal");

// the textarea for the command input 
var commandInput = $(".commandInput");
var commandInputContainer = $(".commandInputContainer");

document.onclick = () => {
    !getSelectedText().length > 0 &&
        commandInput.focus()
}
document.onclick();
// when a key is pressed, automatically focus the command input
document.onkeydown = () => { commandInput.focus };


// the terminal element
var terminal = $(".terminal");
// the content of the terminal (between the command input and the big title)
terminal.content = $(".terminalContent");

window.onresize = commandInput.oninput = () => {
    // set the height of the command input to 0 because else scrollHeight would be wrong
    commandInput.style.height = "0px";
    // make the command input the exact size of the text
    commandInput.style.height = 20 + commandInput.scrollHeight + "px";
    // make the terminal element scroll to the bottom
    terminal.scroll({ top: 10000000, left: 0 });
}

// this function log a message to the terminalContent
// parameters:
// type: the type of the message (error, command, result)
//       (the type will be added as a class to the message)
// args: what to print
// 
// ex : terminal.message("error", "Oh no...", "an error occured...")
//      will print "Oh no..." and "an error occured..." in red
terminal.message = function(type, ...args) {
    args.forEach(arg => {
        if (!arg.length > 0)
            return;

        var message = document.createElement("pre");
        message.classList.add(type);
        message.classList.add("break");
        message.textContent = arg;
        terminal.content.appendChild(message);

    });

    commandInput.oninput();
}

// this function is a shortcut for terminal.message("result", ...args)
terminal.log = function(...args) {
    terminal.message("result", ...args)
}

// this function is a shortcut for terminal.message("error", ...args)
terminal.error = function(...args) {
    terminal.message("error", ...args)
}

// this function is a shortcut for terminal.message("command", ...args)
terminal.command = function(...args) {
    terminal.message("command", ...args)
}

commandInput.addEventListener("keydown", function(event) {
    // if the key is the up arrow
    if (event.which == 38)
        terminal.complete("up")
        // if the key is the down arrow
    else if (event.which == 40)
        terminal.complete("down")
        // if the key is the enter key
    else if (event.keyCode == 13 || event.key == "Enter" || event.code == "Enter") {
        // execute the command in the command input
        terminal.execute(commandInput.value);
        // reset the command input
        commandInput.value = "";
        // resize the command input
        commandInput.oninput();
    } else
        return;

    // prevent the cursor from going up/down or the new line from being added to the command input
    event.preventDefault()
})

// the command history
terminal.history = {
    elements: [],
    currentElement: -1
}

// this function navigate through the command history
// by going up or down
terminal.complete = function(direction) {

    // -1 is the newest "element" and means : no element selected
    // the user is typing the command

    // if the direction is down else its up
    if (direction == "down") {
        // if the user is not typing a new command
        if (terminal.history.currentElement > -1) {
            // decrement the current element
            terminal.history.currentElement--;
        } else {
            // empty the command input
            return commandInput.value = "";
        }
    } else {
        // if the current element is not the oldest element
        if (terminal.history.currentElement + 1 != terminal.history.elements.length) {
            // increment the current element       
            terminal.history.currentElement++;
        } else {
            // if the current element is the oldest element
            // do nothing
            return;
        }
    }
    // if the command is not -1
    if (terminal.history.currentElement != -1) {
        // set the command input to the current element
        commandInput.value = terminal.history.elements[terminal.history.currentElement]
    } else {
        // if the current element is -1
        // empty the command input to let the user type
        commandInput.value = "";
    }

    // resize the command input
    commandInput.oninput();
}


// this functions executes a command
terminal.execute = function(command) {

    // if the command is not the newest command in the history and the command is not empty
    if (terminal.history.elements[0] != command && command != "") {
        // add the command to the history
        terminal.history.elements.unshift(command);
    }

    terminal.history.currentElement = -1;

    // print the command line executed in the terminal content
    //  + " " to make the command non-empty if it is
    terminal.command(command + " ");


    // if the command wasn't empty
    // make the emulator run the command
    // use terminal.log to print the result
    // and terminal.error to print an error
    if (command.trim().length > 0)
        terminal.emulator.run(command).then(terminal.log, terminal.error)

    // resize the command input
    commandInput.oninput();
}

// the bash emulator
// with the environment
terminal.emulator = bashEmulator({
    workingDirectory: '/home/skwal',
    fileSystem: {
        '/': {
            type: 'dir',
            modified: Date.now()
        },
        '/home': {
            type: 'dir',
            modified: Date.now()
        },
        '/home/skwal': {
            type: 'dir',
            modified: Date.now()
        },

        '/root': {
            type: 'dir',
            modified: Date.now()
        },
        '/mnt': {
            type: 'dir',
            modified: Date.now()
        }
    },
    user: "skwal"
});

// this function creates write/create a file in the file system
// parameters:
// path : the directory in which the file will be created
// name : the name of the file
// content : the content of the file
terminal.emulator.createFile = async function(path, fileName, content = "\n") {
    fileName = fileName.replace(/[\s\/]/g, "");
    path = path.replace(/\s/g, "");
    path = path += "/" + fileName
    await terminal.emulator.write(path, content)
};

// this command clear the terminal
terminal.emulator.commands.clear = function(env) {
    terminal.content.innerHTML = ""
    env.exit()
}

// this command prints the command history
terminal.emulator.commands.history = function() {
    for (i = 0; i < terminal.history.elements.length; i++) {
        terminal.log("[ " + (i + 1) + " ] " + terminal.history.elements[i] + "\n")
    }
}

// this command prints text
terminal.emulator.commands.print = terminal.emulator.commands.echo = function(env, args) {
    args.shift()
    terminal.log(args.join(" "))
}

// this command exits the terminal
terminal.emulator.commands.exit = function(env) {
    redirect("/");
}

// this function hides the command input
terminal.hideCommandInput = function() {
    commandInputContainer.style.opacity = 0;
}

// this function shows the command input
terminal.showCommandInput = function() {
    commandInputContainer.style.opacity = 1;
}

// this functions prints all commands
terminal.emulator.commands.help = function() {
    for (var [key, value] of Object.entries(terminal.emulator.commands)) {
        terminal.log(key);
    }
}