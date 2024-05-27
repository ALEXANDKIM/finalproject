<?php
session_start();
include "db_conn.php";
// Assuming $user_id contains the user's unique identifier
$sql = "SELECT * FROM `user_profile` WHERE user_id = '".$_SESSION['user_id']."'";
$result = mysqli_query($conn, $sql);

// Check if the user is not logged in, then redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: loginform.php');
    exit;
}

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
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      

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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <div class="tabs">
                <!-- Navigation tabs -->
                <input type="radio" id="radio-1" name="tabs" checked>
                <label class="tab navbar-brand" for="radio-1" data-target="#profile">Profile</label>
                <input type="radio" id="radio-2" name="tabs">
                <label class="tab navbar-brand" for="radio-2" data-target="#education">Education</label>
                <input type="radio" id="radio-3" name="tabs">
                <label class="tab navbar-brand" for="radio-3" data-target="#skills">Skills</label>
                <input type="radio" id="radio-4" name="tabs">
                <label class="tab navbar-brand" for="radio-4" data-target="#projects">Projects</label>
                <input type="radio" id="radio-5" name="tabs">
                <label class="tab navbar-brand ml-auto" for="radio-5" data-target="#contact">Contact Me</label>
                <span class="glider"></span>
                <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>
            </div>
            <!-- Dark mode toggle -->
            <div class="dark-mode-toggle checkbox-wrapper-51">
                <input type="checkbox" id="cbx-51">
                <label class="toggle" for="cbx-51">
                    <span>
                        <svg viewBox="0 0 44 44">
                            <path d="M22 4.54A17.46 17.46 0 1 0 39.46 22 17.46 17.46 0 0 0 22 4.54z"></path>
                        </svg>
                    </span>
                </label>
            </div>
        </div>
    </nav>

    <form action="submitProfile.php?id=132" method="post" enctype="multipart/form-data">
    <div class="container-fluid p-0">   
        <div class="form-container">`
            <div class="image-container">  
                <img src="<?php echo $row['image'] ?>" id="image-preview">
            </div>
            <input type="file" id="image-input" name="image" accept="image/*">
            
            <div class="information-container">
                <label for="full_name">Full name</label>
                <input type="text" name="name" id="full_name" value="<?php echo $row['full_name'] ?>" required>
                <label for="profession">Profession</label>
                <input type="text" name="profession" id="profession" value="<?php echo $row['profession'] ?>" required>
                <label for="bio">Bio</label>
                <textarea name="bio" id="bio" required><?php echo $row['bio'] ?></textarea >

                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="<?php echo $row['address'] ?>" required>
                <label for="phone_number" >Phone number</label>
                <input type="text" name="phoneNumber" id="phone_number" value="<?php echo $row['phone_number'] ?>" required>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>" required>  
                
                <div class="divider"></div>

                <div class="section-label">
                    <span>Education</span>
                    <button type="button" id="educ-btn">+</button>
                </div>
                <div class="education-input">

                    <?php
                        // Assuming $row['education'] contains the JSON string for education history
                        $education = json_decode($row['education']);
                        if (!empty($education)) {
                          
                            foreach ($education as $edu) {
                               

                                echo '<div class="educ-item">';
                                echo '<input type="text" name="education[]" id="education" value="'.$edu.'">';
                                echo '<button onclick="removeInput(this)" type="button" class="remove-skill-btn" >x</button>';
                                echo '</div>';
                            }
                       
                        } else {
            
                            echo '<div class="educ-item">';
                            echo '<input type="text" name="education[]" id="education">';
                            echo '<button onclick="removeInput(this)" type="button" class="remove-skill-btn" >x</button>';
                            echo '</div>';
                        }
                    ?>
           
                </div>
            

                <div class="section-label">
                    <span>Skills</span>
                    <button type="button" id="skill-btn">+</button>
                </div>
                <div class="skill-input">
                    <?php
                    // Assuming $row['education'] contains the JSON string for education history
                    $skill = json_decode($row['skills']);
                    if (!empty($skill)) {
                        foreach ($skill as $ski) {
                            echo '<div class="skill-item">';
                            echo '<input type="text" name="skill[]" value="'.$ski.'">';
                            echo '<button onclick="removeInput(this)" type="button" class="remove-skill-btn" >x</button>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="skill-item">';
                        echo '<input type="text" name="skill[]">';
                        echo '<button onclick="removeInput(this)" type="button" class="remove-skill-btn">x</button>';
                        echo '</div>';
                    }
                    ?>
                </div>

            </div>
            <div class="divider"></div>
            <div class="section-label">
                <span>Project</span>
                <button type="button" id="project-btn">+</button>
            </div>
            <div class="project-input">

            <?php
                    // Assuming $projects_json contains the JSON string for project data
                    $projects = json_decode($row['projects'], true);

                    if (!empty($projects)) {
                        
                        
                        foreach ($projects as $project) {
                            echo '<div class="project_card">';
                            echo '   <input type="file" id="" name="projectimage[]" accept="image/*" value="'.htmlspecialchars($project['image']).'" >'; // Output the image
                            echo '   <textarea name="projectDescription[]" id="" placeholder="'.htmlspecialchars($project['description']).'"></textarea>'; // Output the description
                            echo '</div>';
                        }
                        
                       } else {
                        // Handle case when there are no projects
                        echo '<div class="project_card">';
                        echo '   <input type="file" id="" name="projectimage[]" accept="image/*" >'; // Output the image
                        echo '   <textarea name="projectDescription[]" id="" placeholder="Project title"></textarea>'; // Output the description
                        echo '</div>';
                    }
            ?> 
            </div>
    
            
            
            <button type="submit" style="margin:auto" class="submitBtn">Submit</button>
         
        </div>
    </div>
</form>

    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQ=" crossorigin="anonymous"></script>
    <script>

function removeInput(button) {  
        var inputItem = button.parentNode;
        inputItem.parentNode.removeChild(inputItem);
    }


    
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

            document.body.classList.toggle('dark-mode');
            // document.getElementById('contact').classList.toggle('dark-mode');
            
            // Smooth transition for navbar background color
            const navbar = document.querySelector('.navbar');
            navbar.style.transition = 'background-color 0.5s ease';
            navbar.style.backgroundColor = document.body.classList.contains('dark-mode') ? '#343a40' : '#f8f9fa';
        darkModeToggle.addEventListener('change', function() {
            document.body.classList.toggle('dark-mode');
            document.getElementById('contact').classList.toggle('dark-mode');
            
            // Smooth transition for navbar background color
            const navbar = document.querySelector('.navbar');
            navbar.style.transition = 'background-color 0.5s ease';
            navbar.style.backgroundColor = document.body.classList.contains('dark-mode') ? '#343a40' : '#f8f9fa';
        });


        const educBtn = document.getElementById('educ-btn');
        const skillBtn = document.getElementById('skill-btn');;
        const projectBtn = document.getElementById('project-btn');;

        

        educBtn.addEventListener('click', function() {
            const educationInput = document.querySelector('.education-input');
            const educItem = document.createElement('div');
            educItem.classList.add('educ-item');

            const newInput = document.createElement('input');
            newInput.setAttribute('type', 'text');
            newInput.setAttribute('name', 'education[]');

            const removeBtn = document.createElement('button');
            removeBtn.textContent = 'x';
            removeBtn.setAttribute('type', 'button');
            removeBtn.classList.add('remove-skill-btn');
            removeBtn.addEventListener('click', function() {
                removeInput(this);
            });

            educItem.appendChild(newInput);
            educItem.appendChild(removeBtn);
            educationInput.appendChild(educItem);
        });

        skillBtn.addEventListener('click', function() {
            const skillInput = document.querySelector('.skill-input');
            const newSkillItem = document.createElement('div');
            newSkillItem.classList.add('skill-item');

            const newInput = document.createElement('input');
            newInput.setAttribute('type', 'text');
            newInput.setAttribute('name', 'skill[]');

            const removeBtn = document.createElement('button');
            removeBtn.textContent = 'x';
            removeBtn.setAttribute('type', 'button');
            removeBtn.classList.add('remove-skill-btn');
            removeBtn.addEventListener('click', function() {
                removeInput(this);
            });

            newSkillItem.appendChild(newInput);
            newSkillItem.appendChild(removeBtn);
            skillInput.appendChild(newSkillItem);
        });

        projectBtn.addEventListener('click', function() {
            const skillInput = document.querySelector('.project-input');
            const newInput = document.createElement('input');
            const newInput2 = document.createElement('textarea');
            newInput.setAttribute('type', 'file');
            newInput.setAttribute('name', 'projectDescription[]');
            newInput2.setAttribute('type', 'text');
            newInput2.setAttribute('accept', 'image/*');
            newInput2.setAttribute('placeholder', 'Project Description');
            newInput2.setAttribute('name', 'projectimage[]');
            skillInput.appendChild(newInput);
            skillInput.appendChild(newInput2);
        });



        document.addEventListener("DOMContentLoaded", function() {
        const imageInput = document.getElementById('image-input');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = '';
            }
        });
    });

    </script>
</body>
</html>


