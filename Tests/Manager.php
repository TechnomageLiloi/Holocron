<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Holocron Global Tests Manager</title>
</head>
<img src="/Signum.png" width="100">

<div style="background-color: black; color: white;padding: 5px;margin: 0px;">
    <?php echo str_replace("\n", "<br/>", shell_exec('phpunit')); ?>
</div>

<hr/>

<body>
</body>
</html>
