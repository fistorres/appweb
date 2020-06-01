<?php
/*
A domain Class to demonstrate RESTful web services
*/
Class Article {

  private $ids;
	private $titles;
  private $all_articles;

      	private function readFilesAll($disease){
	        $filename = $disease.".txt";
      		$handle = fopen($filename, "r");
      		$contents = fread($handle, filesize($filename));
      		$this->ids = explode("\n",$contents);
      		fclose($handle);

		      $filename = $disease."Titles.txt";
      		$handle = fopen($filename, "r");
      		$contents = fread($handle, filesize($filename));
      		$this->titles = explode("\n",$contents);
      		fclose($handle);

          $filename = $disease."Scores.txt";
          $handle = fopen($filename, "r");
          $contents = fread($handle, filesize($filename));
          $scores = explode("\n",$contents);
          fclose($handle);


      $this->all_articles = array();

    for ($i = 0 ; $i < (count($this->titles)-1) ; ++$i){
        	$article_array =  array('ids' => $this->ids[$i],'titles' => $this->titles[$i],'scores' => $scores[$i]);
          array_push($this->all_articles, $article_array);
    }
      // var_dump($this->all_articles);

      // echo exec("echo : {$test}");
      array_multisort(array_column($this->all_articles, 'scores'), SORT_DESC, SORT_NUMERIC, $this->all_articles);
      // var_dump($this->all_articles);

	}

  private function readFiles($disease){

	        $filename = $disease.".txt";
      		$handle = fopen($filename, "r");
      		$contents = fread($handle, filesize($filename));
      		$this->ids = explode("\n",$contents);
      		fclose($handle);

		      $filename = $disease."Titles.txt";
      		$handle = fopen($filename, "r");
      		$contents = fread($handle, filesize($filename));
      		$t = explode("\n",$contents);
      		fclose($handle);

		      $this->titles=array_combine($this->ids,$t);
	}

	public function getAllArticle($disease){
		$this->readFilesAll($disease);
		return $this->all_articles;
		#return $this->ids;
	}

	public function getArticle($id,$disease){
		$this->readFiles($disease);
		return array($id => $this->titles[$id]);
	}

  public function getScore($id,$disease){
          // var_dump($id);
	    $score =  shell_exec("/home/aw49187/public_html/ex5/getscore.sh {$id} {$disease}");
	    return array($id => $score);

	}

  public function insertArticle($disease,$id,$title){

    // var_dump($disease,$id,$title);

    $file = $disease.".txt";
    $new_id= "{$id}\n";
    file_put_contents($file, $new_id, FILE_APPEND | LOCK_EX);

    $file = $disease."Titles.txt";
    $new_title= "{$title}\n";
    file_put_contents($file, $new_title, FILE_APPEND | LOCK_EX);

    $file = $disease."Links.txt";
    $new_link= "https://www.ncbi.nlm.nih.gov/pubmed/{$id}\n";
    file_put_contents($file, $new_link, FILE_APPEND | LOCK_EX);

    $file = $disease."Scores.txt";
    file_put_contents($file, "0\n", FILE_APPEND | LOCK_EX);

	}

  	public function updateScore($id,$vote,$disease) {
      // var_dump($id);
      // var_dump($vote);
      // var_dump($disease);
    	exec("./updateScore.sh {$id} {$vote} {$disease}");

 	}

  public function getHint($query){

    $a = array("Asthma", "Anemia", "Angioma", "Arthritis","Cirrhosis","Diabetes","Alzheimer","Tuberculosis");

    // get the q parameter from URL
    $q = $query;

    $hint = "";

    // lookup all hints from array if $q is different from ""
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($a as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($hint === "") {
                    $hint = $name;
                } else {
                    $hint .= ", $name";
                }
            }
        }
    }

    // Output "no suggestion" if no hint was found or output correct values
    return $hint === "" ? "no suggestion" : array('Suggestions'=>$hint);

	}

 public function getPhotos($disease){
   $filename = "../".$disease."Photos.txt";
   $handle = fopen($filename, "r");
   $contents = fread($handle, filesize($filename));
   $photos = explode("\n",$contents);
   fclose($handle);

   return array('photos'=>$photos);

 }



}
?>
