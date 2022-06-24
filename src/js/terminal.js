if (serverData.showPageContent) {
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

    let hideFromHistory = /^(register|login)(.*)/.test(command)

    // if the command is not the newest command in the history and the command is not empty
    if (terminal.history.elements[0] != command && command != "" && !hideFromHistory) {
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
      terminal.emulator.run(command)

    if (hideFromHistory)
      terminal.emulator.history.shift();

    // resize the command input
    commandInput.oninput();
  }

  // the bash emulator
  // with the environment
  terminal.emulator = new ShellEmulator();

  // this command clear the terminal
  terminal.emulator.commands.clear = () => {
    terminal.content.innerHTML = ""
  }

  // this command exits the terminal
  terminal.emulator.registerCommand("exit", () => {
    redirect("/")
  })

  // this function hides the command input
  terminal.hideCommandInput = function() {
    commandInputContainer.style.opacity = 0;
  }

  // this function shows the command input
  terminal.showCommandInput = function() {
    commandInputContainer.style.opacity = 1;
  }


  terminal.emulator.on('stdout', terminal.log)
  terminal.emulator.on('stderr', terminal.error)

  terminal.emulator.fs.loadFromJSON('[{"type":"directory","name":"/","modified":1653112369069,"parent":"/","content":[{"type":"directory","name":"home","modified":1653112374079,"parent":"/","content":[{"type":"directory","name":"skwal","modified":1653112381757,"parent":"/home","content":[{"type":"directory","name":"Desktop","modified":1653112385451,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Documents","modified":1653112389168,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Pictures","modified":1653112394563,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Downloads","modified":1653112403544,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Library","modified":1653112408350,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Music","modified":1653112410234,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Videos","modified":1653112419933,"parent":"/home/skwal","content":[]}]}]},{"name":"root","type":"directory","content":[{"type":"directory","name":"Desktop","modified":1653112385451,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Documents","modified":1653112389168,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Pictures","modified":1653112394563,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Downloads","modified":1653112403544,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Library","modified":1653112408350,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Music","modified":1653112410234,"parent":"/home/skwal","content":[]},{"type":"directory","name":"Videos","modified":1653112419933,"parent":"/home/skwal","content":[]}],"modified":1653112508454,"parent":"/"},{"type":"directory","name":"mnt","modified":1653112536129,"parent":"/","content":[]},{"type":"directory","name":"bin","modified":1653112540791,"parent":"/","content":[]},{"type":"directory","name":"boot","modified":1653112542293,"parent":"/","content":[]},{"type":"directory","name":"dev","modified":1653112544993,"parent":"/","content":[]},{"type":"directory","name":"etc","modified":1653112548799,"parent":"/","content":[]},{"type":"directory","name":"lib","modified":1653112552397,"parent":"/","content":[]},{"type":"directory","name":"lib64","modified":1653112555750,"parent":"/","content":[]},{"type":"directory","name":"opt","modified":1653112559639,"parent":"/","content":[]},{"type":"directory","name":"proc","modified":1653112562004,"parent":"/","content":[]},{"type":"directory","name":"run","modified":1653112564203,"parent":"/","content":[]},{"type":"directory","name":"sbin","modified":1653112566392,"parent":"/","content":[]},{"type":"directory","name":"sys","modified":1653112569565,"parent":"/","content":[]},{"type":"directory","name":"tmp","modified":1653112571284,"parent":"/","content":[]},{"type":"directory","name":"usr","modified":1653112573016,"parent":"/","content":[]},{"type":"directory","name":"var","modified":1653112574660,"parent":"/","content":[]}]}]')

  terminal.emulator.registerCommand('github', env => env.print('https://github.com/SkwalExe/'))
  terminal.emulator.registerCommand('discord', env => env.print('https://discord.skwal.net'))
  terminal.emulator.registerCommand('skwash', env => env.print('https://github.com/SkwalExe/skwash.js'))

  terminal.emulator.registerCommand('register', (env, args) => {
    if (args.length < 3) {
      env.print('Usage: register <username> <email> <password>')
      env.print("Don't forget to escape $ with \\")
    } else {
      const username = args[0]
      const email = args[1]
      const password = args[2]

      const data = JSON.stringify({
        username,
        password,
        email
      })

      fetch('/api/v1/register.php', {
        mode: 'cors',
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: data
      }).then(res => res.json()).then(data => {
        if (data.success) {
          env.print(data.message)
          env.print('Reloading in 2 seconds...')
          setTimeout(() => {
            window.location.reload()
          }, 2000)
        } else {
          env.eprint(data.error)
        }
      })

    }
  })

  terminal.emulator.registerCommand('login', (env, args) => {
    if (args.length < 2) {
      env.print('Usage: login <identification> <password> <identificator: [username]|email>')
      env.print('\tExample: login skwalexe83 "^My P4ssw0rd\\$"')
      env.print('\tExample: login skwalexe83@skwal.net P4ssw0rd! email')
      env.print("Don't forget to escape $ with \\")
    } else {
      const identification = args[0]
      const password = args[1]
      const identificator = args.length > 2 ? args[2] : 'username'

      const data = JSON.stringify({
        identification,
        password,
        identificator
      })


      fetch('/api/v1/login.php', {
        mode: 'cors',
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: data
      }).then(res => res.json()).then(data => {
        if (data.success) {
          env.print(data.message)
          env.print('Reloading in 2 seconds...')
          setTimeout(() => {
            window.location.reload()
          }, 2000)
        } else {
          env.eprint(data.error)
        }
      })
    }
  })



  terminal.emulator.registerCommand('logout', env => {

    fetch('/api/v1/logout.php', {
      mode: 'cors',
      method: 'GET'
    }).then(res => res.json()).then(data => {
      if (data.success) {
        env.print(data.message)
        env.print('Reloading in 2 seconds...')
        setTimeout(() => {
          window.location.reload()
        }, 2000)
      } else {
        env.eprint(data.error)
      }
    })

  })

  terminal.emulator.registerCommand('whoami', env => {

    console.log(serverData)
    if (serverData['loggedIn'])
      env.print(serverData['user']['username'])
    else
      env.eprint('You are not logged in.')
  })

}
