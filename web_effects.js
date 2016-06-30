$(document).ready(function(){
    x = 1;
    $("#dropIcon").click(function(){
        if (x == 1) {
            $("#dropDownList").removeClass("gone");
            $("#dropDownList li").css("display", "block");
            x = 0;
        }
        else {
            $("#dropDownList").addClass("gone");
            x = 1;
        }
    });
});