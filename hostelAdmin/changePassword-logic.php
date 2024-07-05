<?php
include'./partials/header.php';

if(isset($_POST['changePassword'])){

    $oldPassword = filter_var($_POST['oldPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $newPassword = filter_var($_POST['newPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //Getting old password from database
    $oldPassQuery = "SELECT password FROM adminaccount where hostelId = $hostelId";
    $oldPassResult = mysqli_query($connection, $oldPassQuery);

    if(mysqli_num_rows($oldPassResult) > 0){

        $data = mysqli_fetch_assoc($oldPassResult);
        $oldPassword2 = $data['password'];


        //checking if the typed old password is the same as the old password in the database
        if(password_verify($oldPassword, $oldPassword2)){

                //checking if the the new password textfield is empty
                if(!$newPassword){
                    $_SESSION['password-error'] = "Your Have not entered any new Password!";
                header('Location: ' . 'changePassword.php');
                die();
                }
            else{

                    //checking if the the confirm password textfield is empty
                if(!$confirmPassword){
                    $_SESSION['password-error'] = "Your Have not entered any Confirm Password!";
                header('Location: ' . 'changePassword.php');
                die();

                }
            else{


                //checking if the typed new password is same as the typed confirm password 
                if($newPassword == $confirmPassword){

                    $hashedPassword = password_hash($confirmPassword, PASSWORD_DEFAULT);

                    $insertQuery = $connection->prepare("UPDATE adminaccount SET password = ? WHERE hostelId = ? ");
                    $insertQuery->bind_param("si", $hashedPassword, $hostelId);
                    if($insertQuery->execute()){
                        $_SESSION['password-success'] = "You have successfully Changed your Password";

                        header('Location: ' . 'changePassword.php');
                        die();
                    }
                    else{
                        $_SESSION['password-error'] = "There was an error. Please try Again.";
                        header('Location: ' . 'changePassword.php');
                        die();
                    }

                }
                else{
                    $_SESSION['password-error']  = "Your new Password do not Match!";
                    header('Location: ' . 'changePassword.php');
                    die();
                }
            }
            }

        }

        else{
            $_SESSION['password-error'] = "Your Old Password is Incorrect!";
            header('Location: ' . 'changePassword.php');
            die();
        }

    }else{
        $_SESSION['password-error'] = "Error Occured!";
        header('Location: ' . 'changePassword.php');
        die();
    }




   

}
else{
    header('Location: ' . 'changePassword.php');
    die();
}