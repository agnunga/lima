<?php

//
//if (isset($_POST['upload_doc'])) {
//    $doc_name = $_POST['doc_name'];
//    $doc_file = $_FILES['doc_file']['tmp_name'];
//
//    upload_pdf($doc_name, $doc_file);
//} else {
//    echo '<form enctype="multipart/form-data" action="" method="post">'
//    . '<input type="text" name="doc_name">'
//    . '<input type="file" name="doc_file">'
//    . '<input type="submit" name="upload_doc" value="Upload">'
//    . '</form>';
//}

function upload_pdf($doc_name, $doc_file, $doc_size, $doc_type) {
    $bo_size = FALSE;
    $bo_name = FALSE;
    $bo_ext = FALSE;

    if (strlen($doc_name) > 0) {
        $bo_name = TRUE;
    } else
        echo 'File name cannot be empty.';

    if ($doc_size <= 2048000) {
        $bo_size = TRUE;
    } else
        echo 'Document must be less than 2MBs.';
    if ($doc_type == "application/pdf") {
        $bo_ext = TRUE;
        $extension = ".pdf";
    } else
        echo 'Document must be a .pdf file.';

    $path_n_name = "../documents/cv" . $doc_name . ".pdf";
    if (is_uploaded_file($doc_file) && $bo_ext && $bo_name && $bo_size) {
        move_uploaded_file($doc_file, $path_n_name);
        echo 'Document uploaded to' . $path_n_name;
        return $path_n_name;
    } else {
        echo 'Upload failed!';
    }
}
