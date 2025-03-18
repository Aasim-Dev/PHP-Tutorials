<?php
if (isset($_POST['name'], $_POST['age'], $_POST['city'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $city = $_POST['city'];

    $errorEmpty = "false";
    $errorAge = "false";

    if (empty($name) || empty($age) || empty($city)) {
        echo "Please fill all the fields";
        $errorEmpty = "true";
    } elseif (!is_numeric($age)) {
        echo "Please enter a valid age";
        $errorAge = "true";
    } else {
        echo "Message sent successfully";
    }
} else {
    echo "There was an error";
}

// $sql = "INSERT INTO employee (Name, Age, City) VALUES ('$name', '$age', '$city')";

    // if (mysqli_query($conn, $sql)) {
    //     echo "Message sent successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    // }
?>

<script>
    var errorEmpty = "<?php echo $errorEmpty; ?>";
    var errorAge = "<?php echo $errorAge; ?>";

    if (errorEmpty === "true") {
        $("#mail-name, #mail-age, #mail-city").addClass("input-error");
    }
    if (errorAge === "true") {
        $("#mail-age").addClass("input-error");
    }
    if (errorEmpty === "false" && errorAge === "false") {
        $("#mail-name, #mail-age, #mail-city").val("");
    }
</script>


    
    
