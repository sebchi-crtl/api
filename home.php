<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Check the button</h1>
    <?php
        require 'Button.php';
        $Mybutton= new Button();
        $Mybutton->value="Save";
        $Mybutton->width="500";
        echo $Mybutton->RenderHTML();
    ?>
</body>
</html>