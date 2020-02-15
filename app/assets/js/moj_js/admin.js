$(document).ready(function(){
    //alert("aa");
    var base_url = "http://localhost:8080/php2sajt1";

    $('.update-product').on("click", function(){
        //alert("aa");
        let p_id = $(this).data("id");

        $('#product_id').val("");
        $('#upcategory').val(0);
        $('#upbrand').val(0);
        $('#upname').val("");
        $('#upprice').val("");
        $('#upin_stock').val("");
        $('#updesc').val("");

        let chbxs = $('.upcolor_ids');
        for (const item of chbxs) {
            item.checked = false;
        }

        $.ajax({
            url: base_url+"/proizvod/"+p_id,
            method: "get",
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                $('#product_id').val(data.id);
                $('#upcategory').val(data.category_id);
                $('#upbrand').val(data.brand_id);
                $('#upname').val(data.name);
                $('#upprice').val(data.price);
                $('#upin_stock').val(data.in_stock);
                $('#updesc').val(data.description);

                let j = 0;
                for(let i=0; i < chbxs.length; i++){
                    if(chbxs[i].value == data.colors[j].id){
                        chbxs[i].checked = true;
                        j++;
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            }
        });
    });

    $('.update-user').on("click", function(){
        const user_id = $(this).data("id");

        $('#u_id').val("");
        $('#ufname').val("");
        $('#ulname').val("");
        $('#uemail').val("");
        $('#upassword').val("");
        $('#u_role').val(0);

        $.ajax({
            url: base_url+"/user/"+user_id,
            method: "get",
            dataType: "json",
            success: function(data, textStatus, jqXHR){
                $('#u_id').val(data.id);
                $('#ufname').val(data.first_name);
                $('#ulname').val(data.last_name);
                $('#uemail').val(data.email);
                $('#upassword').val("");
                $('#uactive').val(parseInt(data.active));
                $('#u_role').val(data.role_id);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
            }
        });
    });

    $('#update_user').on("click", function(){
        let id = $('#u_id').val();
        let ime = $('#ufname').val();
        let prezime = $('#ulname').val();
        let email = $('#uemail').val();
        let password = $('#upassword').val();
        let role = $('#u_role').val();
        let uactive = $("#uactive").val();

        if(password == ""){
            password = null;
        }

        $.ajax({
            url: base_url+"/edituser",
            method: "post",
            data: {
                u_id: id,
                first_name: ime,
                last_name: prezime,
                email: email,
                password: password,
                role_id: role,
                active: uactive
            },
            success: function(data, textStatus, jqXHR){
                alert("User is updated successfully!");
                location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
                if(jqXHR.status == 422){
                    alert("Password can't be empty, and must be in correct format!");
                }
            }
        });
    });

    $('#add-user').on("click", function(){
        let ime = $('#ifname').val();
        let prezime = $('#ilname').val();
        let email = $('#iemail').val();
        let password = $('#ipassword').val();
        let role = $('#irole').val();
        let uactive = $("#iactive").val();

        if(password == ""){
            password = null;
        }

        $.ajax({
            url: base_url+"/register",
            method: "post",
            data: {
                first_name: ime,
                last_name: prezime,
                email: email,
                password: password,
                role_id: role,
                active: uactive
            },
            success: function(data, textStatus, jqXHR){
                alert("User is added successfully!");
                location.reload(true);
            },
            error: function(jqXHR, textStatus, errorThrown){
                console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
                if(jqXHR.status == 422){
                    alert("Password can't be empty, and must be in correct format!");
                }
            }
        });
    });
});

function obrisiProizvod (id) {
        
    
    $.ajax({
        url: "/php2sajt1/deleteproduct",
        method: "post",
        dataType: "json",
        data: {product_id: id},
        success: function(data, textStatus, jqXHR){
            //console.log(data);
            console.log(textStatus + ": " + jqXHR.status);
            alert("Uspesno brisanje");
            location.reload(true);

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
    });

}

obrisiKategoriju = id => {
    $.ajax({
        url: "/php2sajt1/deletecategory",
        method: "post",
        dataType: "json",
        data: {product_id: id},
        success: function(data, textStatus, jqXHR){
            //console.log(data);
            console.log(textStatus + ": " + jqXHR.status);
            alert("Uspesno brisanje");
            location.reload(true);

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
    });
}

obrisiBrend = id => {
    $.ajax({
        url: "/php2sajt1/deletebrand",
        method: "post",
        dataType: "json",
        data: {product_id: id},
        success: function(data, textStatus, jqXHR){
            //console.log(data);
            console.log(textStatus + ": " + jqXHR.status);
            alert("Uspesno brisanje");
            location.reload(true);

        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(textStatus + ": " + jqXHR.status + " " + errorThrown);
        }
    });
}