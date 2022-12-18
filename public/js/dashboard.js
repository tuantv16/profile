$(document).ready(function(){

    $(".member").click(function () {
        let _member = $(this).data('user_id');

        var url = new window.URL(document.location); // fx. http://host.com/endpoint?abc=123
        url.searchParams.set("member", _member);
        let urlStr = url.toString();
        location.href = urlStr;
    });
});
