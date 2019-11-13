$(document).ready(function() {
    var count_cart = $(".count_cart").text();
    if (count_cart == 0) {
        $(".count_cart").hide();
    }
});