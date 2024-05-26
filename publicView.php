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
            background-color: #6c757d; /* Set your desired background color */
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
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 0.5em;
        }

        .user-profession {
            font-size: 1.2em;
            font-weight: bold;
            color: gray;
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
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 1em;
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
        }

        .contact-info i {
            margin-right: 10px; /* Add space between icons and text */
        }


        /* Dark mode styles */
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }

        #contact.dark-mode {
            background-color: #333333;
        }

        /* New Toggle Switch Styles */
        .checkbox-wrapper-51 input[type="checkbox"] {
            visibility: hidden;
            display: none;
        }

        .checkbox-wrapper-51 .toggle {
            position: relative;
            display: block;
            width: 42px;
            height: 24px;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
            transform: translate3d(0, 0, 0);
        }

        .checkbox-wrapper-51 .toggle:before {
            content: "";
            position: relative;
            top: 1px;
            left: 1px;
            width: 40px;
            height: 22px;
            display: block;
            background: #c8ccd4;
            border-radius: 12px;
            transition: background 0.2s ease;
        }

        .checkbox-wrapper-51 .toggle span {
            position: absolute;
            top: 0;
            left: 0;
            width: 24px;
            height: 24px;
            display: block;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(154,153,153,0.75);
            transition: all 0.2s ease;
        }

        .checkbox-wrapper-51 .toggle span svg {
            margin: 7px;
            fill: none;
        }

        .checkbox-wrapper-51 .toggle span svg path {
            stroke: #c8ccd4;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 24;
            stroke-dashoffset: 0;
            transition: all 0.5s linear;
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked + .toggle:before {
            background: #1175c7;
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked + .toggle span {
            transform: translateX(18px);
        }

        .checkbox-wrapper-51 input[type="checkbox"]:checked + .toggle span path {
            stroke: #000000;
            stroke-dasharray: 25;
            stroke-dashoffset: 25;
        }

        .navbar .dark-mode-toggle {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        .navbar {
            padding: 0.5rem 0.75rem;
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1rem;
            font-weight: 500;
            padding: 0 0.5rem;
            color: #185ee0;
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: #0045b3;
            text-decoration: none;
        }

        .navbar-expand-lg .navbar-nav {
            flex-direction: row;
        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding: 0 0.5rem;
        }

        .dark-mode-toggle {
            margin-left: auto;
        }

        .tabs * {
            z-index: 2;
        }

        .container input[type="radio"] {
            display: none;
        }

        .notification {
            display: flex;
            align-items: center;
            justify-content: center;
            width: .8rem;
            height: .8rem;
            position: absolute;
            top: 10px;
            left: 30%;
            font-size: 10px;
            margin-left: 0.75rem;
            border-radius: 50%;
            margin: 0px;
            background-color: #e6eef9;
            transition: 0.15s ease-in;
        }

        .container input[type="radio"]:checked + label {
            color: #185ee0;
        }

        .container input[type="radio"]:checked + label > .notification {
            background-color: #185ee0;
            color: #fff;
            margin: 0px;
        }

        .container input[id="radio-1"]:checked ~ .glider {
            transform: translateX(0);
        }

        .container input[id="radio-2"]:checked ~.glider {
            transform: translateX(100%);
        }

        .container input[id="radio-3"]:checked ~ .glider {
            transform: translateX(200%);
        }

        .container input[id="radio-4"]:checked ~ .glider {
            transform: translateX(300%);
        }

        .container input[id="radio-5"]:checked ~ .glider {
            transform: translateX(400%);
        }

        @media (max-width: 700px) {
            .tabs {
                transform: scale(0.6);
            }
        }


    .project-card{
        display:flex
    }

    .project_card {
    background-color: aqua;
    width: 200px;
    height: 200px;
    margin:10px
    }

    .project-card div img {
    width: 100%;
    height: 100%;

}
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <section id="profile">
            <div class="row">
                <div class="col-md-6">
                    <header>
                        <p class="user-name"><?php echo $row['full_name'] ?></p>
                        <p class="user-profession"><?php echo $row['profession'] ?></p>
                        <div class="bio">
                            <p><?php echo $row['bio'] ?></p>
                        </div>
                        <div class="contact-info">
                            <p><i class="fas fa-map-marker-alt"></i><?php echo $row['address'] ?></p>
                            <p><i class="fas fa-phone"></i> <?php echo $row['phone_number'] ?></p>
                            <p><i class="fas fa-envelope"></i> <?php echo $row['email'] ?></p>
                        </div>
                        
                       
                    </header>
                  
                </div>
                <div class="col-md-6 text-right">
                    <img src="<?php echo $row['image'] ?>" alt="Profile Picture" class="profile-pic">
                </div>
            </div>
        </section>
        <div id="education">
            <div class="container">
                <h2>Education</h2>
                <?php
                    // Assuming $row['education'] contains the JSON string for education history
                    $education = json_decode($row['education']);
                    if (!empty($education)) {
                        echo "<ul>";
                        foreach ($education as $edu) {
                            echo "<li>$edu</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No education history available.</p>";
                    }
                ?>
            </div>
        </div>
        <div id="skills">
            <div class="container">
                <h2>Skills</h2>
                <?php
                    // Assuming $row['education'] contains the JSON string for education history
                    $skill = json_decode($row['skills']);
                    if (!empty($skill)) {
                        echo "<ul>";
                        foreach ($skill as $ski) {
                            echo "<li>$ski</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No education history available.</p>";
                    }
                ?>
            </div>
        </div>
        <div id="projects">
            <div class="container">
                <h2>Projects</h2>
                <div class="project-card">
                <?php
                    // Assuming $projects_json contains the JSON string for project data
                    $projects = json_decode($row['projects'], true);

                    if (!empty($projects)) {
                        
                        
                        foreach ($projects as $project) {
                            echo '<div class="project_card">';
                            echo '<img src="'.htmlspecialchars($project['image']).'" alt="">'; // Output the image
                            echo '<span>'.htmlspecialchars($project['description']).'</span>'; // Output the description
                            echo '</div>';
                        }
                        
   
                    } else {
                        // Handle case when there are no projects
                        echo 'No projects found.';
                    }
                    ?> 
                </div>
            </div>
        </div>
        <div id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info">
                        <h3>Address: <?php echo $row['address'] ?></h3>
                            <h3>Phone: <?php echo $row['phone_number'] ?></h3>
                            <h3>Email: <?php echo $row['email'] ?></h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Add any content here if you want -->
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        // Dark mode toggle
        const darkModeToggle = document.getElementById('cbx-51');
        
        darkModeToggle.addEventListener('change', function() {
            document.body.classList.toggle('dark-mode');
            document.getElementById('contact').classList.toggle('dark-mode');
            
            // Smooth transition for navbar background color
            const navbar = document.querySelector('.navbar');
            navbar.style.transition = 'background-color 0.5s ease';
            navbar.style.backgroundColor = document.body.classList.contains('dark-mode') ? '#343a40' : '#f8f9fa';
        });
    </script>
</body>
</html>
