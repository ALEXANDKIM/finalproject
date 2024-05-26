
<?php
session_start();
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_FILES["image"]['size']!= 0){
        $targetDir = "uploads/"; // Specify the directory where you want to store uploaded images
        $imageName = $_FILES["image"]["name"];
        $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $targetFile = $targetDir . uniqid() . '_' . $imageName; // Append a unique identifier to the filename
        $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        // if ($_FILES["image"]["size"] > 5000000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if(!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars(basename($targetFile)). " has been uploaded.";
                
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    }
    
    $projects = [];

    foreach ($_FILES['projectimage']['tmp_name'] as $key => $tmp_name) {

        if (!empty($tmp_name)) {

            $tmpFilePath = $_FILES['projectimage']['tmp_name'][$key];
            

            $description = $_POST['projectDescription'][$key];
            
            // Move the uploaded file to a permanent location
            $targetFilePath = "uploads/" . basename($_FILES['projectimage']['name'][$key]);
            move_uploaded_file($tmpFilePath, $targetFilePath);
            
            // Add project data to the array
            $projects[] = [
                'description' => $description,
                'image' => $targetFilePath
            ];
        }
    }

    $full_name = $_POST['name'];
    $profession = $_POST['profession'];
    $bio = $_POST['bio'];
    $address = $_POST['address'];
    $phone_number = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $education = json_encode(array_filter($_POST['education'], 'strlen'));
    // Remove empty strings from the skill array
    $skills = json_encode(array_filter($_POST['skill'], 'strlen'));

    // Prepare SQL statement for update

    if($_FILES["image"]['size']!= 0){
        $sql = "UPDATE `user_profile` SET 
        profession = '$profession',
        full_name = '$full_name',
        bio = '$bio',
        address = '$address',
        phone_number = '$phone_number',
        email = '$email',
        education = '$education',
        skills = '$skills',
        projects= '".json_encode($projects)."',
        image = '$targetFile'
        WHERE user_id = '".$_SESSION['user_id']."'"; // Assuming full name is unique identifier for a user

    }else{
        $sql = "UPDATE `user_profile` SET 
        profession = '$profession',
        full_name = '$full_name',
        bio = '$bio',
        address = '$address',
        phone_number = '$phone_number',
        email = '$email',
        education = '$education',
        skills = '$skills',
        projects= '".json_encode($projects)."'
        WHERE user_id = '".$_SESSION['user_id']."'"; // Assuming full name is unique identifier for a user

    }
   
    if (mysqli_query($conn, $sql)) {
        // Redirect to success page or any other appropriate action
        header("Location: secondpage.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

// Close connection
$conn->close();
?>