<?php
try{
$conn=mysqli_connect('localhost','root',"",'test');
     }catch(throwable $h){
            echo 'database error';
     }

extract($_POST);

if(isset($_POST['readrecord'])){
    $data='
            <table class="table table-bordered table-striped">
                <tr>
                    <th>No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Edit </th>
                    <th>Delete </th>
                </tr>    
    ';
    $displayQuery="SELECT * from crud";
    $result=mysqli_query($conn,$displayQuery);

    if(mysqli_num_rows($result)>0){
        $number=1;
        while ($row=mysqli_fetch_array($result)) {
            $data .= '
            
                    <tr>
                    <td>'.$number.'</td>
                    <td>'.$row['firstname'].'</td>
                    <td>'.$row['lastname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['mobile'].'</td>
                    <td>
                        <button onclick="GetUserDetails('.$row['id'].')" class="btn btn-warning">Edit</button>
                    </td>
                    <td>
                    <button onclick="DeleteUser('.$row['id'].')" class="btn btn-danger">Delete</button>
                </td>
                <tr>
            ';
            $number++;
            echo $number++;
        }
    }
    $data .='</table>';
    echo $data;
}


    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile'])){

        $query=" INSERT INTO `crud`(`firstname`, `lastname`, `email`, `mobile`) VALUES ('$firstname','$lastname','$email','$mobile')";
        mysqli_query($conn,$query);
    }



    if(isset($_POST['deleteid'])){


        $userid=$_POST['deleteid'];

        $deleteQuery="DELETE from crud  where id='$userid'";
        mysqli_query($conn,$deleteQuery);
    }






    if(isset($_POST['id']) && isset($_POST['id'])!=""){

        $user_id=$_POST['id'];
        $query="SELECT * from crud WHERE id='$user_id'";
        if(!$result=mysqli_query($conn,$query)){
            exit(mysqli_error());
        }

        $response=array();


        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $response=$row;
            }
        }
        else{
            $response['status']=200;
            $response['message']="Data not found";
        }
        echo json_encode($response);

    }else{
        $response['status']=200;
        $response['message']="invalid request";
    }




    if(isset($_POST['Uhidden_user_id'])){
        
        $hidden_user_id=$_POST['Uhidden_user_id'];
        $firstname=$_POST['Ufirstname'];
        $lastname=$_POST['Ulastname'];
        $email=$_POST['Uemail'];
        $mobile=$_POST['Umobile'];

        $query="UPDATE `crud` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`mobile`='$mobile' WHERE id='$hidden_user_id'";

        mysqli_query($conn,$query);
    }
?>
