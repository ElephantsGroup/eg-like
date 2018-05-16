var post_like = function (addr, token, in_service_id, in_item_id) {
    $.ajax({
        url: addr,
        method: "POST",
        data: {
            item_id: in_item_id,
            service_id: in_service_id,
            _frontendCsrf: token
        }
    })
    .done(function (response)
    {
        response_array = JSON.parse(response);
        if(response_array['status'] == 200) {
            $.notify(
                {
                    message: response_array['message'],
                    icon: 'glyphicon glyphicon glyphicon-ok-circle'
                },
                {
                    type: 'success',
                    allow_dismiss: false,
                    placement: {
                        from: "bottom",
                        align: "right"
                    }
                }
            );
            $('#heart-like' + in_item_id).css('display', 'none');
            $('#heart-unlike' + in_item_id).css('display', 'block');
        }
        else
            $.notify({ message: response_array['message']},{type: 'warning'});
    })
    .fail(function(req, status, err)
    {
        console.log('like error', req, status, err);
    })
}

var post_unlike = function (addr, token, in_service_id, in_item_id) {
    $.ajax({
        url: addr,
        method: "POST",
        data: {
            item_id: in_item_id,
            service_id: in_service_id,
            _frontendCsrf: token
        }
    })
    .done(function (response)
    {
        response_array = JSON.parse(response);
        if(response_array['status'] == 200) {
            $.notify(
                {
                    message: response_array['message'],
                    icon: 'glyphicon glyphicon glyphicon-remove-circle'
                },
                {
                    type: 'success',
                    allow_dismiss: false,
                    placement: {
                        from: "bottom",
                        align: "right"
                    }
                }
            );
            $('#heart-like' + in_item_id).css('display', 'block');
            $('#heart-unlike' + in_item_id).css('display', 'none');
        }
        else
            $.notify({ message: response_array['message']},{type: 'warning'});
    })
    .fail(function( req, status, err )
    {
        console.log( 'something went wrong', req, status, err );
    })
}