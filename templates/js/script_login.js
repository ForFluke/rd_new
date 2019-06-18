function check_login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
  
    $.ajax({
        type: "POST",
        url: "?",
        data: {username: username, password: password},
        success: function(html){
            console.log(html);
            var Obj = JSON.parse(html);
            
            // if(Obj.status != 'correct'){

            //     alert('UserName OR Password Not Correct');
            //     window.location.href = "?"
            // }else{
            //     document.getElementById("password_correct").value = Obj.password;
            //     document.getElementById("username_correct").value = Obj.username;
            //     // document.getElementById("submit_login").submit();
            //     window.location.href = "profile.php"
            // }
        }
    });
}
