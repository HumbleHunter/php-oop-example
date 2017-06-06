$(document).ready(function () {
    $('#btn-save').click(function () {
        save();
    });

    $('#btn-cancel').click(function () {
        close();
    });
    $('#btn-delete').click(function(){
        trash();
    })
});

function close() {
    $('.popup').remove();
}

function save() {
    $.ajax({type: "POST", data: $("#add_form").serialize(), url: "Home/save/"+$('#day').attr('value')+'/'+$('#hour').attr('value'),
        success: function (result) {            
            //tymczasowo
            window.location.href = "Home/index";
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function trash(){
    $.ajax({type: "POST", data: $("#del_form").serialize(), url: "Home/trash/"+$('#day').attr('value')+'/'+$('#hour').attr('value'),
        success: function (result) {            
            //tymczasowo
            window.location.href = "Home/index";
        },
        error: function (error) {
            console.log(error);
        }
    });
}