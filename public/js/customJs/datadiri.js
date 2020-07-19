$(function() {
    $("#form-data").on("submit", function(e) {
        if (!e.isDefaultPrevented()) {
            
            var id = $("#id").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                url: '/start/service',
                type: "post",
                data: new FormData($('#form-data')[0])
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