<?php
date_default_timezone_set ("Asia/Tokyo");
$thismonth = "july";
$day = date("d");
switch ($day) {
    case "21":
        echo "<p><img src=\"https://upload.wikimedia.org/wikipedia/commons/2/2a/Int-mother-lang-day-monument.jpg\"
             alt=\"photo\" style=\"float:right;max-width:100%;height:auto;margin-left:10px;\"><b>Today is " . $thismonth . " " . $day .
            "! It's International Mother Language Day!</b><br>" .
            "It's a worldwide annual observance held on 21 February to promote awareness of linguistic" .
            " and cultural diversity and to promote multilingualism. First announced by UNESCO on 17 November 1999,
            it was formally recognized by the United Nations General Assembly with the adoption of UN resolution
            56/262 Multilingualism in 2002. Mother Language Day is part of a broader initiative \"to promote 
            the preservation and protection of all languages used by peoples of the world as adopted by 
            the UN General Assembly on May 16, 2007 in UN resolution 61/266, 
            which also established 2008 as the International Year of Languages. The idea to celebrate International 
            Mother Language Day was the initiative of Bangladesh. In Bangladesh 21 February is the anniversary of 
            the day when Bangladeshis fought for recognition for the Bangla language.</p>";
        break;
    case "22":
        echo "<p><img src=\"https://upload.wikimedia.org/wikipedia/commons/3/3a/Cat03.jpg\"
             alt=\"photo\" style=\"float:right;max-width:25%;height:auto;margin-left:10px;\"><b>Today is " . $thismonth . " " . $day .
            "! It's Cat Day!</b><br>" .
            "Cat Day started in Japan in 1987, known as \"Neko no Hi\", and was chosen to be on February 22nd 
             because the date's numbers 2/22 (ni ni ni) sounds kind of like the words we use for cat sounds, 
             \"meow meow meow\", or \"nyan nyan nyan\" in Japanese. This day has been growing worldwide 
             for the fun social aspect of the day.</p>";
        break;
    default:
        echo "Day check error!";
        break;
}
?>