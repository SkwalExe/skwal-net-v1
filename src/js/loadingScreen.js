document.addEventListener('DOMContentLoaded', function() {
    var loadingScreen = $(".loadingScreen");
    // some js files import other js files, so we need to wait for all of them to load
    setTimeout(() => {

        loadingScreen.style.opacity = 0;

        setTimeout(() => {
            remove(loadingScreen);
        }, 500);

    }, 500);
});