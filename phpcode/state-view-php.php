<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>
    <h1>View Saved State</h1>
    <p>The data currently saved on the server is:</p>
    
    <div style="border: 1px solid black; padding: 10px;">
        <?php 
            echo isset($_SESSION['stored_content']) 
                ? $_SESSION['stored_content'] 
                : "<em>No data found in session.</em>"; 
        ?>
    </div>

    <p><a href="state-php.php">Back to Input Screen</a></p>
</body>
</html>