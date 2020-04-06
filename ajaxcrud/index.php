<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
    
<div class="container">
<h1 class="text-primary text-uppercase text-center">ajax crup operation  </h1>

<div class="d-flex justify-content-end">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">
            Open modal
        </button>
</div>

<h2 class="text-danger">All Records</h2>

<div id="records_contant">


</div>



<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD operations</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
           <label for="">Firstname:</label>
           <input type="text" name="" id="firstname" class="form-control" placeholder="FirstName">
       </div>

       <div class="form-group">
           <label for="">Lastname:</label>
           <input type="text" name="" id="lastname" class="form-control" placeholder="LastName">
       </div>

       <div class="form-group">
           <label for="">Email:</label>
           <input type="text" name="" id="email" class="form-control" placeholder="Email">
       </div>

       <div class="form-group">
           <label for="">Mobile:</label>
           <input type="text" name="" id="mobile" class="form-control" placeholder="Mobile Number">
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        
      </div>

    </div>
  </div>
</div>




<!-- update mode -->


<!-- The Modal -->
<div class="modal" id="update_user-model">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD operations</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
           <label for="Update_Firstname">Update Firstname:</label>
           <input type="text" name="" id="Update_firstname" class="form-control" placeholder="FirstName">
       </div>

       <div class="form-group">
           <label for="Update_Lastname">Update Lastname:</label>
           <input type="text" name="" id="Update_lastname" class="form-control" placeholder="LastName">
       </div>

       <div class="form-group">
           <label for="Update_Email">Update Email:</label>
           <input type="text" name="" id="Update_email" class="form-control" placeholder="Email">
       </div>

       <div class="form-group">
           <label for="Update_Mobile">Update Mobile:</label>
           <input type="text" name="" id="Update_mobile" class="form-control" placeholder="Mobile Number">
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="UpdateUserDetails()">update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_user_id">
        
      </div>

    </div>
  </div>
</div>
</div>



<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script>

    $(document).ready(function(){
        readRecord();
    });
        function readRecord(){
            var readrecord = "readrecord";

            $.ajax({
                url:'backend.php',
                type:'post',
                data:{readrecord:readrecord},
                success: function(data,status){
                        $('#records_contant').html(data);
                }
            });
        }


    function addRecord(){

        var firstname =$('#firstname').val();
        var lastname =$('#lastname').val();
        var email =$('#email').val();
        var mobile =$('#mobile').val();

        $.ajax({

                url : 'backend.php',
                type : 'POST',
                data : {
                    firstname : firstname,
                    lastname : lastname,
                    email : email,
                    mobile : mobile
                },

                success: function(data,status){
                         readRecord();
                }

        });
    }


    function DeleteUser(deleteid){
        var conf = confirm("Are you sure");

        if(conf==true){
            
            $.ajax({
                url:'backend.php',
                type:'post',
                data:{deleteid:deleteid},
                success:function(data,status){
                    readRecord();
                }
            });
        }

    }





    function GetUserDetails(id){
                    $('#hidden_user_id').val(id);
                    $.post("backend.php",{id:id},function(data,status){
                        var user = JSON.parse(data);
                        $('#Update_firstname').val(user.firstname);
                        $('#Update_lastname').val(user.lastname);
                        $('#Update_email').val(user.email);
                        $('#Update_mobile').val(user.mobile);
                    });
                    
                $('#update_user-model').modal("show");
    }

    function UpdateUserDetails(){

                var Ufirstname = $('#Update_firstname').val();
                var Ulastname = $('#Update_lastname').val();
                var Uemail = $('#Update_email').val();
                var Umobile = $('#Update_mobile').val();
                var Uhidden_user_id=$('#hidden_user_id').val();
                $.post("backend.php",{
                    Uhidden_user_id:Uhidden_user_id,
                    Ufirstname:Ufirstname,
                    Ulastname : Ulastname,
                    Uemail : Uemail,
                    Umobile : Umobile

                },function(data,status){
                    $('#update_user_model').modal("hide");
                    readRecord();
                });
    }
</script>
</body>

</html>