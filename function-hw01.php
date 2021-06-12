<?php

//Домашна работа 
function to_list($data = array()){
    if(count($data)>0){
        echo '<h3>Таблица</h3>';
// променлива, в която ще се съдържа кода на таблицата
$table =  '<table border=1>';
// Заглавния ред
$table_header =  '<tr>';
// тялото на таблицата
$table_body = '<tr>';

foreach($data AS $key=>$value){
$table_header .= '<th>Думата"'.$key.'"</th>';
$table_body .= '<td>'.$value.'</td>';
}
//довършваме редовете
$table_header .= '</tr>';
$table_body .= '</tr>';
// сглобяваме цялата таблица
$table .= $table_header.$table_body.'</table>';
echo $table;
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