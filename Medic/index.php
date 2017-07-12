<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Запись к врачу</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <p><img src="icon175x175.jpeg" alt="крест" align = "right"></p>
      <h1>Запись к врачу</h1>
   
       <?php // sqltest.php

$db_server = mysqli_connect('localhost', 'root', '', 'medicine');
if (!$db_server) {
    die("Невозможно подключиться к MySQL: " . mysqli_error());
}
mysqli_select_db($db_server, 'medicine')
or die("Невозможно выбрать базу данных: " . mysqli_error());

if (isset($_POST['name']) &&
isset($_POST['doctor']) &&
isset($_POST['data']) &&
isset($_POST['time']))
{
$name = get_post($db_server, 'name');
$doctor = get_post($db_server, 'doctor');
$data = get_post($db_server,'data');
$time = get_post($db_server,'time');

if (empty($_POST['name'])) {
  echo '<p style="color:red">Ошибка ввода</p>'. 
          mysqli_connect_error();
          }

          $query = "INSERT INTO patient VALUES" .
"('$name', '$doctor', '$data', '$time')";
if (!mysqli_query($db_server, $query)) {
        echo "Сбой при вставке данных: $query<br />" .
        mysqli_connect_error() . "<br /><br />";
    }
}
?>

<form action="index.php" method="post"><pre>
Ф.И.О пациента    <input type="text" name="name" />

<?php
$sql2 = "SELECT * FROM doctors";
$result_select2 = mysqli_query($db_server, $sql2);
echo "Выберите врача:   "; echo "<select  name = 'doctor'>";
while($object = mysqli_fetch_object($result_select2)){
echo "<option value = '$object->doctor' > $object->doctor</option>";
}
echo "</select>";
?> 

Выбор даты:       <input type="date" name="data">

Выбор времени:    <input type="time" name="time" value="09:00" min="09:00" max="20:00">

<input type="submit" value="Записаться" /> 
</pre></form>

<?php

$query = "SELECT * FROM patient";
$result = mysqli_query($db_server, $query);
if (!$result) {
    die("Сбой при доступе к базе данных: " . mysqli_error());
}

echo "<table width='100%' border='1'>";
echo "<tr><td>Ф.И.О. пациента</td><td>Врач</td><td>Дата</td><td>Время</td></tr>";
$rows = mysqli_num_rows($result);
for ($j = 0 ; $j < $rows ; ++$j)
{
 
$row = mysqli_fetch_row($result);
$pole1=$row[0];
$pole2=$row[1];
$pole3=$row[2];
$pole4=$row[3];
echo "<tr><td>$pole1</td><td>$pole2</td><td>$pole3</td><td>$pole4</td></tr>";
}
echo "</table>";


mysqli_close($db_server);

function get_post($db_server, $var)
{
return mysqli_real_escape_string($db_server, trim($_POST[$var]));
}
?>
    </body>
</html>
