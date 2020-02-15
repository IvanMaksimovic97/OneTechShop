$(document).ready(function(){

    var alerts = document.getElementsByClassName("fdb");
    for(let i=0; i < alerts.length; i++){
        alerts[i].style.display = "none";
    }
        

    $("#reg").on("click", function(e){

        for(let i=0; i < alerts.length; i++){
            alerts[i].style.display = "none";
        }

        let ok = true;

        let ime = $('#fname').val();
        let prezime = $('#lname').val();
        let email = $('#email').val();
        let pass = $('#password').val();
        let cf_pass = $('#password_confirm').val();

        const regImePrez = /^[A-ZŽĆČĐŠ][a-zžćčđš]{2,}$/;
        const regPass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
        const regEmail = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;

        if(!regImePrez.test(ime)){
            alerts[0].style.display = "block";
            ok = false;
        }

        if(!regImePrez.test(prezime)){
            alerts[1].style.display = "block";
            ok = false;
        }

        if(!regEmail.test(email)){
            alerts[2].style.display = "block";
            ok = false;
        }

        if(!regPass.test(pass)){
            alerts[3].style.display = "block";
            ok = false;
        }

        if(pass != cf_pass){
            alerts[4].style.display = "block";
            ok = false;
        }

        if(ok){
            var base_url = "http://localhost:8080/php2sajt1";

            $.ajax({
                url: base_url+"/register",
                method: "post",
                dataType: "json",
                data: {
                    first_name: ime,
                    last_name: prezime,
                    email: email,
                    password: pass
                },
                success: function(data, textStatus, jqXHR){
                    
                    alert("Successful registration, you can log in now!");
                    window.location.replace(base_url+"/pagelogin");
        
                },
                error: function(jqXHR, textStatus, errorThrown){
                    switch(jqXHR.status){
                        case 409 : alert("User already exist with that email address"); break;
                    }
                    alert(jqXHR.status);
                    alert(textStatus);
                    alert(errorThrown);
                }
            });
        }
        else
        {
            e.preventDefault();
        }

    });


});