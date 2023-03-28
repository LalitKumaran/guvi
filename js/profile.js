function update(){
      var data = {
        fname: $("#fname").text(),
        lname: $("#lname").text(),
        age: $("#age").text(),
        mobile: $("#mobile").text(),
        action: "profile",
      }
      $.ajax({
        url: 'http://localhost/guvi/php/profile.php',
        type: 'POST',
        data: data,
        success:function(response){
          alert(response);
          if(response == "Updated Successfully"){
            window.location.reload();
          }
        }
      });
}

function load(){
  $.ajax({
    type:'POST',
    url: 'http://localhost/guvi/php/profile.php',
    data: {
        session_id: localStorage.getItem('session_id') ? localStorage.getItem('session_id')
        : 'empty',
        action:"profile"
    },
    success: function (response) {
      if (response.includes('User Not Found')) {
        location.href = './register.html'
      }
      else{
        var data = JSON.parse(response);
      $('#fname').text(data['fname']);
      $('#lname').text(data['lname']);
      $('#email').text(data['email']);
      $('#age').text(data['age']);
      $('#mobile').text(data['mobile']);
      }
    },
      error: function (xhr, status, error) {
        console.log(xhr, error)
      },
    });
  }

  function logout() {
    $.ajax({
      type: 'POST',
      data:{action:"logout"},
      url: 'http://localhost/guvi/php/logout.php',
      success: function(response){
        if(response == "Logged out"){
          localStorage.clear();
          alert("Session Expired")
          window.location.href = './index.html';
        }
      },
      error:function (xhr, status, error) {
        console.log(xhr, status, error)
      },
      }
    );
  }