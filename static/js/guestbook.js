function onSubmit(token) {
    $("#myForm").submit();
}

var getGuestbook = function() {
    $.get("/php/post-guestbook.php", function(data) {
        $(".result").html(data);
      });
};
var clearForm = function() {
    $("#myForm input.user, #myForm textarea.user").val("");
    $("#myForm textarea.user").trigger('autoresize');
    $(".collapsible li .collapsible-header").click()
}

var postResult = function(result) {
    var output = '<div class="row" id="post-result">' +
                   '<div class="col-xs-12">';
       if(result[0][0] == "success") {
           output += '<div class="card-panel green">';
        } else if (result[0][0] == "error") {
           output += '<div class="card-panel red darken-1">';
        }
        output +=       '<strong class="white-text">' + result[0][1] + '</strong>' +
                      '</div>' + 
                    '</div>' +
                 '</div>';
    $(output).insertBefore(".result")
}

$(document).ready(function() {
    $("div.gaestebog-form").toggle();
    $(".gaestebog-form ul").collapsible();
    
    $('#myForm').submit(function() {
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            url: "/php/post-guestbook.php",
            type: "POST",
            data: data,
            success: function(data) {
                data = JSON.parse(data);
                if (data[0][0] == "success") {
                    clearForm();
                    postResult(data);
                    $(document.body).animate({
                        'scrollTop': $("#top").offset().top
                    },150)
                    getGuestbook();
                }
            },
            error: function() {
                alert('There was an error!');
            }
        });

        return false;
    });
    getGuestbook();
});