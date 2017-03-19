<?php

class Validate {

    static function sanitizeText($contents) {
        $contents = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $contents);
        $contents = strip_tags($contents);
        $contents = htmlspecialchars($contents);
        // $contents= mysqli_real_escape_string($contents);
        $contents = filter_var($contents, FILTER_SANITIZE_STRING);
        return $contents;
    }

    static function sanitizeScriptText($contents) {
        $contents = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $contents);
        return $contents;
    }

    static function sanitizeNumber($contents) {
        $contents = filter_var($contents, FILTER_SANITIZE_NUMBER_INT);
        return $contents;
    }

    static function sanitizeEmail($contents) {

        $contents = filter_var($contents, FILTER_SANITIZE_EMAIL);
        if (strlen($contents) > 5) {
            if (filter_var($contents, FILTER_VALIDATE_EMAIL)) {
                return $contents;
            } else {
                return false;
            }
        } else {
            return $contents;
        }
    }

}
