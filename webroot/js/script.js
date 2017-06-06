$(document).ready(function () {
    $('.book-add').each(function () {
        $(this).click(function () {
            $.ajax({url: "Home/add/" + $(this).attr('day') + "/" + $(this).attr('hour'),
                success: function (result) {
                    $('#popup').html(/<div class="popup">[\s\S]*<\/div>/.exec(result));
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });    
    $('.book-del').each(function () {
        $(this).click(function () {
            $.ajax({url: "Home/delete/" + $(this).attr('day') + "/" + $(this).attr('hour'),
                success: function (result) {
                    $('#popup').html(/<div class="popup">[\s\S]*<\/div>/.exec(result));
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });
    });    
});
