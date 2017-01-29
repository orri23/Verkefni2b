<?php
# use keyword must be declared at the top level of a script. It cannot be nested inside a conditional statement.
use File\Upload; # declaration, so you can refer to the class as Upload rather than using the fully qualified name
if (isset($_POST['upload'])) {
  //  echo "<pre>";
  //  print_r($_FILES);  # Skoðum skráarupplýsingar
  //  echo "</pre>";
    echo "<img src = 'Myndir\\" . $_FILES['image']['name'] . "'>";
    echo "<br>";
    echo "Myndir\\".$_FILES['image']['name'];
    // define the path to the upload folder
    $destination = $_SERVER['DOCUMENT_ROOT'] . "/Myndir/";  # Þú þarft að breyta slóð
    // svo við getum notað class með t.d. move() fallið og getMessage() ogsfrv...
    require_once 'File/upload.php';
    // Because the object might throw an exception
    try {
        // búum til upload object til notkunar.  Sendum argument eða slóðina að upload möppunni sem á að geyma skrá
        $loader = new Upload($destination);
        // köllum á og notum move() fallið sem færir skrá í upload möppu, þurfum að gera þetta strax.
        $loader->upload();
        // köllum á getMessage til að fá skilaboð (error or not).
        $result = $loader->getMessages();
    } catch (Exception $e) {
        echo $e->getMessage();  # ef við náum ekki að nota Upload class
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Vefsíðan mín</title>
</head>

<body>
    <?php
        // Keyrir bara ef það er búið að smella á submit
        if (isset($result)) {
            echo '<ul>';
            //  Birta skilboðin úr messages array (Upload class).
            foreach ($result as $message) {
                echo "<li>$message</li>";
            }
            echo '</ul>';
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data" id="uploadImage">
        <p>
            <label for="image">Upload image:</label>
            <input type="file" name="image" id="image">
        </p>
        <p>
            <input type="submit" name="upload" id="upload" value="Upload">
        </p>
    </form>

</body>
</html>
