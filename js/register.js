function register(){
    $(document).ready(function(){
      var data = {
        email: $("#email").val(),
        password: $("#password").val(),
        action: "register",
      };

      $.ajax({
        url: 'http://localhost/guvi/php/register.php',
        type: 'post',
        data: data,
        success:function(response){
          alert(response);
          if(response == "Registration Successful"){
            window.location.replace('login.html');
          }
        }
      });
    });
  }