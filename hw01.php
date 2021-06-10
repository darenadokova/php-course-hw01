<?php
$txt = "Отвърдените телевизионни журналисти Мирослава Иванова и Марина Цекова се завръщат в ефира на NOVA през юни.<br> 
Те ще водят две от най-предпочитаните актуални предавания сред телевизионните зрители в активна възраст – „Здравей, България“ и „Събуди се“.
Отвърдените телевизионни журналисти Мирослава Иванова и Марина Цекова се завръщат в ефира на NOVA през юни.<br> 
Те ще водят две от най-предпочитаните актуални предавания сред телевизионните зрители в активна възраст – „Здравей, България“ и „Събуди се“.
Отвърдените телевизионни журналисти Мирослава Иванова и Марина Цекова се завръщат в ефира на NOVA през юни.<br> 
Те ще водят две от най-предпочитаните актуални предавания сред телевизионните зрители в активна възраст – „Здравей, България“ и „Събуди се“.";


require_once 'function-hw01.php';


$words_array = explode(' ',$txt);
$unique_words = array();


foreach($words_array AS $value){
    if(array_key_exists($value,$unique_words)){
        $unique_words[$value] ++;
    } else {
        $unique_words[$value] = 1;
    }
}

echo '<p>Броят на уникалните думите е: '.count($unique_words).'</p>';

echo '<hr>';

arsort($unique_words);
to_list($unique_words);




  











// echo '<h3>Таблица</h3>';
// echo '<table border=1>';
// echo '<tr>';
// foreach($unique_words AS $key=>$value){
//     if( $value>1 ) {
//         $value = '<span style="background-color:red;">'.$value.'</span>';
//     }

//     echo '<th>Думата"'.$key.'"</th>';
// }

// echo '</tr>';

// echo '<tr>';
// foreach($unique_words AS $key=>$value){
//     if( $value>1 ) {
//         $value = '<span style="background-color:red;">'.$value.'</span>';
//     }
//     echo '<td>'.$value.'</td>';
// }
// echo '</tr>';
// echo '</table>';
?>
