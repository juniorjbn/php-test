<?php
$url = 'http://' . (getenv('SERVICE') ?: 'php') . ':' . (getenv('PORT') ?: '8080') . '/empty?hit=';
for ($i=1; $i<=$_GET['lines']; $i++) {
    echo $url.$i . "<br>\n";
    $ch = curl_init($url.$i);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);
}
?>
<p>
<a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">back</a>
