<?php
/*
A domain Class to demonstrate RESTful web services
*/
Class Article {

  private $ids;
	private $titles;
  private $all_articles;

      	private function readFiles($disease){
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
      // echo exec("echo array: $this->all_articles");
      // var_dump($this->all_articles);

	}

	public function getAllArticle($disease){
		$this->readFiles($disease);
    return $this->all_articles;
		#return $this->ids;
	}

	public function getArticle($id){
		$this->readFiles();
		return array($id => $this->titles[$id]);
	}

  	public function getScore($id){
    	    echo shell_exec("echo id: {$id}");
	        $score =  shell_exec("/home/aw49187/public_html/ex5/getscore.sh {$id}");

	    return array($id => $score);

	}
  	public function updateScore($id,$vote) {

        #chmod("./AsthmaScores.txt", 0707);
          #echo exec("./updateScore.sh {$id} {$vote}");
    	  exec("./updateScore.sh {$id} {$vote} ");


   	}

}
?>
