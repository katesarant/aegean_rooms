<?php



session_start();



$id = $_SESSION['id'];

if(isset($_POST["uploadfile"])){
        
          $img_name = $_FILES['avatar_pic']['name'];
          $img_size = $_FILES['avatar_pic']['size'];
          $tmp_name = $_FILES['avatar_pic']['tmp_name'];
          $error = $_FILES['avatar_pic']['error'];
        
              if($error == 0){
                if($img_size > 125000){
         
                  $em = "Sorry your file is too large!";
         
                  echo "<script>alert('".$em." try smaller than 125kb')</script>";
                  echo "<script>window.location.replace('../profile.php?upload=".$em."')</script>";
                }else{
        
           
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);
                    $allowed_exs = array("jpg","jpeg","png");
      
                    if(in_array($img_ex_lc,$allowed_exs)){
                        
                      $new_img_name = uniqid('IMG-').'.'.$img_ex_lc;

                      $target_dir = '../assets/avatar/';
                 
                  
                    
                      $img_upload_path = $target_dir.basename($new_img_name);
                   
                      $q   = (count(glob("$target_dir/*")) === 0) ? 'Empty' : 'Not empty';

                      if ($q !=="Empty") {

                            // specified folder
                            $files = glob("$target_dir/*"); 
                            
                            // Deleting all the files in the list
                            foreach($files as $file) {
                            
                                if(is_file($file)) 
                                
                                    // Delete the given file
                                    unlink($file); 
                            }
                            move_uploaded_file($tmp_name,$img_upload_path);

                      }else{
                    move_uploaded_file($tmp_name,$img_upload_path);
                    
                  }
                
   
                 

                     
                  ///// Insert into Database;
                  require_once 'db_connection.php';
                    
                      $sql = " UPDATE users SET profile_pic='$new_img_name' WHERE id = $id";
                         
                    //  header("Location: home.php");
              
                    if ($conn->query($sql) === TRUE) {
                    
                      
                        header("Location: ../profile.php?upload=success");

                     
                      } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                       
                      }
                      $conn->close();
                   

                    }else{
                      $em = "unknown error occured!";
                      header("Location: ../profile.php?error=$em");
                    }
                
                }
            
              }else{
                $em = "unknown error occured!";
                header("Location: ../profile.php?error=$em");
           
        
              }

        
        }else{
        
           header("Location: ../profile.php");
        }
        


        $conn->close();


?>