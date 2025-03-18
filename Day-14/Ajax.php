<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajax</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    </head>
    <body>
        <div id="don">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>City</th>
                    </tr>
                    <tr>
                        <form id="form">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name">
                            <br>
                            <label for="age">Age:</label>
                            <input type="number" name="age" id="age">
                            <br>
                            <label for="city">City:</label>
                            <input type="text" name="city" id="city">
                            <br>
                            <button type="submit" id="submit" value="Submit">Submit</button>
                        </form>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <!-- Data from AJAX will be inserted here -->
                </tbody>
            </table>

        </div>

        <script>
            $(document).ready(function () {
               function loadtable(){
                    $.ajax({
                        url: "data.php",
                        type: "GET",
                        success: function (data) {
                            $("#table-body").html(data); // Append rows inside tbody
                        },
                        error: function () {
                            alert("Error fetching data");
                        }
                    });
                }
                loadtable();
                
                $("#submit").click(function () {
                    $("#name, #age, #city").val("");
                    $.ajax({
                        url: "Inserting.php",
                        type: "POST",
                        data: {
                            name: name,
                            age: age,
                            city: city,
                            submit: submit
                        },
                        success: function (data) {
                            $("#table-body").html(data); // Append rows inside tbody
                        },
                        error: function () {
                            alert("Error sending data");
                        }
                    });
                });
                loadtable();
            });
        </script>
    </body>
</html>
