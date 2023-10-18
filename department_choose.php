<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Add Font Awesome for icons -->
    <style>
        /* Center the boxes vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url('images/bg7.png');
            background-attachment: fixed;
            background-size: 100% 100%;
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
            flex-wrap: wrap;
            justify-content: center;
        }

        /* Style for the boxes */
        .box {
            width: 200px; /* Adjust the width as needed */
            height: 200px; /* Make the height equal to the width */
            background-color: #fff;/* rgba(240, 240, 240, 0.8);  Adjust the color and opacity as needed */
            opacity: 0.8;
            border: 1px solid #ccc;
            border-radius: 20px;
            margin: 20px;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none; /* Remove default link underline */
            color: #000; /* Change link color to your preference */
            text-transform: uppercase; /* Make text uppercase */
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        /* Style for the icons */
        .icon {
            font-size: 3rem; /* Adjust the font size as needed */
            margin-bottom: 10px;
        }

        /* Add hover effect */
        .box:hover {
            transform: scale(1.05); /* Adjust the scale factor as desired */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add a subtle shadow on hover */
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            /* Switch to vertical alignment on mobile */
            .container {
                flex-direction: column;
            }

            .box {
                margin: 10px 0; /* Adjust margin for mobile layout */
            }
        }

        @media (max-width: 576px) {
            .box {
                width: 150px; /* Adjust the width for even smaller screens */
                height: 150px; /* Make the height equal to the width */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Include your database connection code here
        include 'includes/conn.php';

        // Query to retrieve active department information from the 'departments' table
        $sql = "SELECT department_id, name FROM departments WHERE status = 'active'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departmentName = $row['name'];

                // Generate the box for active department with a clickable link
                echo '<a href="department_login.php?department_id=' . $row['department_id'] . '" class="box">';
                echo '<div class="icon">';
                echo '<i class="fas fa-vote-yea"></i>'; // Use 'fas' for Font Awesome 5 icons
                echo '</div>';
                echo '<div class="name">';
                echo $departmentName;
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "No active departments found in the database.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
