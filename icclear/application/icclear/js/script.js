$( document ).ready(function() {
    var heights = $(".equalizer").map(function() {
        return $(this).height();
    }).get(),

    maxHeight = Math.max.apply(null, heights);

    $(".equalizer").height(maxHeight);
});

