<?php

namespace views\modules;
echo '<script>alert("hello header")</script>';

class header
{
    public function get()
    {   
        return <<<HTML
            <!DOCTYPE html>
            <html lang="en" dir="ltr">

            <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1,
                shrink-to-fit=no">
                <title>Hero</title>

                <link type="text/css" href="assets/css/vendor-morris.css" rel="stylesheet">
                <link type="text/css" href="assets/css/vendor-bootstrap-datepicker.css" rel="stylesheet">

                <!-- Prevent the demo from appearing in search engines -->
                <meta name="robots" content="noindex">

                <!-- App CSS -->
                <link type="text/css" href="assets/css/app.css" rel="stylesheet">
                <link type="text/css" href="assets/css/app.rtl.css" rel="stylesheet">
                <!-- Simplebar -->
                <link type="text/css" href="assets/vendor/simplebar.css" rel="stylesheet">

                <link type="text/css" rel="stylesheet" href="assets/css/mycss.css">
            </head>
HTML;
    }
}

?>