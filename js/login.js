function load() {
  $.ajax({
    type: 'GET',
    url: '../php/register.php',
    success: function (response) {
      if (response.includes('Session Exists')) {
        window.location.href = '../profile.html';
      }
    },
  });
}
function login(){
    $(document).ready(function(){
      var data = {
        email: $("#email").val(),
        password: $("#password").val(),
        action: "login",
    };

      $.ajax({
        url: 'http://localhost/guvi/php/login.php',
        type: 'post',
        data: data,
        success:function(response){
          alert(response);
          if(response == "Login Successful"){
            localStorage.setItem('session_id', response);
            window.location.href = './profile.html';
          }
        }
      });
    });
  }

function newuser(){
    window.location.replace('register.html')
}