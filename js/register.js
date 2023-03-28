function register(){
    $(document).ready(function(){
      var data = {
        email: $("#email").val(),
        password: $("#password").val(),
        action: "register",
      };

      $.ajax({
        url: 'http://localhost/guvi/php/register.php',
        type: 'POST',
        data: data,
        success:function(response){
          localStorage.clear();
          alert(response);
          if(response == "Registration Successful"){
            window.location.replace('login.html');
          }
        },
        error:function(xhr,status,error){
            console.log(error)
            window.location.replace('index.html');
        }
      });
    });
  }