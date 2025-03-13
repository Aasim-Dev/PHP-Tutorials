<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Form Test</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <style>
            .error{
                color: red;
            }
        </style>
</head>
<body>
    <form id="form7" method="POST" action= "" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="field">Images: </label>
        <input type="file" id="image" name="image"><br><br>
        <input type="submit" value="Submit">
    </form>

    <script>
        $(document).ready(function(){
            $.validator.addMethod("validString", function(value, element) {
                return this.optional(element) ||  /^[A-Za-z]+(?:\s[A-Za-z]+)*$/.test(value);
                },"The name field must contain only letters");
            $.validator.addMethod("requires", function(value, element) {
                return this.optional(element) ||  /^/.test(value);
                },"Password must include at least 1 uppercase, 1 lowercase, 1 number, and 1 special character.s");
            $.validator.addMethod("accept", function(value, element){
                return this.optional(element) || /\.(jpg|jpeg|png)$/i.test(value);
                }, "The Image should be in jpg, jpeg, png format only.")
                
            $("#form7").validate({
                rules: {
                    name: {
                        required:true,
                        minlength: 4,
                        validString: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        requires: true
                    },
                    image: {
                        required: true,
                        accept: true
                    },
                },
                messages: {
                    name: {
                        required: "Name is Required",
                        minlength: "It Should be Minimum of Four Characters"
                    },
                    email: {
                        required: "Email is Required",
                        email: "It should contain @ and ."
                    },
                    password: {
                        required: "Password is required",
                        minlength: "It should have min 8 char long.",
                        requires: "Password should contain min 8 char with 1 uppercase, 1 lowercase, 1 number and 1 special char."
                    },
                    image: {
                        required: "Upload is neccessary",
                        image: "It should be jpg, jpeg, png.",
                        
                    },
                },
                submitHandler : function(form){
                    form.submit();
                }
            });
        });
    </script>
    
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "forms";
    //creating a connection to database
    $connect = mysqli_connect($servername, $username, $password, $database);
    if(!$connect){
        die("the connection is not done" . $mysqli_connect_error());
    } else{
        echo "database is connected: ";
    }

    echo "<br>";
    // $sql = "CREATE TABLE `phpform3` (`srno` INT(20) NOT NULL AUTO_INCREMENT , `name` VARCHAR(20) NOT NULL , `email` VARCHAR(20) NOT NULL , `pass` VARCHAR(20) NOT NULL , `images` VARCHAR(20), PRIMARY KEY (`srno`))";
    //     $result = mysqli_query($connect, $sql);
    //     // check for the table creation
    //     if($result){
    //         echo "The Database table is created Successfully";
    //     } else {
    //         "The DB table is not created Successfully: " . mysqli_error($connect);
    //     }

    // echo "<br>";
    
        //specify the methods POST, etc and htmlspecialchars and other function whichever is regulated.
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = htmlspecialchars(trim($_POST["name"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $passwords = htmlspecialchars(trim($_POST["password"]));
            $pass = password_hash($passwords, PASSWORD_DEFAULT);


            $image = $_FILES["image"]["name"] ?? ''; 
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


        //Image Validation with upload to a local file 
        if(empty($image)){
            $error["image"] = "Image is required";
        }
        elseif(!array($_FILES["image"]["type"], ['image/jpeg' , 'image/png'])){
            $error["image"] = "Only jpeg and png type is accepted";
        }
        else{
            $targetDir = "../uploads/";
            $targetfile = $targetDir . basename($image);
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetfile);
        }


        if (empty($errors)) {
            $stmt = $connect->prepare("INSERT INTO phpform3 (Name, Email, Password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $pass);
            
            if ($stmt->execute()) {
                echo "<p style='color: green;'>Registration successful!</p>";
            } else {
                echo "<p style='color: red;'>Error: " . $connect->error . "</p>";
            }
            $stmt->close();
        } else {
            // Display errors
            foreach ($errors as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
        }
    }
    echo "<br>";
    echo "<br>";
    
    
        echo "<br>";
        echo "<br>";
        
        
        $connect->close();

        

        // $sql = "INSERT INTO `phpform2` (`name`, `email`, `pass` , `images`) VALUES ('$name', '$email', '$passwords', '$image');";
        // $result = mysqli_query($connect, $sql);
        // // check for the table creation
        // if($result){
        //     echo "The Database entry is inserted Successfully";
        // } else {
        //     "The DB table is not inserted Successfully: " . mysqli_error($connect);
        // }  
           
    ?>
</body>
</html>