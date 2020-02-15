$(document).ready(function(){
    
    var base_url = "http://localhost:8080/php2sajt1";
    $('#sendToCart').on('click', function() {
        let p_id = $('#p_id').val();
        let c_id = $('#selected_color').data("id");
        let quantity = $("#quantity_input").val();

        $.ajax({
            url: base_url+"/addtocart",
            method: "post",
            data: {
                product_id: p_id,
                color_id: c_id,
                quantity: quantity
            },
            success: function(data, textStatus, jqXHR){
                console.log(textStatus + ": " + jqXHR.status);
                alert("Uspesan unos");
                location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            }
        });
        
    });

    $('.color_mark').on('click', function(){
        let colorid = $(this).data("id");
        $('#selected_color').data("id", colorid);
    });

    var prvaboja = $('.color_mark')[1];
    prvaboja.click();
});