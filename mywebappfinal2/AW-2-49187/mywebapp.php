<html>
    <form action='mywebapp.php' method='get'>
        <p> Disease: <input list="diseases" type='text' name='disease' /> </p>
        <p><input type='submit' /> </p>
    </form>

<p>Abstracts about the disease <?php echo htmlspecialchars($_GET['disease']); ?>:</p>


<?php
function array_combine2($arr1, $arr2) {
    $count = min(count($arr1), count($arr2));
    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
}

$disease_name = str_replace(' ','', $_GET['disease']); 
	
$filename = $disease_name."DBpediaPhotos.txt";
$handle = fopen($filename, "r");
$content = fread($handle, filesize($filename));
fclose($handle);
if (!empty($disease_name)) {
   echo '<a href="'. $content .'"><img width="600" height="400" src="'. $content .'" /></a></br>';
}

# uses disease given as input to creat DiseaseLinks.txt string
$filename = $disease_name."Links.txt";

# open the file with the str name
$handle = fopen($filename, "r");

# gets the content of the files
$contents = fread($handle, filesize($filename));

# explode : split string by string
$links = explode("\n",$contents);

# shows links in screen
$filename = $disease_name."Titles.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
$titles = explode("\n",$contents);
fclose($handle);

$c=array_combine2($links,$titles);

foreach ($c as $key => $value) {
  echo '<a href="' . $key . '">' . $value . '</a></br>'; 
}

$filename = $disease_name."Photos.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
$photos = explode("\n",$contents);
fclose($handle);

foreach ($photos as $p) {
  echo '<a href="'. $p .'"><img src="'. $p .'" /></a></br>';
}
               
?>
</html>
