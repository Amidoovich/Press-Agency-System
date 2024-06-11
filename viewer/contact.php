<?php
// Establish a connection to your database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'swe_project';
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
        // Escape user inputs for security
        $username = $conn->real_escape_string($_POST['username'] ?? '');
        $message = $conn->real_escape_string($_POST['message'] ?? '');

        // Insert data into the database
        $sql = "INSERT INTO contact (username, message) VALUES ('$username', '$message')";

        if ($conn->query($sql) === TRUE) {
            // Unset POST values after successful insertion
            unset($_POST['username']);
            unset($_POST['message']);
            
            // Redirect to a success page after insertion
            header("Location: editor_view.php");
            exit(); // Ensure no further code execution after redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }  
}


?>

<!doctype html>
<html lang="en">
   <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>contact</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <meta name="theme-color" content="#712cf9">

   </head>
   <body>
        <div class="container marketing">

        <!--Section: Contact v.2-->
            <section class="mb-4">

                <!--Section heading-->
                <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
                <!--Section description-->
                <form action="" method="post">
                <p class="text-center w-responsive mx-auto mb-5">if you have any problem in your account Leave message to the technical team .</p>
                <div class="md-form mb-0">
                    <label for="name" class="">Username</label>
                    <input type="text" id="name" name="username" class="form-control">
                </div>
                <div class="row">
                <div class="md-form">
                    <label for="message">Your message</label>
                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                </div>
                </div>
                <!--Grid row-->
                <div class="text-center text-md-left">
                    <button name="submit" class="w-50 btn btn-lg btn-primary mt-4"  type="submit">Send</button></div>
                    <div class="status"></div>
                  </form>
        
                </div>
                    <!--Grid column-->

                </div>

            </section>
        <!--Section: Contact v.2-->


        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js
        "></script>
    </body>
</html>