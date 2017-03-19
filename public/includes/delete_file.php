<?php

if (isset($_GET['func']) && $_GET['func'] = "delete_file") {
    $file_name = $_POST['my_file'];
    delete_profile_pic($file_name);
}

function delete_profile_pic($file_name) {
    if (is_file($file_name)) {
        if (unlink($file_name)) {
            echo 'Deleted!';
        } else {
            echo 'Deletion failed! Try again.';
        }
    } else {
        echo 'File not found';
    }
}
