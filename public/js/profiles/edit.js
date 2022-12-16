$(document).ready(function(){
    $(function () {
   
        $("#profileImage").change(function () {
                var imgControlName = "#imgFileUpload";
                readURL(this, imgControlName);
                $("#flag_del_image").val("");
        });

        function readURL(input, imgControlName) {
                if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                                $(imgControlName).attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                }
        }

        var fileupload = $("#profileImage");
        var image = $("#imgFileUpload");
        image.click(function () {
                fileupload.click();
        });

        $("#removeImage").click(function () {
            let image_default = $("#image_default").val();
            $("#imgFileUpload").attr("src", image_default);
            $("#flag_del_image").val(1);
        });
        
            
    });
});