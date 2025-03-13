<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <style>
            body{
                justify-content: center;
                align-items: center;
                text-align: center;
                background-color: lightblue;
            }
            .error{
                color: red;
            }
        </style>
    </head>
    <body>
        <h2>Welcome, You can Add Your Details Here </h2>
        <form id="addform" action=" " method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br> 
            <label for="password">City:</label>
            <input type="text" id="city" name="city" required><br><br>
            <button type="submit">Submit</button>
        </form>
        <script>
            $(document).ready(function(){
                $.validator.addMethod("validString", function(value, element) {
                return this.optional(element) ||  /^[a-zA-Z\s]*$/.test(value);
                },"The name field must contain only letters");
                $("#addform").validate({
                    rules:{
                        name: {
                            required:true,
                            minlength: 4,
                            validString: true,
                        },
                        email: {
                            required:true,
                            email:true
                        },
                        city: {
                            required:true,
                            validString: true
                        }
                    },
                    messages:{
                        name: {
                            required: "Please enter your name",
                            minlength: "Your name must be at least 4 characters long"
                        },
                        email: {
                            required: "Please enter your email",
                            email: "Please enter a valid email"
                        },
                        city: {
                            required: "Please enter your city"
                        }
                    }
                });
            });
        </script>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "paymentapp";

            $conn = mysqli_connect($servername, $username, $password, $db);
            if($conn){
                echo "The DB is connected Successfully<br>";
            }else{
                echo "The DB is not connected successfully<br>" . $mysqli_connect_error();
            }

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = htmlspecialchars(trim($_POST["name"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $city = htmlspecialchars(trim($_POST["city"]));
                $error = [];
    
                if (empty($name) || strlen($name) < 4){
                    $error["name"] = "Name is required minimum of 4 char";
                }
        
                //Email Validation
                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error["email"] = "Email is required";
                } 
                else {
                    // Check if email already exists
                $stmt  = $connect->prepare("SELECT Email FROM phpform3 WHERE Email = ? " );
                $stmt -> bind_param("s", $email);
                $stmt -> execute();
                $stmt -> store_result();
        
                if($stmt->num_rows > 0 ){
                    $errors["email"] = "this email is already registered";
                    }
                    $stmt->close();
                }
        
                //Password Validation
                if (empty($pass) || strlen($pass) < 8){
                    $error["email"] = "Pass required of minimum 8 char";
                } 

                if (empty($error)){
                    $sql = "INSERT INTO `users` (`name`, `email`, `city`) VALUES ('$name', '$email', '$city')";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                        echo "The data is inserted successfully";
                    }else{
                        echo "The data is not inserted successfully" . mysqli_error($conn);
                    }
                }
            }
        ?>
    </body>
</html>


