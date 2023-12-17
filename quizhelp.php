<?php
    header("Content-Type: text/comma-separated-values");
    header("Content-Disposition: attachment; filename=quiz.csv;");
    header("Content-Transfer-Encoding:base64");
	echo "Question|Option A|Option B|Option C|Answer|Max Option\n";
	echo "Who plays the negative role in Om Shanti Om?|Milind Soman|Salman Khan|Arjun Rampal|c|3\n";
?>