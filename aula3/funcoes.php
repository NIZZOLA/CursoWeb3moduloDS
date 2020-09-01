<?php

function formataDMYtoTime( $data ) {

    $dataArray = explode("/", $data );
    
    if( ( sizeof( $dataArray) ) == 0 )
        return null;

    //mktime(hour, minute, second, month, day, year)
    return mktime( 0, 0, 0, $dataArray[1], $dataArray[0], $dataArray[2] );
}

function formataYMDtoTime( $data ) {

    $dataArray = explode("-", substr( $data , 0,10) );
    
    if( ( sizeof( $dataArray) ) == 0 )
        return null;

    //mktime(hour, minute, second, month, day, year)
    return mktime( 0, 0, 0, $dataArray[1], $dataArray[2], $dataArray[0] );
}




?>