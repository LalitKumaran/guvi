function upadate(){
    $(document).ready(function(){
      var data = {
        fname: $("#fname").val(),
        lname: $("#lname").val(),
        age: $("#age").val(),
        mobile: $("#mobile").val(),
        action: "profile",
    };
      console.log($("#age").val())
      $.ajax({
        url: 'http://localhost/guvi/php/profile.php',
        type: 'post',
        data: data,
        success:function(response){
          alert(response);
          if(response == "Updated Successfully"){
            document.getElementById("update-form").hidden = true;
            window.location.reload();
          }
        }
      });
    });
  }
function loadform(){
    document.getElementById("update-form").hidden = false;
}

function load(){
  $.ajax({
    type:'POST',
    url: 'http://localhost/guvi/php/profile.php',
    data: {
        sessionId: localStorage.getItem('session_id') ? localStorage.fetItem('session_id')
        : 'empty',
    },
    success: function (response) {
      if (!response.includes('no user')) {
      var data = JSON.parse(response);
      $('#fname').text(data['fname']);
      $('#lname').text(data['lname']);
      $('#age').text(data['age']);
      $('#mobile').text(data['mobile']);
      }
      else{
        location.href = './register.html'
      }
    },
      error: function (xhr, status, error) {
        console.log(xhr, error)
      },
    });
  }

  function logout() {
    $.ajax({
      type: 'GET',
      url: 'http://localhost/guvi/php/profile.php',
    });
    localStorage.clear();
    window.location.href = './index.html';
  }