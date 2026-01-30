<?php
// This MUST be at the very top to enable server-side storage
session_start();

// Handle "Clear Data" request
if (isset($_POST['clear'])) {
    session_destroy();
    header("Location: state-php.php"); // Refresh page to show data is gone
    exit();
}

// Handle "Save Data" request
if (isset($_POST['user_data'])) {
    // Save to the SERVER-SIDE session, not localStorage
    $_SESSION['stored_content'] = htmlspecialchars($_POST['user_data']);
}
?>

<!DOCTYPE html>
<html>
<body>
    <h1>State Management (PHP)</h1>
    
    <form method="POST">
        <input type="text" name="user_data" placeholder="Enter data to save">
        <button type="submit">Save to Session</button>
    </form>

    <hr>
    <p><a href="state-view-php.php">Go to View Screen</a></p>

    <form method="POST">
        <input type="hidden" name="clear" value="1">
        <button type="submit" style="color:red;">Clear Session Data</button>
    </form>
</body>
</html>