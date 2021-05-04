$(function() {
    // navigation fixes start
    // Add extra ul li-elements for dropdown navigation
    $(".side-nav > li a + ul")
        .parent()
        .wrap("<li><ul></ul></li>");
    // Initialize collapse button
    $(".button-collapse").sideNav();
    // Initialize collapsible (uncomment the line below if you use the dropdown variation)
    $(".side-nav li ul").collapsible();

    $(".side-nav > li > ul > li:first-child > a")
        .addClass("collapsible-header")
        .append("<i class=\"material-icons right\">arrow_drop_down</i>");
    $(".side-nav li ul ul").addClass("collapsible-body");

    $(".side-nav").perfectScrollbar();
    $("#main#main-content").perfectScrollbar();

    // Fix anchor links
    var pathname = window.location.href.split("#")[0];
    $("a[href^=\"#\"]").each(function() {
        var $this = $(this),
            link = $this.attr("href");
        $this.attr("href", pathname + link);
        $this.attr("data-anchor", link);
    });

    // Prevent default on anchors
    $("a[data-anchor]").click(function(e) {
        e.preventDefault();
        var link = $(this).attr("data-anchor");
        $("html, body").animate(
            {
                scrollTop: $(link).offset().top
            },
            400
        );
    });
    // Disable hashes for fancybox to avoid back-foward issues
    $.fancybox.defaults.hash = false;
});
