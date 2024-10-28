<?php

$date = date("l");

switch("$date") {
    case "Monday":
        echo "Eng og'ir kunlardan biri bu {$date}";
        break;
    case "Tuesday":
        echo "Bu kunni amallasa bo'ladi";
        break;
    case "Wednesday":
        echo "Haftani yarmi keldi";
        break;
    case "Thursday":
        echo "Deyarli bir kun qoldi";
        break;
    case "Friday": 
        echo "Bugun party kuni";
        break;
    case "Saturday":
        echo "Shanba futbol kuni";
        break;
    case "Sunday":
        echo "Akang bugun dam oladi";
        break;   
}
?>