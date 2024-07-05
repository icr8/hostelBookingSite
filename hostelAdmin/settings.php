<?php
    include'./partials/header.php';

    //checking if update button was clicked


    $DisplayHostelInfoQuery = "SELECT h.hostelName, a.username, h.hosteldescription, h.hostelLocation,
     h.hostelCapacity,h.hostelPolicy, h.hostelContact, a.email FROM adminaccount a
      INNER JOIN hostels h ON a.hostelId = h.hostelId WHERE a.hostelId = $hostelId";
    
    $DisplayHostelInfoResult = mysqli_query($connection,$DisplayHostelInfoQuery);
    
    if(mysqli_num_rows($DisplayHostelInfoResult) > 0){

    $info = mysqli_fetch_assoc($DisplayHostelInfoResult);

    $hostelName2 = $info['hostelName'];
    $hostelUsername = $info['username'];
    $hostelDescription = $info['hosteldescription'];
    $hostelLocation = $info['hostelLocation'];
    $hostelBeds = $info['hostelCapacity'];
    $hostelPolicy = trim($info['hostelPolicy']);
    $hostelPhone = $info['hostelContact'];
    $hostelEmail =$info['email'];

    }

    

?>

    <main class="body-container widthIncreaseToNinety">
        <div class="summary page-con">

        <div class="mes">
        
        <?php if(isset($_SESSION['updated-success'])) : ?>
        <div class="message success ">
          <p>
          <?= $_SESSION['updated-success'];
              unset($_SESSION['updated-success'])
          ?>
          </p>
        </div>
      
        <?php elseif (isset($_SESSION['updated-error'])) : ?>
          <div class="message error ">
          <p>
          <?= $_SESSION['updated-error'];
              unset($_SESSION['updated-error'])
          ?>
          </p>
        </div>
        <?php endif ?>

        </div>

            <div id="profile" class="profileLayer widthIncreaseToNinety">
                <form action="settings-logic.php" method="POST" class="formCon">


                    <!--Edit button-->
                    <div class="editBtnCon">

                        <input id="edit" type="button" onclick="enableInputs()" value="Edit" class="btn"/>

                    </div>

                        <fieldset class="formCon column">
                            <legend>Hostel Info</legend>
                            <label for="hostelNameInput">Hostel Name:</label>
                            <input class="inputFields" name="hostelName" disabled type="text" <?php if(isset($hostelName2)) : ?> value="<?= $hostelName2?>" <?php else : ?> placeholder="Enter hostel name..." <?php endif ?>/>

                           
                            <label for="hostelUsername">Username:</label>
                            <input class="inputFields" name="hostelUsername" disabled type="text" <?php if(isset($hostelUsername)) : ?> value="<?= $hostelUsername?>" <?php else : ?> placeholder="Enter Username..." <?php endif ?>/>


                            <label for="hostelDescriptionInput">Hostel Description:</label>
                            <input class="inputFields" name="hostelDescription" disabled type="text" <?php if(isset($hostelDescription)) : ?> value="<?= $hostelDescription?>" <?php else : ?> placeholder="Enter Hostel Description..." <?php endif ?>/>

                            <label for="hostelLocation">Hostel Location:</label>
                            <input class="inputFields" name="hostelLocation" disabled type="text" <?php if(isset($hostelLocation)) : ?> value="<?= $hostelLocation?>" <?php else : ?> placeholder="Enter Location..." <?php endif ?>/>

                            <label for="hostelBeds">Total Number of Beds:</label>
                            <input class="inputFields" name="hostelBeds" disabled type="text" <?php if(isset($hostelBeds)) : ?> value="<?= $hostelBeds?>" <?php else : ?> placeholder="Enter Total Number of Beds..." <?php endif ?>/>

                            <label for="hostelPolicy">Hostel Policy:</label>
                            <textarea class="inputFields" style="width:100%; height:300px; padding:10px; font-size:medium; font-weight:bold" name="hostelPolicy" disabled  > 
                                <?php if(isset($hostelPolicy)) : ?>
                                <?= $hostelPolicy?>
                                <?php else : ?> 
                                <p>Enter Hostel Policy... </p>
                                <?php endif ?>
                            </textarea>


                        </fieldset>

                      
                        
                        
                        <fieldset class="formCon column">
                            <legend>Contact Info</legend>
                            <label for="hostelPhone">Phone:</label>
                            <input class="inputFields" name="hostelPhone" disabled type="text" <?php if(isset($hostelPhone)) : ?> value="<?= $hostelPhone?>" <?php else : ?> placeholder="+233 000 000 0000" <?php endif ?>/>

                            <label for="hostelEmail">Email:</label>
                            <input class="inputFields" name="hostelEmail" disabled type="text" <?php if(isset($hostelEmail)) : ?> value="<?= $hostelEmail?>" <?php else : ?> placeholder="example@gmail.com" <?php endif ?>/>


                        </fieldset>


                        


                        <!--Buttons fieldset-->
                        <fieldset class="formCon row settingsBtn">
                            
                            <input id="submit"  type="submit" class="btn" name="update" disabled value="Update" />
                            <input id="cancel" onclick="disableInput()" class="btn" disabled type="button" value="Cancel" />

                        </fieldset>

                    
                </form>

                
               

            </div>

            <!--Change Password fieldset-->
            <div class="changePass">
            <a id="password" href="changePassword.php" class="btn">Change Password </a>
                </div>

    </main>
<script defer src="\action.js"></script>
</body>
</html>