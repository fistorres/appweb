<html>
<head>
<script>
function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";

        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);
                myArr = myArr['Suggestions'];
                document.getElementById("txtHint").innerHTML = myArr;
            }
        };
        xmlhttp.open("GET", "ex5/gethint/" + str + "/", true);
        xmlhttp.setRequestHeader('Accept', 'application/json');
        xmlhttp.send();
    }
}

function updatePhotos() {
    str = document.getElementById("searchDisease").value;
    console.log(str);
    if (str.length == 0) {
        document.getElementById("latestPhotos").innerHTML = "";
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
              var myArr = JSON.parse(this.responseText);


              var elm = document.getElementById("latestPhotos");
              elm.innerHTML = '';
              for (var i = 0; i < myArr['photos'].length; i++) {
                myImg = '<a href="' + myArr['photos'][i] + '"><img src="' + myArr['photos'][i] + '" /></a></br>';
                elm.insertAdjacentHTML( 'beforeend', myImg );
            }
            }
        };
        xmlhttp.open("GET", "ex5/getphotos/" + str + "/", true);
        xmlhttp.setRequestHeader('Accept', 'application/json');
        xmlhttp.send();
    }
setTimeout(updatePhotos,3000);
}

</script>
</head>
<body onload='updatePhotos()'>

    <form action='mywebapp.php' method='get' autocomplete='off'>
        <p>Disease: <input type='text' id="searchDisease" name='disease' onkeyup="showHint(this.value)" value="<?php echo htmlspecialchars($_GET['disease']); ?>"/>
	Suggestions: <span id="txtHint"></span></p>
        <p><input type='submit' /> </p>
    </form>

<p>About the disease <?php echo htmlspecialchars($_GET['disease']); ?>:</p>

<?php
function array_combine2($arr1, $arr2) {
    $count = min(count($arr1), count($arr2));
    return array_combine(array_slice($arr1, 0, $count), array_slice($arr2, 0, $count));
}

$disease_name = str_replace(' ','+',$_GET['disease']);


echo '<h2> DBpedia photo </h2>';

$filename = $disease_name."DBpediaPhotos.txt";
$handle = fopen($filename, "r");
$content = fread($handle, filesize($filename));
fclose($handle);
if (!empty($disease_name)) {
   echo '<a href="'. $content .'"><img width="600" height="400" src="'. $content .'" /></a></br>';
}

$filename = $disease_name."DBenAbs.txt";
if (file_exists($filename)) {
        $handle = fopen($filename, "r");
        $content = fread($handle, filesize($filename));
        echo "<h2> Abstract: </h2>";
        echo "<p> $content </p>";

}


$filename = $disease_name."DBptAbs.txt";
if (file_exists($filename)) {
	$handle = fopen($filename, "r");
	$content = fread($handle, filesize($filename));
	echo "<h2> Resumo: </h2>";
	echo "<p> $content </p>";

}

$filename = $disease_name."Deaths.txt";

if (file_exists($filename)) {

	$handle = fopen($filename,"r");
	$first = True;



	echo "<h3> Persons that died from the disease: </h3>";

	if ($handle) {

	echo "<table style='width:40%'>";

	    while (($line = fgets($handle)) !== false) {

		$info = explode(";;",$line);
        	$person = $info[0];
        	$date = $info[1];
		$nationality = $info[2];
        	$occupation = $info[3];

		if ($first) {
			echo "<tr>";
			echo "<th> $person </th>";
                	echo "<th> $date </th>";
			echo "<th> $nationality </th>";
                	echo "<th> $occupation </th>";
			echo "</tr>";
			$first= False;
		}
		else {
			echo "<tr>";
                	echo "<td> $person</td>";
                	echo "<td> $date </td>";
			echo "<td> $nationality </td>";
                	echo "<td> $occupation </td>";
                	echo "</tr>";
		}

    	}
	fclose($handle);
	echo "</table>";

    	} else {
    // error opening the file.
	}
}


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

	echo '<h2> PubMed Links </h2>';
	echo '<div vocab="http://schema.org/" typeof="ScholarlyArticle" resource="#article">';

	for ($i = 0 ; $i < (count($titles)-1) ; ++$i){
		echo '<meta property="datePublished" content="' . $dates[$i] . '">' . $dates[$i] . ': ';
		echo '<span property="title">';
		echo '<a href="' . $links[$i] . '\">' . $titles[$i] . '</a></br>';
		echo '</span>';
                	}
	echo '</div>';
}
####
$filename = $disease_name."WikiLinks.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
$links = explode("\n",$contents);

# shows links in screen
$filename = $disease_name."WikiTitles.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
$titles = explode("\n",$contents);
fclose($handle);

$c=array_combine2($links,$titles);


echo '<h2> Wikipedia Links </h2>';
foreach ($c as $key => $value) {
  echo '<a href="' . $key . '">' . $value . '</a></br>';
}
####
$filename = $disease_name."DiShInScores.txt";
if (file_exists($filename)) {
	$handle = fopen($filename, "r");
	$contents = fread($handle, filesize($filename));
	$scores = explode("\n",$contents);
	fclose($handle);

	echo '<h2> Similarity by Resnik score between ' . $disease_name . ' and: </h2>';
	echo '<ul>';
	foreach ($scores as $s) {
		if (!empty($s)) {
       	 	 	echo '<li>' . $s  . '</li>';
		}
	}
	echo '</ul>';
}
####
# flickr photos go here...
echo "<p><span id='latestPhotos'></span></p>";

?>
</html>
