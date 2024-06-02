<?php
session_start();
include "db_conn.php";
// Assuming $user_id contains the user's unique identifier
$sql = "SELECT * FROM `user_profile` WHERE user_id = '".$_GET['user_id']."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch the data
    $row = mysqli_fetch_assoc($result);
    // Decode the JSON string for projects
   
} else {
    echo "No user found with ID: " . $user_id;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User's Name - Personal Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        /* Set height of the profile section to fill the viewport */
        #profile,
        #education,
        #skills,
        #projects {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Set height of the contact section to fill the viewport */
        #contact {
            min-height: 100vh;
            background-color: #151515; /* Set your desired background color */
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Center the headers */
        h1, h2 {
            margin-top: 0; /* Remove default margin */
        }

        /* Style the user's name and profession */
        .user-name {
    font-size: 3.5em;
    font-weight: bold;
    margin-bottom: 0.1em;
    white-space: nowrap; /* Ensure username stays on one line */
}


        .user-profession {
            font-size: 2.2em;
            font-weight: bold;
            color: gray;
            margin-bottom: 0.1em;
        }

        /* Style the profile picture */
        .profile-pic {
            width: 350px;
            height: 350px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Style the bio */
        .bio {
            font-size: 1em;
            font-weight: bold;
            margin-top: 0.1em;
        }

        /* Style the contact information */
        .contact-info {
            margin-top: 1em;
        }

        .contact-info h3 {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 0.5em;

        }

        .contact-info p {
            font-size: 0.9em;
            margin-bottom: 1em;
white-space: nowrap; /* Ensure username stays on one line */
            
        }

        .contact-info i {
            margin-right: 5px; /* Add space between icons and text */
        }

        /* Style the edit profile link */
        .edit-profile {
            position: absolute;
            bottom: -25px;
        }

        .edit-profile i {
            margin-right: 5px;
        }

     .blur-bg {
    background-image: url('your-blurred-background-image.jpg');
    background-size: cover;
    backdrop-filter: blur(8px); /* Adjust blur intensity as needed */
    -webkit-backdrop-filter: blur(8px); /* For Safari */
}
   
/* Your existing CSS styles */
    .blur-bg {
        background-image: url('your-blurred-background-image.jpg');
        background-size: cover;
        backdrop-filter: blur(8px); /* Adjust blur intensity as needed */
        -webkit-backdrop-filter: blur(8px); /* For Safari */
    }
    
    /* Styling for the navigation labels */
    .navbar-brand {
        color: white; /* Text color */
        font-size: 18px; /* Font size */
        font-weight: bold; /* Font weight */
        margin-right: 20px; /* Spacing between labels */
        cursor: pointer; /* Cursor style */
        transition: color 0.3s; /* Smooth color transition */
    }

    /* Hover effect for the navigation labels */
    .navbar-brand:hover {
        color: #ffc107; /* Change color on hover */
    }

    /* Additional styling for the logout button */
    .btn-logout {
        color: white;
        background-color: #dc3545;
        border: none;
        font-size: 16px;
        font-weight: bold;
        padding: 10px 20px;
        margin-left: 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    /* Hover effect for the logout button */
    .btn-logout:hover {
        background-color: #c82333; /* Darker shade of red on hover */
    }

    .profile-section {
    background-image: url('your-cool-background-image.jpg');
    background-size: cover;
    background-position: center;
    padding: 50px 0; /* Add some padding to the section if needed */
}
.content {
    background-image: url('your-cool-background-image.jpg');
    background-size: cover;
    background-position: center;
    padding: 50px 0; /* Add some padding to the section if needed */
}


body {

    cursor: none;
}
body h1 {
    color: #fff;
    font-family: "Protest Riot", sans-serif;
    font-size: 60px;
}
.cursor {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: deepskyblue;
    mix-blend-mode: difference;
    pointer-events: none;
    transform: translate(-50%, -50%);
    transition: width 0.3s, height 0.3s, background-color 0.3s;
    animation: glow 1s infinite alternate;
}
@keyframes glow {
    0% {
        box-shadow: 0 0 10px 5px rgba(0, 191, 255, 0.5);
    }
    100% {
        box-shadow: 0 0 20px 10px rgba(0, 191, 255, 0.9);
    }
}



    </style>




    <script>
        document.addEventListener('mousemove', e => {
            const cursor = document.querySelector('.cursor');
            cursor.style.left = e.pageX + 'px';
            cursor.style.top = e.pageY + 'px';
        });
    </script>

    


<style>
    #profile {
padding: 40px 0; /* Adjust padding as needed */
            background-color: #F0ECE5; /* Background color for skills section */
        }
    .profile-image-container {
  border: 2px solid blue; /* Blue border */
  border-radius: 50%; /* Circular shape */
  width: 150px; /* Adjust the size as needed */
  height: 150px;
  overflow: hidden; /* Hide overflow to keep the circle shape */
  margin: 0 auto; /* Center the image */
}

.profile-image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Maintain aspect ratio and cover the container */
}

.blue-border {
    border: 3px solid #31304D; /* Blue border color */
    padding: 3px; /* Adjust padding if needed */
}

.custom-card {
        background-color: transparent !important;
        border: none;
    }

</style>



    <!-- Main content -->
<section class="content">
  <section id="profile">
    <div class="container-fluid">
      <?php
      // Check for error messages (from both GET and session)
      if (isset($_GET['error'])) {
        $error_message = urldecode($_GET['error']);
        echo "<div class='alert alert-danger'>$error_message</div>";
      } elseif (isset($_SESSION['user_pass_error'])) {
        $error_message = $_SESSION['user_pass_error'];
        echo "<div class='alert alert-danger'>$error_message</div>";
        unset($_SESSION['user_pass_error']);  // Clear session error
      }

      // Check for success messages (from both GET and session)
      if (isset($_GET['success'])) {
        $success_message = urldecode($_GET['success']);
        echo "<div class='alert alert-success'>$success_message</div>";
      }
      ?>
      <div class="row justify-content-center">
    <div class="col-md-3">
        <div class="card card-primary card-outline mx-auto bg-transparent custom-card">
            <div class="card-body box-profile">
                <div class="text-center">

                    <img src="<?php echo $row['image'] ?>" alt="Profile Picture" class="profile-pic">

                </div>
                <!-- Rest of the profile content -->


              <h3 class="profile-username text-center" style="font-family: Arial, sans-serif; font-size: 35px; margin-top: 20px;">
    <strong><?php echo $row['full_name'] ?></strong><span></span>
</h3>



<style>
    .list-group {
        background-color: transparent;
        border: none; /* Remove any border */
    }

    .list-group-item {
        background-color: transparent;
        border: none; /* Remove any border */
    }

    .btn-custom {
        background-color: #F0ECE5; /* Specify your desired color */
        border-color: #; /* Specify your desired color */
    }

    .btn-custom:hover {
        background-color: #; /* Specify your desired hover color */
        border-color: #31304D; /* Specify your desired hover color */
    }

    /* Updated font and font size */
    .text-center,
    .text-muted {
        font-family: Arial, sans-serif;
        font-size: ypx;

    }

    .list-group-item strong {
        font-family: Arial, sans-serif;
        font-size: 25px;
    }

    .list-group-item p {
        font-family: Arial, sans-serif;
        font-size: 20px;
    }

    .list-group {
        background-color: transparent;
        border: none; /* Remove any border */
    }

    .list-group-item {
        background-color: transparent;
        border: none; /* Remove any border */
        margin-bottom: -16px; /* Adjust the bottom margin as needed */
    }

    .list-group-item strong {
        font-family: Arial, sans-serif;
        font-size: 25px;
    }

    .list-group-item p {
        font-family: Arial, sans-serif;
        font-size: 20px;
    }

</style>

 <nav class="navbar navbar-expand-lg navbar-light fixed-top blur-bg">
    <div class="container">

        <div class="tabs">
            <!-- Navigation tabs without checkboxes -->
            <label class="tab navbar-brand" data-target="#profile">Profile</label>
            <label class="tab navbar-brand" data-target="#education">Education</label>
            <label class="tab navbar-brand" data-target="#skills">Skills</label>
            <label class="tab navbar-brand" data-target="#projects">Projects</label>
            <label class="tab navbar-brand ml-auto" data-target="#contact">Contact Me</label>
            
            <span class="glider"></span>
        </div>
    </div>
</nav>


<ul class="list-group list-group-unbordered mb-3">
    <li class="list-group-item">
        <div class="text-center">
            <i></i> <strong><?php echo !empty($row['profession']) ? $row['profession'] : 'No profession specified' ?></strong>
        </div>
        <a class="float-right"></a>
    </li>
    <li class="list-group-item">
        <div class="text-center"> <!-- Add this div for center alignment -->
            <strong><i class=""></i></strong>
            <p class="text-muted"><?php echo $row['bio'] ?></p>
        </div>
    </li>
    <li class="list-group-item">
        <i class="fas fa-phone"></i> <?php echo !empty($row['phone_number']) ? $row['phone_number'] : 'No phone number provided' ?>
        <a class="float-right"></a>
    </li>
    <li class="list-group-item">
        <i class="fas fa-map-marker-alt"></i> <?php echo !empty($row['address']) ? $row['address'] : 'No address specified' ?>
        <a class="float-right"></a>
    </li>
    <li class="list-group-item">
        <i class="fas fa-envelope"></i> <?php echo !empty($row['email']) ? $row['email'] : 'No email available' ?>
        <a class="float-right"></a>
    </li>
</ul>

<div class="col-12">
    <a href="secondpage.php" class="btn btn-custom btn-block">Go back</a>
</div>

    


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
</section>




    
        <style>
           #education {
            padding: 40px 0; /* Adjust padding as needed */
            background-color: #B6BBC4; /* Background color for education section */
        }

        #education h2 {
            margin-bottom: 20px;
            font-size: 2em;
            font-weight: bold;
        }

        #education .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        #education .card h3 {
            margin: 0 0 10px 0;
        }

        #education .card p {
            margin: 0;
        }
        </style>
        <div id="education">
        <div class="container">
            <h2>Education</h2>
            <?php
            $education = json_decode($row['education'], true); // Decoding JSON string into an associative array
            if (!empty($education)) {
                foreach ($education as $edu) {
                    if (isset($edu['degree']) && isset($edu['institution'])) {
                        echo '<div class="card">';
                        echo '<h3>' . htmlspecialchars($edu['degree']) . '</h3>';
                        echo '<p>' . htmlspecialchars($edu['institution']) . '</p>';
                        echo '</div>';
                    }
                }
            } else {
                echo "<p>No education history available.</p>";
            }
            ?>
        </div>
    </div>


<style> 
#skills {
    position: relative;
    padding: 100px 0; /* Adjust padding as needed */
    
    color: white; /* Text color */
     background-image: url('img/home.pn'); /* Specify the path to your background image */
    background-size: cover; /* Cover the entire element with the background image */
    background-position: center; /* Center the background image */
}

#skills h2 {
    position: relative;
    z-index: 2; /* Ensure foreground text appears above the background text */
    margin-bottom: 30px; /* Adjust margin as needed */
    font-size: 3em; /* Increase font size */
    font-weight: bold;
    text-align: center;
}



.skills-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Responsive grid */
    gap: 20px; /* Space between grid items */
    justify-items: center;
}

.skill-card {
    background-color: #161A30; /* Card background color */
    border: 1px solid #222831; /* Card border */
    border-radius: 10px; /* Card border radius */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Card shadow */
    transition: box-shadow 0.3s ease-in-out; /* Smooth transition for shadow */
    width: 150px; /* Fixed width for portrait orientation */
    padding: 20px; /* Padding inside card */
    text-align: center; /* Center align the card content */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
}

.skill-card:hover {
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1); /* Increase shadow on hover */
}

.skill-card .card-text {
    margin: 0;
    font-size: 16px;
    text-align: center; /* Center text horizontally */
}

.skill-card .remove-skill-btn {
    border: none;
    background: none;
    color: #EEEEEE; /* Button color */
    font-size: 20px;
    cursor: pointer;
    transition: color 0.2s ease-in-out; /* Smooth transition for color */
}

.skill-card .remove-skill-btn:hover {
    color: #EEEEEE; /* Change color on hover */
}
</style>

    <div id="skills">
    <div class="container">
        <h2>My Skills</h2>
        <div class="skills-grid">
            <?php
            // Assuming $row['skills'] contains the JSON string for skills
            $skills = json_decode($row['skills']);
            if (!empty($skills)) {
                foreach ($skills as $skill) {
                    echo '<div class="skill-card">';
                    echo '<div class="card-body">';
                    echo '<p class="card-text">' . htmlspecialchars($skill) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No skills available.</p>";
            }
            ?>
        </div>
    </div>
</div>



<style>
    #projects {
        padding: 100px 0; /* Adjust padding as needed */
         color: white; /* Text color */
        background-color: #161A30; /* Background color for projects section */
    }
    .project_card {
        margin-bottom: 20px; /* Adjust spacing between project cards */
    }
    .project_card img {
        max-width: 100%; /* Ensure images don't exceed container width */
        height: auto; /* Maintain aspect ratio */
    }
</style>
<div id="projects">
    <div class="container">
        <h2>Projects</h2>
        <div class="project-card">
           <?php
// Assuming $profile_picture contains the profile picture content retrieved from the database
if (!empty($profile_picture)) {
    // Convert profile picture content to base64 format
    $profile_picture_base64 = base64_encode($profile_picture);
    // Output the image using the base64-encoded content
    echo '<img src="data:image/jpeg;base64,' . $profile_picture_base64 . '" alt="Profile Picture">';
} else {
    // Display a placeholder image if no profile picture is available
    echo '<img src="placeholder.jpg" alt="Placeholder Image">';
}
?>
        </div>
    </div>
</div>

        <style>

            #contact {
            min-height: 100vh;
            background-color: #577D86; /* Set your desired background color */
            color: white;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
            
            .form-container {
  width: 400px;
  background: linear-gradient(#212121, #212121) padding-box,
              linear-gradient(145deg, transparent 35%,#e81cff, #40c9ff) border-box;
  border: 2px solid transparent;
  padding: 32px 24px;
  font-size: 14px;
  font-family: inherit;
  color: white;
  display: flex;
  flex-direction: column;
  gap: 20px;
  box-sizing: border-box;
  border-radius: 16px;
}

.form-container button:active {
  scale: 0.95;
}

.form-container .form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-container .form-group {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.form-container .form-group label {
  display: block;
  margin-bottom: 5px;
  color: #717171;
  font-weight: 600;
  font-size: 12px;
}

.form-container .form-group input {
  width: 100%;
  padding: 12px 16px;
  border-radius: 8px;
  color: #fff;
  font-family: inherit;
  background-color: transparent;
  border: 1px solid #414141;
}

.form-container .form-group textarea {
  width: 100%;
  padding: 12px 16px;
  border-radius: 8px;
  resize: none;
  color: #fff;
  height: 96px;
  border: 1px solid #414141;
  background-color: transparent;
  font-family: inherit;
}

.form-container .form-group input::placeholder {
  opacity: 0.5;
}

.form-container .form-group input:focus {
  outline: none;
  border-color: #e81cff;
}

.form-container .form-group textarea:focus {
  outline: none;
  border-color: #e81cff;
}

.form-container .form-submit-btn {
  display: flex;
  align-items: flex-start;
  justify-content: center;
  align-self: flex-start;
  font-family: inherit;
  color: #717171;
  font-weight: 600;
  width: 40%;
  background: #313131;
  border: 1px solid #414141;
  padding: 12px 16px;
  font-size: inherit;
  gap: 8px;
  margin-top: 8px;
  cursor: pointer;
  border-radius: 6px;
}

.form-container .form-submit-btn:hover {
  background-color: #fff;
  border-color: #fff;
}
 .social-icons {
            margin-top: 20px;
            text-align: center;
        }

        .social-icons a {
            display: inline-block;
            margin: 0 10px;
            color: #717171;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        </style>
         <div id="contact">
        <div class="form-container">
            <form class="form">
                <div class="form-group">
                    <label for="email">Company Email</label>
                    <input type="text" id="email" name="email" required="">
                </div>
                <div class="form-group">
                    <label for="textarea">How Can We Help You?</label>
                    <textarea name="textarea" id="textarea" rows="10" cols="50" required=""></textarea>
                </div>
                <button class="form-submit-btn" type="submit">Submit</button>
            </form>
            <div class="social-icons">
                <a href="https://www.facebook.com"><i class="fab fa-facebook-square"></i></a>
                <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com"><i class="fab fa-twitter-square"></i></a>
            </div>
        </div>
    </div>

<div class="cursor"></div>


    <script>
        document.addEventListener('mousemove', e => {
            const cursor = document.querySelector('.cursor');
            cursor.style.left = e.pageX + 'px';
            cursor.style.top = e.pageY + 'px';
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQ=" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('.navbar-brand').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('data-target')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        
    </script>

    <script>
  document.addEventListener("DOMContentLoaded", function() {
    var fileInput = document.getElementById('profile_picture');

    fileInput.addEventListener('change', function(event) {
      var file = fileInput.files[0];
      var allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Add more allowed types if needed
      var fileType = file.type;

      if (!allowedTypes.includes(fileType)) {
        alert('Please select a valid image file (JPEG, PNG, GIF).');
        fileInput.value = ''; // Clear the file input
      }
    });
  });
</script>

</body>
</html>
