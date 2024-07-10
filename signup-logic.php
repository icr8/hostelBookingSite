<?php

require "config/database.php";

if($_SERVER['REQUEST_METHOD']== "POST"){

    //Check if submit button was clicked
    if(isset($_POST['registerUser'])){

        //getting data from form

        //getting hostel admin account info
        $firstName = filter_var(trim($_POST['firstName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $lastName = filter_var(trim($_POST['lastName'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $userName = filter_var(trim($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $email = filter_var(trim($_POST['email'], FILTER_SANITIZE_EMAIL));
        $gender = filter_var(trim($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $password = filter_var(trim($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $confirmPassword = filter_var(trim($_POST['confirmPassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
        
        //Checking if textfields is not empty
        if(!$firstName){

            $_SESSION['signup'] = "Enter your first name!";
           
        }
        elseif(!$lastName){

            $_SESSION['signup'] = "Enter last name!";
             
    
            }
        elseif(!$userName){

        $_SESSION['signup'] = "Enter username!";
         

        }

        elseif(!$email){

        $_SESSION['signup'] = "Enter email!";
            

        }

        elseif(!$gender){

        $_SESSION['signup'] = "Choose Gender!";
            

        }
        
        elseif(!$password){

            $_SESSION['signup'] = "Enter password!";
                
    
        }

        elseif(strlen($confirmPassword) < 8 || strlen($password) < 8){

            $_SESSION['signup'] = "Password should be 8+ characters!";
                
    
        }
        
        else{

            //check if password do not match
            if($confirmPassword !== $password){
                $_SESSION['signup'] = "Paasword do not Match!";

            }
            
            else{
                //hash password
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                
                //check if username or email already exist in database
                $user_check_query = "SELECT * FROM adminaccount WHERE username='$userName' OR email='$email'";
                $user_check_result = mysqli_query($connection, $user_check_query);
                
                if(mysqli_num_rows($user_check_result)>0){
                    $_SESSION['signup'] = "Username or Email already exits";
                }

                else{

                    //Generating Index for users
                    Do{
                        $userId = rand(10000000,99999999);

                        $idQuery = "SELECT * FROM users WHERE userId = $userId";
                        $idResult = mysqli_query($connection,$idQuery);

                    }while($idResult->num_rows > 0);

                                //insert users info into users table
                    $insert_users_query =$connection->prepare( "INSERT INTO  users (userId, firstName, lastName, userName, gender, email, password) VALUES(?,?,?,?,?,?,?)");
                    $insert_users_query ->bind_param("issssss", $userId, $firstName, $lastName, $userName, $gender, $email, $hashPassword);
                    $insert_users_query->execute();
                   


                }
                

            }


        }


    //redirect to signup page if there was any problem
    if(isset($_SESSION['signup'])){
        //pass from data back to signup page
        $_SESSION['signup-data'] =$_POST;

        header('location: ' . 'signup.php');
        die();
    }
           
        
    if(!mysqli_errno($connection)){
        //redirect to login page with success page
        $_SESSION['signup-success'] = "Registration successful!";
        header('location: ' .'login.php');
        die();
    }
    
    }



    }else{
        header('Location: ' . 'signup.php');
        die();
    }
