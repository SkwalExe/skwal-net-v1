$$('.tile').forEach(function(tile) {
    tile.classList.add('box');
    tile.classList.add('glowing');
})

$$(".tile .head .title").forEach(function(title) {
    title.classList.add('purp');
    title.classList.add('break');
})

css("tiles")