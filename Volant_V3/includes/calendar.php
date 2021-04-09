<?php 
    $dia = date('d');
    $mes = date('m');
    $anio = date('Y');
    $dias_mes = date('t');
    $dia_actual = 1;

    $month = date("F");
    echo "<table border='1'>";
    echo "<tr>";
    echo "<td colspan='7'>" . $month . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td>";
    echo "</tr>";
    $segundos_dia1 = mktime(0, 0, 0, $mes, 1, $anio);
    $array_dia1 = getdate($segundos_dia1);
    $dia_semana_dia1 = $array_dia1['wday'];
    if ($dia_semana_dia1 == 0) $dia_semana_dia1 = 7;
    echo "<tr>";
    for ($i = 1; $i < $dia_semana_dia1; $i++) {
        echo "<td>&nbsp;</td>";
    }
    for ($i = $dia_semana_dia1; $i < 8; $i++) {
        echo "<td>" . $dia_actual . "</td>";
        $dia_actual++;
    }
    echo "</tr>";
    $semanas = ceil(($dias_mes - $dia_actual + 1) / 7);
    for ($i = 0; $i < $semanas; $i++) {
     echo "<tr>";
        for ($j = 1; $j < 8; $j++) {
            if ($dia_actual > $dias_mes) {
             echo "<td>&nbsp;</td>";
         } else {
             echo "<td>" . $dia_actual . "</td>";
                $dia_actual++;
            }
        }
        echo "</tr>";
    }
?>
