<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Baot's Site</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/styles.css" rel="stylesheet">

        <!-- Highlight code -->
        <link rel="stylesheet" href="/highlightjs/styles/base16/gruvbox-dark-hard.min.css" />
        <script src="/highlightjs/highlight.min.js"></script>
        <script>hljs.highlightAll();</script>
    </head>
    <body>
        <?php require "header.php"; ?>
        <main>
            <?php
            $folder = "posts";
            $fn = $_GET["post"];

            include "$folder/$fn.html";
        ?>
        </main>
        <?php require "footer.html"; ?>
    </body>
</html>
