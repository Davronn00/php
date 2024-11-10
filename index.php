<?php 
    setcookie("fav_food", "osh", time()-0, "/");
    setcookie("fav_drink", "choy", time()+ (86400*1), "/");
    setcookie("fav_desert", "non", time()+ (86400*62), "/");

    /*f(isset($_COOKIE["fav_food"])){
        echo "Your favourite food is {$_COOKIE["fav_food"]}";
    }
    else{
        echo "I don't know your favourite food";
    }*/
foreach($_COOKIE as $key => $value){
    echo "$key is $value <br>";
}
if(isset($_COOKIE["fav_food"])){
    echo "Your favourite food is {$_COOKIE["fav_food"]}";
}
else{
    echo "I don't know your favourite food <br>";
}
if(isset($_COOKIE["fav_drink"])){
    echo "You want to drink {$_COOKIE["fav_drink"]}<br>";
}
else{
    echo "I don't know your favourite food";
}

?> 