<?php
date_default_timezone_set('America/Los_Angeles');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hello PHP World</title>
</head>
<body>
    <h1 style="text-align:center">Hello HTML World (PHP)</h1>
    <hr/>
    <p>Greeting from: Sithu Soe and Phyo Thant</p>
    <p>Language: PHP</p>
    <p>Generated at: <?php echo date('Y-m-d H:i:s'); ?></p>
    <p>Your IP Address: <?php echo $_SERVER['REMOTE_ADDR']; ?></p>
</body>
</html>