<?php
require_once("SimpleRest.php");
require_once("Article.php");

class ArticleRestHandler extends SimpleRest {

	public function encodeHtmlArticles($responseData) {
		$counter = 0;
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $article) {
		        if (!empty($article)) {
						 $counter = $counter + 1;
    			   $htmlResponse .= "<tr><td>".$counter."</td><td>".$article['ids']."</td><td>".$article['scores']."</td></tr>";
			}
		}
		$htmlResponse .= "</table>";
		return "<html>".$htmlResponse."</html>";
	}

	public function encodeXmlArticles($responseData) {
		$xml = new SimpleXMLElement('<?xml version="1.0"?><article></article>');

		foreach($responseData as $value) {
					$xml->addChild($value['scores'], $value['ids']);
				}
			return $xml->asXML();
	}

	public function encodeHtml($responseData) {
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
			   if (!empty($value) or $value == "0") {
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
		// var_dump($responseData);
		$xml = new SimpleXMLElement('<?xml version="1.0"?><article></article>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}

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
			 foreach(array_keys($rawData) as $key) {
   				 unset($rawData[$key]['titles']);
		 }
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtmlArticles($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXmlArticles($rawData);
			echo $response;
		}
	}

	public function getArticle($id,$disease) {

		$article = new Article();
		$rawData = $article->getArticle($id,$disease);

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

	function getArticleScore($id,$disease) {

			$article = new Article();
			$rawData = $article->getScore($id,$disease);

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

	function updateScore($id,$vote,$disease) {

      $article = new Article();
      $rawData = $article->updateScore($id,$vote,$disease);

			if(empty($rawData)) {
				$statusCode = 404;
				$rawData = array('error' => 'Not found!');
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

	function insertArticle($disease,$id,$title) {

      $article = new Article();
      $rawData = $article->insertArticle($disease,$id,$title);

			if(empty($rawData)) {
				$statusCode = 404;
				$rawData = array('error' => 'Not found!');
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
	function getHint($query) {

		$article = new Article();
		$rawData = $article->getHint($query);
		// var_dump($rawData);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Not found!');
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		// $userAgent = $_SERVER['HTTP_USER_AGENT'];

		// if(strpos($userAgent,'Chrome') !== false || strpos($userAgent,'Firefox') !== false){
		// 	$requestContentType = 'text/html';
		// }

		$this ->setHttpHeaders($requestContentType, $statusCode);

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
			}


	}
	function getPhotos($disease) {

		$article = new Article();
		$rawData = $article->getPhotos($disease);
		// var_dump($rawData);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Not found!');
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		// $userAgent = $_SERVER['HTTP_USER_AGENT'];

		// if(strpos($userAgent,'Chrome') !== false || strpos($userAgent,'Firefox') !== false){
		// 	$requestContentType = 'text/html';
		// }

		$this ->setHttpHeaders($requestContentType, $statusCode);

		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);

			echo $response;
			}


	}

}

?>
