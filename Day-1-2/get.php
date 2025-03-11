<html>
<head>
    <title>GET Method</title>
</head>
<body>
<a href = "http://localhost/Tutorials/get.php?subject=IT&tokens=AA">Test</a>


<?php

echo "Study " . $_GET['subject'] . " at " . $_GET['tokens'];

?>
</body>
</html>