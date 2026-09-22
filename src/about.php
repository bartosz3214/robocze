<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $firstname = "bartek";
    $lastname = "kornak";
    $age = 25;
    $city = "czarna białostocka";
    $country = "poland";
    $isStudent = true;
    echo "My name is $firstname $lastname and I am $age years old Im live in $country in $city.";
    echo '<br>';
    echo 'Next year I will be ' . ($age + 1) . '.';
    ?>
</body>
</html>