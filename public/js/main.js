$(document).ready(function(){

    $(".item-del").click(function (e) {
      e.preventDefault();
      let url = $(this).attr('url');
        if (confirm("Bạn có chắc chắn muốn xóa không?") == true) {
          location.href = url;
        } 

      });
   


    
});
