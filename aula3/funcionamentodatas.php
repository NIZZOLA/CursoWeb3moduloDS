<?php

  $datastr = "01/09/2020";

  $dataArray = explode("/", $datastr );

  //mktime(hour, minute, second, month, day, year)
  $formatada = mktime( 20, 05, 0, $dataArray[1], $dataArray[0], $dataArray[2] );

  echo "<br>formatada:".$formatada;

  echo "<br>usando date:".date( "d/m/Y", $formatada );

  echo "<br>usando mysql date:".date( "Y-m-d", $formatada );

  echo "<br>usando date:".date( "d/m/Y H:i:s", $formatada );
  
  echo "<br>usando date:".date( "h:i:s", $formatada );

  

?>