<?php
echo getcwd() . "\n";
include('../app/controllers/simple_html_dom.php');

//$html = file_get_html('https://www.google.com/search?client=safari&rls=en&q=google+jobs&ie=UTF-8&oe=UTF-8&ibp=htl;jobs&sa=X&ved=2ahUKEwjI2qu1l6OCAxUYl2oFHZJ0Dd0QudcGKAF6BAgRECo');
$html = file_get_html('https://www.google.com');

echo $html->find('title', 0)->plaintext;
?>