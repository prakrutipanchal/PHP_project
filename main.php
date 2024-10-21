<?php
include 'config.php'; 

$error_message = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $position = $_POST['position'];

    $stmt = $conn->prepare("SELECT * FROM job_details WHERE position = ?");
    $stmt->bind_param("s", $position); 
    $stmt->execute();
    $result = $stmt->get_result();

    session_start();
    if ($result->num_rows > 0) {
        $_SESSION['message'] = 'Congratulations! Job vacancy available';
        $_SESSION['status'] = 'success';
        header("Location: final.php"); 
        exit(); 

    } else {
        $_SESSION['message'] = "No job vacancy available for the position: " . htmlspecialchars($position);
        $_SESSION['status'] = "failure";
        header("Location: final.php"); 
        exit(); 
    }

   
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Job Application</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 80vw; 
            max-width: 80%;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .job-form {
            width: 100%;
        }

        .form-label {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-control {
            width: 90%; 
            padding: 8px; 
            font-size: 14px; 
            display: block;
            margin: 0 auto; 
            border-radius: 5px;
        }

        .submit-btn {
            padding: 12px;
            width: 70%;
            font-size: 16px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
        }

        .submit-btn:hover {
            background-color: #28a745;
        }

        .fa {
            color: green;
            margin-right: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 22px;
        }

        .symbol {
            text-align: center;
            font-size: 40px; 
            
            color: green;
        }

        .heading {
            text-align: center;
            font-size: 20px; 
            color: green;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .container {
                width: 95vw; 
            }

            .form-control {
                width: 100%; 
            }

            .submit-btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form class="job-form" action="" method="POST">
            <div class="symbol">
                <i class="fa fa-briefcase"></i>
            </div>
            <div class="heading">Job Application Form</div>

            <div class="form-section">
                <label for="position" class="form-label"><i class="fa fa-briefcase"></i> Position to Apply</label>
                <input type="text" id="position" name="position" class="form-control" placeholder="Position you want to apply" required>
            </div>

            <div class="form-section">
                <label for="education" class="form-label"><i class="fa fa-money"></i> Education</label>
                <input type="text" id="education" name="education" class="form-control" placeholder="Education" required>
            </div>

            <div class="form-section">
                <label for="experience" class="form-label"><i class="fa fa-money"></i> Experience</label>
                <input type="text" id="experience" name="experience" class="form-control" placeholder="Experience" required>
            </div>

            <div class="form-section">
                <label for="work-preference" class="form-label"><i class="fa fa-globe"></i> Remote or At Location</label>
                <select id="work-preference" name="work_preference" class="form-control" required>
                    <option value="" disabled selected>Select your preference</option>
                    <option value="Remote">Remote</option>
                    <option value="At Location">At Location</option>
                </select>
            </div>

            <div class="form-section">
                <button type="submit" class="submit-btn">Submit Application</button>
            </div>
        </form>
    </div>
</body>

</html>