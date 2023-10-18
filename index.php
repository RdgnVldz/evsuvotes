<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Center the boxes vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url('images/bg7.png');
            background-attachment: fixed;
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
        }
        @media (max-width: 767px) {
    body {
      background-image: url('images/bg7p.png');
      background-attachment: fixed;
      background-size: 100% 100%;
      /* You can also adjust other background properties like size and attachment here if needed */
    }
  }
        /* Style for the container */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Style for the boxes */
.box {
    width: 200px; /* Adjust the width as needed */
    height: 200px; /* Make the height equal to the width */
    background-image: url('your-image.jpg'); /* Replace 'your-image.jpg' with the actual path to your image */
    background-color: #fff;
    opacity: 0.8;
    background-size: cover; /* Adjust to your preference */
    background-repeat: no-repeat; /* Adjust to your preference */
    background-position: center; /* Adjust to your preference */
    border: 1px solid #ccc;
    border-radius: 20px;
    margin: 20px;
    padding: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    text-transform: uppercase; /* Make text uppercase */
    justify-content: center; /* Center text vertically */
    align-items: center;
    text-decoration: none; /* Remove default link underline */
    color: #000; /* Change link color to your preference */
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

/* Add hover effect */
.box:hover {
    transform: scale(1.05); /* Adjust the scale factor as desired */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a subtle shadow on hover */
}


        /* Style for the icons */
        .icon {
            font-size: 3rem; /* Adjust the font size as needed */
            margin-bottom: 10px;
        }

        /* Style for inactive boxes */
        .inactive {
            display: none; /* Hide inactive boxes */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .box {
                width: 150px; /* Adjust the width for smaller screens */
                height: 150px; /* Make the height equal to the width */
            }
        }

        @media (max-width: 576px) {
            .box {
                width: 100px; /* Adjust the width for even smaller screens */
                height: 100px; /* Make the height equal to the width */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Include your session.php to establish a database connection
        include 'includes/conn.php';

        // Define the login URLs for each form
        $loginURLs = array(
            'SSG Voting' => 'ssg_login.php',
            'Department Voting' => 'department_choose.php'
        );

        // Fetch the status from the database and map "inactive" to non-clickable class
        $sql = "SELECT type_name, status FROM votingtypes";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $formName = $row['type_name'];
                $status = ($row['status'] == 'active') ? 'active' : 'inactive';

                // Use the login URL and determine if the box should be clickable based on status
                $loginURL = isset($loginURLs[$formName]) ? $loginURLs[$formName] : '#';
                $boxClass = 'box ' . $status;

                // Generate the box with the link or non-clickable style
                echo '<a href="' . $loginURL . '" class="' . $boxClass . '">';
                echo '<div class="icon">';
                echo '<i class="fa fa-vote-yea"></i>';
                echo '</div>';
                echo '<div class="name">';
                echo $formName;
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "No records found.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
