<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $hour = (int) date('G');
    if ($hour >= 12 && $hour < 18) {
        echo "Dobry wieczór!";
    } elseif ($hour >= 18 && $hour < 22) {
        echo "Dobry wieczór!";
    } elseif ($hour >= 22 || $hour < 6) {
        echo "Dobry wieczór!";
    } else {
        echo "Dobry poranek!";
    }

       $temperature = (int) date ('G');
    if ($temperature <= 0) {
        echo "Zimno na zewnątrz!";
    } elseif ($temperature >= 0 && $temperature < 10) {
        echo "Chłodno na zewnątrz!";
    } elseif ($temperature >= 10 && $temperature < 20) {
        echo "Umiarkowanie na zewnątrz!";
    } elseif ($temperature >= 20 && $temperature < 30) {
        echo "Ciepło na zewnątrz!";
    } else {
        echo "Gorąco na zewnątrz!";
    }
    switch ($dayofweek = date('l')) {
        case 'Monday':
            echo " jest poniedziałek!";
            break;
        case 'Tuesday':
            echo " jest wtorek!";
            break;
        case 'Wednesday':
            echo " jest środa!";
            break;
        case 'Thursday':
            echo " jest czwartek!";
            break;
        case 'Friday':
            echo " jest piątek!";
            break;
        case 'Saturday':
            echo " jest sobota!";
            break;
        case 'Sunday':
            echo " jest niedziela!";
            break;
    }
    ?>
</body>
</html>