var popap = document.getElementById("popap");
var send = document.querySelectorAll("#editComment");
var likes = document.querySelectorAll("#likeComment");
var countLikes = document.querySelectorAll(".comment")
var authId = $("#authId").val();

for (i = 0; i < countLikes.length; i++) {
    Cookies.get(countLikes[i].id) !== undefined
        ? countLikes[i].innerText = Cookies.get(countLikes[i].id)
        : '';
}

for (i = 0; i < likes.length; i++) {
    likes[i].addEventListener('click', function(el) {
        el.preventDefault();

        if (!authId) {
            popap.style.left = "200px"
            setTimeout(showPopap, 3000, popap);
        }else {

            const url = "{{ route('customer.comment.like-add') }}";

            const data = {
                userId: authId,
                commentId: $(this).attr('href'),
                like: true,
                _token: '{{csrf_token()}}'
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function (data) {
                    Cookies.set('countComment-' + data.id , data.data);
                    var span = document.getElementById("countComment-" + data.id);
                    span.innerText = Cookies.get('countComment-' + data.id);
                }
            });
        }
    });
}

function showPopap(popap) {
    this.popap.style.left = "-1000px";
}

for (i = 0; i < send.length; i++) {
    send[i].addEventListener('click', function() {
        $('#replyForm').toggleClass('d-none', 'd-block');
    });
}