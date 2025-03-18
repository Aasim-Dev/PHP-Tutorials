<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add User</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script src = "/Day-13/ajax.php"></script>
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
        <button type="submit" id= "submit-button">Submit</button>
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
        
    </body>
</html>


