<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
//in this if statement, we be checking if the email that the user inputted is valid or not. 

if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    //if email is valid
    //now check if email exist already in the database or not. 
    $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
    if(mysqli_num_rows($sql) > 0){ //this states if the email address already exist then tell that to the user 
        echo "$email - this email already exist! ";
    }
    else{ //in this else statment we will check if the user upplad a filer or not (image I mean)
        if(isset($_FILES['image'])){
            //check if file is uploaded 
            $img_name = $_FILES['image']['name']; //this line is to make the user upload an image type 
            $tmp_name = $_FILES['image']['tmp_name']; //this line is to make a temprary name will be used to save or move the file in our folder

            //now we will expload an image the get the last extension like jpg, png etc
            $img_explode = explode('.', $img_name);
            $img_ext = end($img_explode); //in this line, we get the extension of a user uploaded img file 
            
            $extensions = ['png', 'jpeg', 'jpg']; //those types are the valid img ext and they will be stored in array
            if(in_array($img_ext, $extensions) === true){ //this is if the user is uploaded img ext is matched with array extensions
                
                $time = time(); //this will return us current time.. then each image will have a unique name
                //we will move the user upload image to our folder
                $new_img_name = $time.$img_name; //current time will be added before the name of user uploaded img. So if user upload two different images with the same name then the name of a particulate image will be unique with adding time. 
                echo "$tmp_name This file works";
                if(move_uploaded_file($tmp_name, "./images/".$new_img_name)){ //if user upload img move to our folder successfully 
                 
                  $status = "Active now"; //once the user signed up then his status will be active now
                  $random_id = rand(time(), 1000000); //this line is to create a random id for user

                  //now lets insder all user data inside table
                  $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                      VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{ $status}')");
                    if($sql2){ //if these data inserted 
                        $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                        if(mysqli_num_rows($sql3) > 0){
                            $row = mysqli_fetch_assoc($sql3);
                            $_SESSION['unique_id'] = $row['unique_id']; //using this session to use the user unique_id in other php files as well.
                            echo "success";
                        }
                    
                }else{
                    echo "Something went wrong!";
                }
            }
            }else{
                echo "Please select an Image file - jpeg, jpg, png!";
            }

        }else{           
            echo "Please upload an image file!";
        }
    }
}else{
    echo"$email is not a valid email";
}
    }
    else{
        echo "All input field are required";
    }
?>
