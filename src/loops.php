<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
for ($i = 1; $i <= 10; $i++) {
    echo "5 x $i = " . (5 * $i) . "<br>";

}

$j= 10;
while ($j >= 1) {
    echo "$j<br>";
    $j--;
}
echo "<table border='1' cellpadding='8' cellspacing='0'>";

for ($row = 1; $row <= 10; $row++) {
    echo "<tr>";

    for ($col = 1; $col <= 10; $col++) {
        echo "<td>" . ($row * $col) . "</td>";
    }

    echo "</tr>";
}

echo "</table>";

$j= 1;
while ($j <= 10) {
    if ($j == 5) {
        $j++;
        continue;
    }
     if ($j == 8) {
        break;
    }
    echo "$j<br>";
    $j++;
}


?>
</body>
</html>