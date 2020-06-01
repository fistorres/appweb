<?php
require_once("ArticleRestHandler.php");

//identify the request method.
$requestType = $_SERVER['REQUEST_METHOD'];

switch ($requestType) {

      case 'POST':

      $add= "";
       if(isset($_GET["add"])) {
           $add= $_GET["add"];
           switch ($add) {

             case "add":
                   // to handle REST Url /article/rank/<id>/<vote>/
                   $articleRestHandler = new ArticleRestHandler();
                   $articleRestHandler-> insertArticle($_GET["disease"],$_GET["id"],$_GET["title"]);
               break;

             case "" :
                 //404 - not found;
                 break;
           }
    }

      	 #$articleRestHandler = new ArticleRestHandler();
	       #$articleRestHandler->insertArticle($_POST["id"],$_POST["title"]);
       	 $rank = "";
          if(isset($_GET["rank"])) {
  		        $rank = $_GET["rank"];
              switch ($rank) {

                case "vote":
                      // var_dump($_GET["disease"]);
                      // to handle REST Url /article/rank/<id>/<vote>/
		                  $articleRestHandler = new ArticleRestHandler();
                      $articleRestHandler->updateScore($_GET["id"],$_GET["vote"],$_GET["disease"]);
                      break;

                case "" :
                    //404 - not found;
                      break;
              }
	}
     	   break;

      case 'GET':
    	$view = "";
	    if(isset($_GET["view"])) {
		        $view = $_GET["view"];

            switch($view){
            	      case "all":
            		          // to handle REST Url /article/
                          // var_dump($_GET["disease"]);
            		          $articleRestHandler = new ArticleRestHandler();
            		          $articleRestHandler->getAllArticles($_GET["disease"]);
            		          break;

            	      case "single":
            		          // to handle REST Url /article/<id>/
            		          $articleRestHandler = new ArticleRestHandler();
            		          $articleRestHandler->getArticle($_GET["id"],$_GET["disease"]);
				                  break;

            	      case "" :
            		        //404 - not found;
	            	          break;
            }
       }


      $rank = "";
      if(isset($_GET["rank"])) {
	    $rank = $_GET["rank"];

            switch ($rank) {

              case "rank":
                    // to handle REST Url /article/rank/<id>/
                    $articleRestHandler = new ArticleRestHandler();
                    $articleRestHandler->getArticleScore($_GET["id"],$_GET["disease"]);
                break;

              case "" :
                  //404 - not found;
                  break;
            }
       }

       $gethint = "";
 	    if(isset($_GET["gethint"])) {
 		        $gethint = $_GET["gethint"];

             switch($gethint){
             	      case "gethint":
             		          // to handle REST Url /article/
                           // var_dump($_GET["disease"]);
             		          $articleRestHandler = new ArticleRestHandler();
             		          $articleRestHandler->getHint($_GET["query"]);
             		          break;

             	      case "" :
             		        //404 - not found;
 	            	          break;
             }
        }

        if(isset($_GET["getphotos"])) {
   		        $getphotos = $_GET["getphotos"];

               switch($getphotos){
               	      case "getphotos":
               		          // to handle REST Url /article/
                             // var_dump($_GET["disease"]);
               		          $articleRestHandler = new ArticleRestHandler();
               		          $articleRestHandler->getPhotos($_GET["disease"]);
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
