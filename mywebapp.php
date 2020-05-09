<html>
    <form action='mywebapp.php' method='get'>
        <p> Disease: <input list="diseases" type='text' name='disease' /> </p>
        <p><input type='submit' /> </p>
    </form>

<p>About the disease <?php echo htmlspecialchars($_GET['disease']); ?>:</p>


<?php
function array_combine2($arr1, $arr2) {
    $count = min(count($arr1), count($arr2));
    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
}

$disease_name = str_replace(' ','+',$_GET['disease']);


$filename = $disease_name."Links.txt";
if (file_exists($filename)) {
        # uses disease given as input to creat DiseaseLinks.txt string
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

        $filename = $disease_name."Date.txt";
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        $dates = explode("\n",$contents);
        fclose($handle);

  $filename = $disease_name."Scores.txt";
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        $scores = explode("\n",$contents);
        fclose($handle);

  $all_info = array();
  for ($i = 0 ; $i < (count($titles)-1) ; ++$i){
	$article_array =  array('links'=> $links[$i], 'titles' => $titles[$i],'dates' => $dates[$i],'scores' => $scores[$i]);

   	array_push($all_info, $article_array);
}

  array_multisort(array_column($all_info, 'scores'), SORT_DESC, SORT_NUMERIC, $all_info);


        echo '<h2> PubMed Links </h2>';
        echo '<div vocab="http://schema.org/" typeof="ScholarlyArticle" resource="#article">';

	foreach($all_info as $article) {
                echo '<meta property="datePublished" content="' . $article['dates'] . '">' . $article['dates'] . ': ';
                echo $article['scores'];
		echo '<span property="title">';
                echo '<a href="' . $article['links'] . '\">' . $article['titles'] . '</a></br>';
                echo '</span>';

	}
	
	echo '</div>';

}
?>
</html>
