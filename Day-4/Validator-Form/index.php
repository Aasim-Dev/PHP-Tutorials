<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Validator Form </title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <style>
            .error{
                color: red;
            }
        </style>
    </head>
    <body>
        <h2> Registration Form </h2>
        <form id="registrationform" action=" " method="POST">
            <label for="field">Required, audio files only: </label>
            <input type="file" class="left" id="field" name="field"><br><br>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" ><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" ><br><br> 
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" ><br><br>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" ><br><br>
            <button type="submit">Submit</button>
        </form>
        <script>
            $(document).ready(function(){
                $.validator.addMethod("validString", function(value, element) {
                return this.optional(element) ||  /^[a-zA-Z\s]*$/.test(value);
                },"The name field must contain only letters");
                $.validator.addMethod("requires", function(value, element) {
                return this.optional(element) ||  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
                },"Password must include at least 1 uppercase, 1 lowercase, 1 number, and 1 special character.s");
                $("#registrationform").validate({
                    rules:{
                        field: {
                            required: true,
                            accept: "audio/*"
                        },
                        name: {
                            required:true,
                            minlength: 4,
                            validString: true,
                        },
                        email: {
                            required:true,
                            email:true
                        },
                        password: {
                            required:true,
                            minlenght: 8,
                            requires:true  
                         
                        },
                        confirm_password: {
                            required:true,
                            equalTo: "#password"
                        },
                    },
                    messages: {
                        name: {
                            required: "Name is required",
                            minlength: "Name should be of minimum 4 characters",
                            validString: "The name field must contain only letters"
                        },
                        email: {
                            required: "Email is required",
                            email: "Email should be a valid email address"
                        },
                        password: {
                            required: "Password is required",
                            minlength: "Password should be of minimum 8 characters",
                            requires: "Password must include at least 1 uppercase, 1 lowercase, 1 number, and 1 special character."
                        },
                        confirm_password: {
                            required: "Confirm Password is required",
                            equalTo: "Confirm Password should be same as password"
                        },
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                })
            })
        </script>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = htmlspecialchars(trim($_POST["name"]));
                $email = htmlspecialchars(trim($_POST["email"]));
                $password = htmlspecialchars(trim($_POST["password"]));
                $confirm_password = htmlspecialchars(trim($_POST["confirm_password"]));
                $error = [];

                if(empty($name) || strlen($name) < 4){
                    $error["name"] = "Name is required and should be of minimum 20 characters";
                }
                if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error["email"] = "Email is required and should be a valid email address";
                }
                if(empty($password) || strlen($password) < 8){
                    $error["password"] = "Password is required and should be of minimum 8 characters";
                }
                if(empty($confirm_password) || $confirm_password != $password){
                    $error["confirm_password"] = "Confirm Password is required and should be same as password";
                }
                if (empty($errors)) {
                    // Success message
                    echo "Form submitted successfully!";
                } else {
                    // Display errors
                    foreach ($errors as $error) {
                        echo "<p style='color: red;'>$error</p>";
                    }
                }
            }
        ?>
    </body>
</html>