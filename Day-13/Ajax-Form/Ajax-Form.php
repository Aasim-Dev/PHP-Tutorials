<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

</head>
<body>
    <h1>Welcome</h1>
    <form id="userform" action="mail.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="mail-name" >
        <br>
        <label for="age">Age:</label>
        <input type="number" name="age" id="mail-age" >
        <br>
        <label for="city">City:</label>
        <input type="text" name="city" id="mail-city" >
        <br>
        <button type="submit" id="mail-submit" value="Submit">Submit</button>
        <p id= "mail-message"></p>
    </form>
    <script>
        $(document).ready(function(){
            $("#userform").submit(function(e){
                e.preventDefault();
                var name= $("#mail-name").val();
                var age = $("#mail-age").val();
                var city = $("#mail-city").val();
                var submit = $("#mail-submit").val();
                $("#mail-message").load("mail.php",{
                    name: name,
                    age: age,
                    city: city,
                    submit: submit
                });
            });
        });
    </script>
</body>
</html>
