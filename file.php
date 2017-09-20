
<?php

$uploadfile = $_FILES['filename']['name'];
$dest = './uploads/qwe.pdf';

if (!move_uploaded_file($_FILES['filename']['tmp_name'], $dest)) {

    echo "err!\n";
}

?>
