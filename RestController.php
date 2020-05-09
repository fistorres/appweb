<?php
require_once("ArticleRestHandler.php");

//identify the request method.
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {

      case 'POST':
      	 $articleRestHandler = new ArticleRestHandler();
	       $articleRestHandler->insertArticle($_POST["id"],$_POST["title"]);
     	   break;

      case 'GET':
    	 $view = "";
	     if(isset($_GET["view"])) {
		        $view = $_GET["view"];

            switch($view){
            	      case "all":
            		          // to handle REST Url /article/
            		          $articleRestHandler = new ArticleRestHandler();
            		          $articleRestHandler->getAllArticles();
            		          break;

            	      case "single":
            		          // to handle REST Url /article/<id>/
            		          $articleRestHandler = new ArticleRestHandler();
            		          $articleRestHandler->getArticle($_GET["id"]);
            		          break;

            	      case "" :
            		        //404 - not found;
            	          break;
            }
       }
            break;


       $rank = "";
       if(isset($_GET["rank"])) {
		        $rank = $_GET["rank"];

            switch ($rank) {

              case "rank":
                    // to handle REST Url /article/rank/<id>/
                    $articleRestHandler = new ArticleRestHandler();
                    $articleRestHandler->getArticleScore($_GET["id"]);

                break;

              case "" :
                  //404 - not found;
                  break;
            }

       }


      case "" :
      	 //404 - not found;
	        break;
}
?>
