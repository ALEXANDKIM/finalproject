<?php
session_start();
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_FILES["image"]['size'] != 0) {
        $targetDir = "uploads/"; // Specify the directory where you want to store uploaded images
        $imageName = $_FILES["image"]["name"];
        $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $targetFile = $targetDir . uniqid() . '_' . $imageName; // Append a unique identifier to the filename
        $uploadOk = 1;

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($targetFile)) . " has been uploaded.";
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
            $targetFilePath = "uploads/" . basename($_FILES['projectimage']['name'][$key]);
            move_uploaded_file($tmpFilePath, $targetFilePath);
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

    // Process education data
    $education = [];
    if (isset($_POST['degree']) && isset($_POST['institution'])) {
        $degrees = $_POST['degree'];
        $institutions = $_POST['institution'];
        for ($i = 0; $i < count($degrees); $i++) {
            if (!empty($degrees[$i]) && !empty($institutions[$i])) {
                $education[] = [
                    'degree' => $degrees[$i],
                    'institution' => $institutions[$i]
                ];
            }
        }
    }
    $education_json = json_encode($education);

    // Process skill data
    $skills = isset($_POST['skill']) ? json_encode(array_filter($_POST['skill'], 'strlen')) : json_encode([]);

    // Prepare SQL statement for update
    if ($_FILES["image"]['size'] != 0) {
        $sql = "UPDATE `user_profile` SET 
            profession = ?,
            full_name = ?,
            bio = ?,
            address = ?,
            phone_number = ?,
            email = ?,
            education = ?,
            skills = ?,
            projects = ?,
            image = ?
            WHERE user_id = ?";
    } else {
        $sql = "UPDATE `user_profile` SET 
            profession = ?,
            full_name = ?,
            bio = ?,
            address = ?,
            phone_number = ?,
            email = ?,
            education = ?,
            skills = ?,
            projects = ?
            WHERE user_id = ?";
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        if ($_FILES["image"]['size'] != 0) {
            $stmt->bind_param("ssssssssssi", $profession, $full_name, $bio, $address, $phone_number, $email, $education_json, $skills, json_encode($projects), $targetFile, $_SESSION['user_id']);
        } else {
            $stmt->bind_param("sssssssssi", $profession, $full_name, $bio, $address, $phone_number, $email, $education_json, $skills, json_encode($projects), $_SESSION['user_id']);
        }

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to success page or any other appropriate action
            header("Location: secondpage.php");
            exit();
        } else {
            echo "Error executing statement: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }



// Add error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Handle Profile Picture Upload
// -------------------------------------------
$profile_picture = '';
$allowed_types = ['image/jpeg', 'image/png', 'image/gif']; // Allowed image types

// Check if form is submitted and a file is uploaded
if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK) {
    // Check if the file type is allowed
    if (!in_array($_FILES["profile_picture"]["type"], $allowed_types)) {
        $error_message = urlencode("Invalid file type. Please upload an image (JPEG, PNG, or GIF).");
        header("Location: user_profile.php?error=$error_message"); // Redirect with error message
        exit(); 
    }
    
    // Initialize variable for profile picture content
    $profile_picture_content = '';

    // Get the temporary file path
    $profile_picture = $_FILES["profile_picture"]["tmp_name"];

    // Read file contents
    $profile_picture_content = file_get_contents($profile_picture);

    // Check if file contents were read successfully
    if ($profile_picture_content === false) {
        echo "Failed to read profile picture file.";
        exit(); // Exit script if failed to read file
    }

    // Escape blob data
    $profile_picture_content = mysqli_real_escape_string($conn, $profile_picture_content);
}

// Include profile picture update only if it was uploaded
if (!empty($profile_picture_content)) {
    // Assuming $conn is your database connection
    $user_id = $_SESSION['user_id']; // Assuming you have a session variable for user_id
    // Update profile picture content in the database
    $update_query = "UPDATE users SET profile_picture = '$profile_picture_content' WHERE user_id = $user_id";
    if (mysqli_query($conn, $update_query)) {
        // Profile picture updated successfully
        header("Location: user_profile.php?success=" . urlencode("Profile picture updated successfully"));
        exit();
    } else {
        // Error updating profile picture
        echo "Error updating profile picture: " . mysqli_error($conn);
        exit();
    }
} else {
    // No profile picture uploaded
    header("Location: user_profile.php?error=" . urlencode("No profile picture uploaded"));
    exit();
}
?>

    // Close connection
    $conn->close();
}




?>
