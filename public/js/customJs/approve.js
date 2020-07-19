$(function() {
    $("#form-approve").on("submit", function(e) {
        if (!e.isDefaultPrevented()) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                url: '/approve/create',
                type: "post",
                data: new FormData($('#form-approve')[0])
                ,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('.container').html(data.html);
                },
                error: function(data) {},
            });
            return false;
        }
    });
});