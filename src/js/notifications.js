function clearTimeouts(timeouts) {
    timeouts.forEach(timeout => clearTimeout(timeout));
}

function notif(title, message, type = "success", link) {
    var notifArea = $(".notifArea");
    if (!notifArea) {
        notifArea = document.createElement("div");
        notifArea.classList.add("notifArea");
        document.body.appendChild(notifArea);
        notifArea = $(".notifArea");
    }
    var notif = document.createElement("div");
    notif.classList.add("notif");
    notif.classList.add(type);
    notif.innerHTML = `<img src="/assets/${type}.png" /><div class="text"><h3>${title}</h3>${message}</div>`;
    var timeouts = [];
    notif.onclick = function() {
        if (link) {
            window.location.href = link;
        } else {
            remove(notif)
            clearTimeouts(timeouts);
        }
    }

    notif.onmousemove = function() {
        clearTimeouts(timeouts);
        notif.classList.remove("disappearing");
    }
    notif.onmouseleave = function() {
        timeouts.push(setTimeout(function() {
            notif.classList.add("disappearing");
            timeouts.push(setTimeout(() => {
                remove(notif)
                clearTimeouts(timeouts);
            }, 2000));
        }, 2000));
    }
    notifArea.appendChild(notif);

    setTimeout(notif.onmouseleave, 5000);
}