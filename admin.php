<?php
session_start();
require_once 'data.php';
$war = 0;
$hash = 'yourHashedPassword';

if (array_key_exists('psswd', $_POST)) {
    if (password_verify($_POST['psswd'], $hash)) {
        $_SESSION['admin'] = TRUE;
    } else {
        $war = 1;
    }
}

// admin logout
if (array_key_exists('logout', $_GET)) { 
    unset($_SESSION['admin']);
    header("Location: ?");
    exit;
}

// logged admin
if (array_key_exists('admin', $_SESSION)) {
    $actPage = NULL;
    // if page is selected
    if (array_key_exists('page', $_GET)) {
        // save selected page into actual page
        $actPage = $listOfPages[$_GET['page']];
    }

    // check URL if admin wants to add new, delete or order
    if (array_key_exists("action", $_GET)) {
        $action = $_GET['action'];
        if ($action == "create") {
            $actPage = new page("", "", "", "");
        } elseif ($action == "delete") {
            // catch delete action in admin.js and ask for confirmation
            $actPage->delete();
            header("Location: ?");
            exit;
        } elseif ($_GET['action'] == 'adminw') {
            header("Location: ?");
            exit;
        } elseif ($action == "setOrder") {
            page::saveOrder($_POST['pageOrder']);
            echo "OK";
            exit;
        }
    }
    
    if (array_key_exists('content', $_POST)) {
        // need to save old id for rewriting existing page in database
        $oldId = $actPage->getId();
        $actPage->setId($_POST['id']);
        $actPage->setTitle($_POST['title']);
        $actPage->setMenu($_POST['menu']);
        $actPage->save($oldId);
        $actPage->setContent($_POST['content']);
        // redirect page to new id
        header("Location: ?page=" . $actPage->getId());
        exit;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrace</title>
        <link rel="stylesheet" href="css/style_admin.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="shortcut icon" href="faviconA.ico"/> 
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="admin.js"></script>
    </head>
    <body>
        <div id="container">
        <header>
        <?php
        if (array_key_exists('action', $_GET) && $_GET['action'] == 'mess') {
            echo "<h1>Došlé zprávy</h1>";
        } else {
            echo "<h1>Admin penzion</h1>";
        }
        ?>
        </header>

        <?php
        // not logged
        if (!array_key_exists('admin', $_SESSION)) {
        // log form
            ?>
        <form id="first" action="" method="POST" >
            <?php if ($war == 1) {
                echo "<span class='upozorneni'>Špatné heslo!</span><br />";
            } ?>
            <i class="fa fa-sign-in" aria-hidden="true"></i> Heslo: <input type="password" name='psswd' />
            <input type="submit" value="Přihlásit" /><br /><br /><br />
        </form>

        <?php
    } else {
        if (array_key_exists('action', $_GET) && $_GET['action'] == 'mess') {
            echo "<div id='adminw'><a href='?action=adminw'>administrace</a></div>";
        } else {
            echo "<div id='mess'><a href='?action=mess'>zprávy</a></div>";
        }
        echo "<div id='help'><a href='?action=help'>nápověda</a></div>";
        echo "<div id='log'><a href='?logout'>odhlásit se</a></div>";

        // print list of pages for editing
        ?>
        <section>
            
        <?php
     if (!((array_key_exists('action', $_GET)) && ($_GET['action'] == 'mess'))) {
        
        echo "<div class='polozky'>
            <h2>Seznam stránek:</h2>
        <ul id='editMenu'>";
        foreach ($listOfPages as $pageId => $parametersOfPage) {
            // print all pages except 404
            if ($parametersOfPage->getMenu() != "") {
                echo "<li dataPageId='$pageId'>";
                echo "<a id='cross' href='?action=delete&page=$pageId'><i class='fa fa-times' aria-hidden='true'></i></a> ";
                echo "<a href='?page=$pageId'>{$parametersOfPage->getMenu()}</a>";
                echo "</li>";
            }
        }
        ?>
                <li>
                    <a href="?action=create"><i class="fa fa-plus" aria-hidden="true"></i> Přidat stránku</a>
                </li>
            </ul>
                </div>            
<?php       } ?>
              
                    <?php
                    // if page is selected
                    if ($actPage != NULL) {
                        echo "<div class='part'>";
                        if ($actPage->getId()) {
                            echo "<h2>Editace stránky [{$actPage->getId()}]:</h2>";
                        } else {
                            echo "<h2>Vytvoření nové stránky: </h2>";
                        }
                        // show editing form plugin
                        ?>
                <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
                <script>tinymce.init({
                        selector: 'textarea',
                        plugins: "code",
                        toolbar: "code",
                        menubar: "tools"
                    });</script>

                <form method="POST">
                    <table>
                        <tr><td>id: </td><td><input type="text" name="id" value="<?php echo htmlspecialchars($actPage->getId()); ?>"></td></tr>
                        <tr><td>titulek:</td><td><input type="text" name="title" value="<?php echo htmlspecialchars($actPage->getTitle()); ?>"></td></tr>
                        <tr><td>menu:</td><td><input type="text" name="menu" value="<?php echo htmlspecialchars($actPage->getMenu()); ?>"></td></tr>
                    </table>
                    <textarea  rows="40" cols="50" name='content'>
                    <?php
                    // show content
                    echo htmlspecialchars($actPage->getContent());
                    ?>               
                    </textarea>
                    <input type="submit" value="Editovat" />
                </form>
            </div>

        <?php
    } elseif (array_key_exists('action', $_GET) && $_GET['action'] == 'mess') {
        ?>        
                <div class='mess'>
                    <h2>Přijaté zprávy (posledních 15):</h2>
                    <div class="messBox">
                    <?php
                    $rows = DB::doSql("SELECT * FROM mess ORDER BY date DESC LIMIT 15");
                    foreach ($rows as $row) {

                        echo "
<div class='messBody'>
                    <span class='date'>{$row['date']} |</span>
                    <span class='email'><a href='mailto:{$row['email']}'>{$row['email']}</a> | </span>
                    <span class='name'>{$row['name']}</span>
                    <span class='surname'>{$row['surname']} | </span>
                    <span class='text'>{$row['text']}</span>
</div>";
                    }
                    echo "</div>";
                    ?>
                    </div>
                        <?php
                    } elseif (array_key_exists('action', $_GET) && $_GET['action'] == 'help') {
                        ?>
                    <div class='help'>

                        <h2>Nápověda:</h2>
                        <ol class='seznam_lines'>
                            <li>Sekce 'Seznam stránek': 
                                <ul style="list-style-type: none" class='seznam_lines'>    
                                    <li>1. Přidání nové stránky provedeme pomocí <i class="fa fa-plus" aria-hidden="true"></i></li>
                                    <li>2. Editace existující stránky kliknutím na její název</li>
                                    <li>3. Odstranění stránky pomocí <i class='fa fa-times' aria-hidden='true'></i></li>
                                </ul>
                            </li>
                            <li>Je možné také určovat pořadí držením a přesunutím položky v seznamu.</li>
                        </ol>
                    </div>
        <?php
    } else {
        ?> 
                    <div class='part'>
                        <h2>Vítej na stránce administrace Penzionu</h2>
                        <p>Nápověda je v pravé části obrazovky pod piktogramem <img src="images/question.png"></p>
                    </div>
        <?php
    }
}
?>
        </section>
    </div>
</body>
</html>
