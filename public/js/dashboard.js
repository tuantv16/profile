$(document).ready(function(){

    $(".member").click(function () {
        let _member = $(this).data('user_id');

        var url = new window.URL(document.location); // fx. http://host.com/endpoint?abc=123
        url.searchParams.set("member", _member);
        let urlStr = url.toString();
        location.href = urlStr;
    });


    $(".image-detail").click(function() {
        let sourse = $(this).find('img').attr("src");
        $("body #imgPopup").attr("src",sourse);
        $("#modalImage").trigger('click');
    });
    
    $(".hide_info").click(function() {
        $(this).addClass('d-none');
        $(this).parent('.box-proccess').find('.show_info').removeClass('d-none');

        let borContainer = $(this).parents('.info-text');
        let content = borContainer.find('.description_hidden').find('.content_hidden').clone();

        borContainer.find('.description').empty();
        borContainer.find('.description').append(content);
    });

    $(".show_info").click(function() {
        $(this).addClass('d-none');
        $(this).parent('.box-proccess').find('.hide_info').removeClass('d-none');

        let borContainer = $(this).parents('.info-text');
        borContainer.find('.description').empty();
        borContainer.find('.description').append("***********");
    });

    $("#list_titles").change(function() {
        $("#btnFilter").trigger('click');
    });
    
});
