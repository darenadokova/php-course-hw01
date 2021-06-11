<?php

//Домашна работа 
function to_list($data = array()){
    if(count($data)>0){
        echo '<h3>Таблица</h3>';
        echo '<table border=1>';
        echo '<tr>';
        foreach($data AS $key=>$value){
            echo '<th>Думата"'.$key.'"</th>';
            echo '<td>'.color_it($value).'</td>';
        }
        echo '</tr></table>';
        }
};

function color_it($value){
    if($value >1 AND $value <4) {
        return '<span style="color:orange">'.$value.'</span>';
    }elseif($value>=4) {
        return '<span style="color:red">'.$value.'</span>';
    }else{
        return $value;
    }
};



//Домашна работа 
// function to_list($data = array()){
//     if(count($data)>0){
//         echo '<h3>Таблица</h3>';
//         echo '<table border=1>';
//         echo '<tr>';
//         foreach($data AS $key=>$value){
//             echo '<th>Думата"'.$key.'"</th>';
//         }
//         echo '</tr><tr>';
//         foreach($data AS $key=>$value){
//         echo '<td>'.color_it($value).'</td>';
//         }
//         echo '</tr></table>';
//         }
// };

?>