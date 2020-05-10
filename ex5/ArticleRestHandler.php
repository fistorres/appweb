<?php
require_once("SimpleRest.php");
require_once("Article.php");

class ArticleRestHandler extends SimpleRest {

	function getAllArticles($disease) {

		$article = new Article();
		$rawData = $article->getAllArticle($disease);
		// echo exec("echo data: {$rawData}");

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No articles found!');
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($userAgent,'Chrome') !== false || strpos($userAgent,'Firefox') !== false){
    			$requestContentType = 'text/html';
		}
		$this ->setHttpHeaders($requestContentType, $statusCode);

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtmlArticles($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}

	public function encodeHtmlArticles($responseData) {

		$htmlResponse = "<table border='1'>";
		foreach($responseData as $article) {
		        if (!empty($article)) {
    			   $htmlResponse .= "<tr><td>".$article['ids']."</td><td>".$article['titles']."</td><td>".$article['scores']."</td></tr>";
			}
		}
		$htmlResponse .= "</table>";
		return "<html>".$htmlResponse."</html>";
	}

	public function encodeHtml($responseData) {

		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
						var_dump($key,$value);

		        if (!empty($value)) {
    			   $htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
			}
		}
		$htmlResponse .= "</table>";
		return "<html>".$htmlResponse."</html>";
	}

	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;
	}

	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><article></article>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}

	public function getArticle($id) {

		$article = new Article();
		$rawData = $article->getArticle($id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No articles found!');
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$userAgent = $_SERVER['HTTP_USER_AGENT'];

		if(strpos($userAgent,'Chrome') !== false || strpos($userAgent,'Firefox') !== false){
   	 		$requestContentType = 'text/html';
		}

		$this ->setHttpHeaders($requestContentType, $statusCode);

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}

	function getArticleScore($id) {

			$article = new Article();
			$rawData = $article->getScore($id);

			if(empty($rawData)) {
				$statusCode = 404;
				$rawData = array('error' => 'No articles found!');
			} else {
				$statusCode = 200;
			}

			$requestContentType = $_SERVER['HTTP_ACCEPT'];
			$userAgent = $_SERVER['HTTP_USER_AGENT'];

			if(strpos($userAgent,'Chrome') !== false || strpos($userAgent,'Firefox') !== false){
    				 $requestContentType = 'text/html';
			}
			$this ->setHttpHeaders($requestContentType, $statusCode);

			if(strpos($requestContentType,'application/json') !== false){
				$response = $this->encodeJson($rawData);
				echo $response;
			} else if(strpos($requestContentType,'text/html') !== false){
				$response = $this->encodeHtml($rawData);
				echo $response;
			} else if(strpos($requestContentType,'application/xml') !== false){
				$response = $this->encodeXml($rawData);
				echo $response;
			}
		}

	function updateScore($id,$vote) {

      $article = new Article();
      $rawData = $article->updateScore($id,$vote);
			echo shell_exec("echo rawdata: {$rawData}");

      $statusCode = 200;

      $requestContentType = $_SERVER['HTTP_ACCEPT'];
			$userAgent = $_SERVER['HTTP_USER_AGENT'];

			if(strpos($userAgent,'Chrome') !== false || strpos($userAgent,'Firefox') !== false){
     		$requestContentType = 'text/html';
			}

      $this ->setHttpHeaders($requestContentType, $statusCode);

      if(strpos($requestContentType,'application/json') !== false){
        $response = $this->encodeJson($rawData);
        echo $response;
        } else if(strpos($requestContentType,'text/html') !== false){
          $response = $this->encodeHtml($rawData);
          echo $response;
        } else if(strpos($requestContentType,'application/xml') !== false){
          $response = $this->encodeXml($rawData);
          echo $response;
        }
  }
}
?>
