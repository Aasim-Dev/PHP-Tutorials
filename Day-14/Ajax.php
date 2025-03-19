<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajax</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <style>
            /* General Styling */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
            }
            
            #form {
                justify-content: center;
                align-items: center;
                text-align: center;
                border: 1px solid #ddd;
                padding: 10px;
            }
            /* Table Styling */
            table {
                width: 100%;
                border-collapse: collapse;
                background: #fff;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: center;
            }

            th {
                background-color: #007bff;
                color: white;
            }

            /* Buttons */
            button {
                padding: 8px 12px;
                border: none;
                cursor: pointer;
                border-radius: 4px;
                font-size: 14px;
            }

            .edit {
                background-color: #28a745;
                color: white;
            }

            .delete {
                background-color: #dc3545;
                color: white;
            }

            button:hover {
                opacity: 0.8;
            }

            /* Modal Styling */
            #modal {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 90%;
                max-width: 400px;
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
                z-index: 1000;
            }

            /* Modal Form */
            #modal h2 {
                text-align: center;
                margin-bottom: 15px;
            }

            #modal label {
                font-weight: bold;
                display: block;
                margin-top: 10px;
            }

            #modal input {
                width: 100%;
                padding: 8px;
                margin-top: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            /* Modal Buttons */
            .modal-buttons {
                display: flex;
                justify-content: space-between;
                margin-top: 15px;
            }

            #modalsubmit {
                background: #007bff;
                color: white;
                padding: 10px 15px;
            }

            #closeModal {
                background: #6c757d;
                color: white;
                padding: 10px 15px;
            }

            /* Overlay Background */
            #modal-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            /* Responsive Design */
            @media screen and (max-width: 600px) {
                #modal {
                    width: 90%;
                }
            }
        </style>
    </head>
    <body>
        <div id="don">
        <form id="form">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name"><br>
            <label for="age">Age:</label>
            <input type="number" name="age" id="age"><br>
            <label for="city">City:</label>
            <input type="text" name="city" id="city"><br>
            <button type="submit" id="submit" value="Submit">Submit</button>
        </form>
            <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        
                    </tr>
                <tbody id="table-body">
                    <!-- Data from AJAX will be inserted here -->
                </tbody>
            </table>
        </div>
        <div id="modal">
            <div id="modal-content">
                <h2>Edit Employee</h2>
                <input type="hidden" name="id" id="modal-id">
                <label for="modal-name">Name:</label>
                <input type="text" name="name" id="modal-name"><br>
                <label for="modal-age">Age:</label>
                <input type="number" name="age" id="modal-age"><br>
                <label for="modal-city">City:</label>
                <input type="text" name="city" id="modal-city"><br>
                    <button type="submit" id="modalsubmit" value="Submit">Submit</button>
                    <button type="button" id="closeModal">Close</button>
            </div>
        </div>


        <script>
            $(document).ready(function () {
                $("#form").validate({
                    rules: {
                        name: {
                            required: true,
                            minlength: 3
                        },
                        age: {
                            required: true,
                            number: true
                        },
                        city: {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        name: {
                            required: "Name is required",
                            minlength: "Name must be at least 3 characters"
                        },
                        age: {
                            required: "Age is required",
                            number: "Age must be a number"
                        },
                        city: {
                            required: "City is required",
                            minlength: "City must be at least 3 characters"
                        }
                    }
                });
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
                
                $("#submit").click(function (e) {
                    e.preventDefault();
                    var name = $("#name").val();
                    var age = $("#age").val();
                    var city = $("#city").val();
                    var submit = $("#submit").val();
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
                            loadtable();
                            $("#table-body").html(data); // Append rows inside tbody
                            $('#form').trigger('reset');
                        },
                        error: function () {
                            alert("Error sending data");
                        }
                    });
                });
                loadtable();
                $(document).on('click', '.delete', function () {
                    var id = $(this).data('id');
                    $.ajax({
                        url: "deleting.php",
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function (data) {
                            $("#table-body").html(data); // Append rows inside tbody
                        },
                        error: function () {
                            alert("Error deleting data");
                        }
                    });
                });
                $(document).on(/*event*/'click',/*selector*/ '.edit', /*function*/function () {
                    $("#modal").show();
                    var id = $(this).data('id');
                    var name = $(this).data('name');
                    var age = $(this).data('age');
                    var city = $(this).data('city');

                    $("#modal-id").val(id);  // Use a hidden input field to store the ID
                    $("#modal-name").val(name);
                    $("#modal-age").val(age);
                    $("#modal-city").val(city);
                });

                // Handle modal form submission
                $(document).on('click', '#modalsubmit', function (e) {
                    e.preventDefault();

                    var id = $("#modal-id").val();          // It is use to get the data from #modal-id and to store into variable id.
                    var name = $("#modal-name").val();     // It is use to get the data from #modal-name and to store into variable name.
                    var age = $("#modal-age").val();      // It is use to get the data from #modal-age and to store into variable age.
                    var city = $("#modal-city").val();

                    // console.log("Sending Data: ", { id, name, age, city }); // Debugging

                    $.ajax({
                        url: "Editing.php",
                        type: "POST",
                        data: { id: id, name: name, age: age, city: city },
                        success: function (data) {
                            // console.log("Response from Server: ", data); // Debugging
                            alert(data);
                            $("#modal").hide();
                            loadtable();
                        },
                        error: function () {
                            alert("Error updating data");
                        }
                    });
                });


                $(document).on('click', '#closeModal', function () {
                    $("#modal").hide();
                });
            });
        </script>
    </body>
</html>
