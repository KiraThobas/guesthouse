<?php
require_once 'data.php';

if (array_key_exists ("page", $_GET))
{
    $page = $_GET['page'];
    if (!array_key_exists ($page, $listOfPages))
    {
        // if page in URL isn't in listOfPages, it doesn't exist - 404
        $page = "404";
        // send code 404 for browser, delete from index
        // http_response_code(404);
    }
}
else 
{
   // no page in URL, show first page from listOfPages
   $page = array_keys($listOfPages)[0];
   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php
        if(array_key_exists ($page, $listOfPages)){
            echo $listOfPages[$page]->getTitle();
        }
        ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="favicon.ico"/> 
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=EB+Garamond" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="admin.js"></script>
    </head>
    <body>
        <div class="container" id="container">
            <a class="admin" href="./admin.php"><i class="fa fa-lock" aria-hidden="true"></i> ADMIN</a>
        <header>
            <div class="logo"></div>
            <div class="logo2">Penzion Medvědí skála</div>
        
            <div class="nav">
                <ul>
                    <?php
                    foreach ($listOfPages as $pageId => $parametersOfPage)
                    {
                        // print menu of all pages from list except 404
                        if ($parametersOfPage->getMenu() != "")
                        {
                            echo "<li";
                            if ($pageId==$page)
                            {
                                echo ' class="current-menu-item"';
                            }
                            echo "><a href='$pageId'>{$parametersOfPage->getMenu()}</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </header>
            <section>
            <?php
            if($page=='404'){
                require '404.php';
            } else{ ?>
                <h1> <?php echo $listOfPages[$page]->getMenu() ?> </h1>
            <?php
            echo $listOfPages[$page]->getContent();
             ?>
                <a class="up" href="#container"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
            <?php } ?>
            </section>
        <footer>
            Vytvořila Kateřina Tůmová &copy 2017
        </footer>
        </div>
    </body>
</html>
