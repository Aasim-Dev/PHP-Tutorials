<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>jQuery</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <?php
         echo "<h2>jQuery</h2>";
         echo "<p>jQuery is a fast, small, and feature-rich JavaScript library. It makes things like HTML document traversal and manipulation, event handling, 
         and animation much simpler with an easy-to-use API that works across a multitude of browsers. With a combination of versatility and extensibility, 
         jQuery has changed the way that millions of people write JavaScript.</p>";
         echo "<p id='para'>Click me to hide</p>";
         echo "<button>Click me</button>";
         ?>
    </body>
    <script>
        $(document).ready(function(){
            //  example of element selector;
            $("button").click(function(){
                console.log("You clicked on paragraph");
                $("p").hide(1000);
            });

        });
    </script>
</html>