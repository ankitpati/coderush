<?php

    header("Expires: Wed, 13 Dec 1995 05:43:00 GMT");
    header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
    header("Cache-Control: private, no-store, max-age=0, no-cache, must-revalidate, post-check=0, pre-check=0");

?>

<!DOCTYPE html>

<!-- index.php -->
<!-- Date  : 13 November 2016
   - Author: Ankit Pati
   -->

<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <meta name="theme-color" content="#300a24" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>CodeRush</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body spellcheck="false">

            <h1>CodeRush</h1>

<?php
    function login($reason)
    {
?>
        <div id="superset">
<?php
        if(isset($reason)) {
?>
            <div id="note"><?= htmlspecialchars($reason) ?></div>
<?php
        }
?>
            <h2>Login</h2>
            <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                <input placeholder="Username" name="username" required="required" />
                <br />
                <br />
                <input type="password" placeholder="Password" name="password" required="required" />
                <br />
                <br />
                <div class="bottom">
                    <input class="button bottom" type="submit" value="Done" />
                </div>
            </form>
        </div>
<?php
    }
?>

<?php
    function console($welcome)
    {
?>
            <div id="superset">
                <h2><div class="truncate" title="<?= htmlspecialchars($welcome) ?>"><?= htmlspecialchars($welcome) ?></div>
                    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                        <input class="button" id="logout" type="submit" name="logout" value="Logout" />
                    </form>
                </h2>
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                    <input class="button" id="usermanage" type="submit" name="usermanage" value="Create/Update User" />
                </form>
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                    <input class="button" id="list" type="submit" name="list" value="List Submissions" />
                </form>
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                    <input class="button" id="dlsubmit" type="submit" name="dlsubmit" value="Download Submissions" />
                </form>
            </div>
<?php

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["list"])) {
            $ext_permit=array("c", "h", "cc", "cpp", "cxx", "c++", "hh", "hpp", "hxx", "h++", "java");
?>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Level</th>
                    <th>Question</th>
                    <th>Language</th>
                    <th>Time</th>
                </tr>
<?php
                if($handle = opendir("./uploads/")) {
                    while(($entry = readdir($handle)) !== false) {
?>
                <tr>
<?php
                        $mtime = filemtime("./uploads/".$entry);
                        $mtime = date("H:i:s", $mtime)." IST";
                        $ext = pathinfo($entry, PATHINFO_EXTENSION);
                        if($entry != "." && $entry != ".." && in_array($ext, $ext_permit)) {
                            $cells = explode("_", $entry, 3);
                            $lang = explode(".", $cells[2], 2);
?>
                            <td title="<?= htmlspecialchars($cells[0]) ?>"><a href="./uploads/<?= $entry ?>" target="_blank"><?= htmlspecialchars($cells[0]) ?></a></td>
                            <td><a href="./uploads/<?= $entry ?>" target="_blank"><?= htmlspecialchars($cells[1]) ?></a></td>
                            <td><a href="./uploads/<?= $entry ?>" target="_blank"><?= htmlspecialchars($lang [0]) ?></a></td>
                            <td><a href="./uploads/<?= $entry ?>" target="_blank"><?= htmlspecialchars($lang [1]) ?></a></td>
                            <td title="<?= htmlspecialchars($mtime) ?>"><a href="./uploads/<?= $entry ?>" target="_blank"><?= htmlspecialchars($mtime) ?></a></td>
<?php
                        }
?>
                </tr>
<?php
                    }
                    closedir($handle);
                }
?>
            </table>
<?php
        }else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["newusername"]) && isset($_POST["newpassword"])) {
                $con = mysqli_connect("localhost", "coderush", "coderush", "coderush");
                $username = preg_replace("/[^A-Za-z0-9_.@\-]/", "_", $_POST["newusername"]);
                $username = substr($username, 0, 255);
                $password = substr($_POST["newpassword"], 0, 100);
                $admin = 0;
                if(isset($_POST["newadmin"])) {
                    $admin = 1;
                }
                mysqli_query($con, "insert into users (username, password, admin) values('".mysqli_real_escape_string($con, $username)."', '".mysqli_real_escape_string($con, $password)."', '".mysqli_real_escape_string($con, $admin)."') on duplicate key update password='".mysqli_real_escape_string($con, $password)."', admin='".mysqli_real_escape_string($con, $admin)."';");
                mysqli_close($con);
?>
            <div id="superset">
                <div id="note">
                    Changes Applied
                </div>
            </div>
<?php
        }
        else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["usermanage"])) {
?>
            <div id="superset">
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                    <p>Create/Update User</p>
                    <input placeholder="New Username" name="newusername" required="required" />
                    <br />
                    <br />
                    <input type="password" placeholder="New Password" name="newpassword" required="required" />
                    <br />
                    <br />
                    <input type="checkbox" id="newadmin" name="newadmin" value="1" />
                    <label for="newadmin"><span><span></span></span>Administrator</label>
                    <br />
                    <br />
                    <div class="bottom">
                        <input class="button bottom" type="submit" value="Done" />
                    </div>
                </form>
            </div>
<?php
        }
        else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["dlsubmit"])) {
            $ext_permit = array("c", "h", "cc", "cpp", "cxx", "c++", "hh", "hpp", "hxx", "h++", "java");
            $zip = new ZipArchive();
            $zip->open("uploads/code.zip", ZipArchive::CREATE);
            if($handle = opendir("uploads/")) {
                while(($entry = readdir($handle)) !== false) {
                    $ext = pathinfo($entry, PATHINFO_EXTENSION);
                    if($entry != "." && $entry != ".." && in_array($ext, $ext_permit)) {
                        $zip->addFile("uploads/".$entry);
                    }
                }
                closedir($handle);
            }
            $zip->close();
            header("Content-Type: application/zip");
            header("Content-Disposition: attachment; filename='uploads/code.zip'");
            header("Content-Length: ".filesize("uploads/code.zip"));
            header("Location: uploads/code.zip");
        }
    }
?>

<?php
    function workspace($welcome)
    {
?>
            <div id="superset">
                <h2><div class="truncate" title="<?= htmlspecialchars($welcome) ?>"><?= htmlspecialchars($welcome) ?></div>
                    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                        <input class="button" id="logout" type="submit" name="logout" value="Logout" />
                    </form>
                </h2>
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                    <input class="button" id="debug" type="submit" name="debug" value="Debug Files" />
                    <br />
                    <br />
                </form>
<?php

        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["level"]) && isset($_POST["ques"]) && isset($_FILES["ans"])) {
            $ext_permit = array("c", "h", "cc", "cpp", "cxx", "c++", "hh", "hpp", "hxx", "h++", "java");
            $ext = pathinfo($_FILES["ans"]["name"], PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            if(in_array($ext, $ext_permit)) {
                $con = mysqli_connect("localhost", "coderush", "coderush", "coderush");

                $level = preg_replace("/[^0-9]/", "_", $_POST["level"]);
                $ques = preg_replace("/[^0-9]/", "_", $_POST["ques"]);
                $ans = preg_replace("/[^A-Za-z0-9_.@\-]/", "_", $welcome."_".$level."_".$ques);

                $ans = substr($ans, 0, 250);
                $ext = substr($ext, 0, 4);

                $ans = $ans.".".$ext;

                $fin = fopen($_FILES["ans"]["tmp_name"], "rb");
                $fout = fopen("./uploads/".$ans, "wb");

                $data = fread($fin, $_FILES["ans"]["size"]);

                fwrite($fout, $data);
                fclose($fout);
                mysqli_query($con, "insert into submit (username, level, ques, ans, curtime) values('".mysqli_real_escape_string($con, $welcome)."', '".mysqli_real_escape_string($con, $_POST["level"])."', '".mysqli_real_escape_string($con, $_POST["ques"])."', '".mysqli_real_escape_string($con, $ans)."', now()) on duplicate key update ans='".mysqli_real_escape_string($con, $ans)."';");
                mysqli_close($con);
?>
                <div id="note">
                    Code Uploaded
                </div>
<?php
            }
            else {
?>
                <div id="note">
                    Unsupported Language
                </div>
<?php
            }
        }
        else if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["debug"])) {
            $ext_permit = array("c", "h", "cc", "cpp", "cxx", "c++", "hh", "hpp", "hxx", "h++", "java");
            $zip = new ZipArchive();
            $zip->open("uploads/debug.zip", ZipArchive::CREATE);
            if($handle = opendir("debug/")) {
                while(($entry = readdir($handle)) !== false) {
                    $ext = pathinfo($entry, PATHINFO_EXTENSION);
                    if($entry != "." && $entry != ".." && in_array($ext, $ext_permit)) {
                        $zip->addFile("debug/".$entry);
                    }
                }
                closedir($handle);
            }
            $zip->close();
            header("Content-Type: application/zip");
            header("Content-Disposition: attachment; filename='uploads/debug.zip'");
            header("Content-Length: ".filesize("uploads/debug.zip"));
            header("Location: uploads/debug.zip");
        }
?>
                <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data" autocomplete="on">
                    <input placeholder="Level" name="level" maxlength="1" pattern="^[1-3]{1}$" title="1, 2, or 3" required="required" />
                    <br />
                    <br />
                    <input placeholder="Question" name="ques" maxlength="2" pattern="^[0-9]{1,2}$" title="Maximum of 2 digits" required="required" />
                    <br />
                    <br />
                    <input type="file" name="ans" required="required" />
                    <div class="bottom">
                        <input class="button bottom" type="submit" value="Done" />
                    </div>
                </form>
            </div>
<?php
    }
?>

<?php
    if(isset($_POST["logout"])) {
        setcookie("username", "", 1);
        setcookie("password", "", 1);
        login("Logged Out");
    }
    else if(isset($_POST["username"]) && isset($_POST["password"])) {
        $con = mysqli_connect("localhost", "coderush", "coderush", "coderush");
        $result = mysqli_query($con, "select username, password from users where username='".mysqli_real_escape_string($con, $_POST["username"])."';");
        $tuples = mysqli_fetch_array($result);
        mysqli_free_result($result);
        mysqli_close($con);
        if($_POST["username"] === $tuples[0] && $_POST["password"] === $tuples[1]) {
            setcookie("username", $_POST["username"]);
            setcookie("password", $_POST["password"]);
            header("Location: index.php");
            die();
        }
        else {
            login("Incorrect Credentials");
        }
    }
    else if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
        $con = mysqli_connect("localhost", "coderush", "coderush", "coderush");
        $result = mysqli_query($con, "select username, password, admin from users where username='".mysqli_real_escape_string($con, $_COOKIE["username"])."';");
        $tuples = mysqli_fetch_array($result);
        mysqli_free_result($result);
        mysqli_close($con);
        if($_COOKIE["username"] === $tuples[0] && $_COOKIE["password"] === $tuples[1]) {
            if($tuples[2] === "1") {
                console($_COOKIE["username"]);
            }
            else {
                workspace($_COOKIE["username"]);
            }
        }
        else {
            login();
        }
    }
    else {
        login();
    }
?>
    </body>
</html>
<!-- end of index.php -->
