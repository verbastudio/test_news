$(document).ready(function () {
    $.ajax().setRequestHeader("X-Requested-With", "XMLHttpRequest");
    $('#add_form button#add_post').on('click', function (e) {
        e.preventDefault();
        var form = $('#add_form'),
            data = form.serializeArray(),
            url = form.attr('action'),
            result_id = $('#add_result'),
            result_item = $('#add_result span');
        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            data: data,
            success: function (result) {
                if (result.status === 'error') {
                    result_id.removeClass('bg-success').addClass('bg-danger');
                    result_item.html(result.text)
                } else {
                    form.remove();
                    result_id.removeClass('bg-danger').addClass('bg-success')
                    result_item.html(result.text)
                }
                result_id.fadeIn();
            },
            error: function (e) {
                console.log(e)
            },
        });
    });

    $('.remove_post').on('click', function () {
        if(confirm('Are you sure?'))
            if(confirm('You realy want to remove this post?!')) {
                var data = {'id': this.id, 'removepost': this.dataset.sid},
                    result_id = $('#post_' + this.id),
                    result_item = $('#post_' + this.id + ' .card');
                $.ajax({
                    url: this.dataset.action,
                    type: "POST",
                    dataType: 'json',
                    data: data,
                    success: function (result) {
                        if (result.status === 'success') {
                            result_item.addClass('bg-danger');
                            result_item.find('.card-body').html(result.text);
                            result_item.find('.card-header').slideToggle(1000);
                            result_item.find('.card-footer').slideToggle(1000);
                            result_item.delay(2000).slideToggle(1000, function () {
                                result_id.remove()
                            })
                        }
                    },
                    error: function (e) {
                        console.log(e)
                    },
                });
            }
        return false;
    })
});