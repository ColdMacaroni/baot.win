<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Baot's Site - Posts</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/css/styles.css" rel="stylesheet">
    </head>
    <body>
        <?php require "header.php"; ?>
        <main>
            <h2>My posts</h2>
            <p>These are all my epic posts!</p>
            <p>TODO! Sort by date. Also make this prettier...</p>
        <?php
        // Loop over files in posts/ and list them here. Sort by date?
        $folder = "posts/";

        // https://www.php.net/manual/en/class.directoryiterator.php
        // List files
        //
        echo "<ul>\n";
        foreach (new DirectoryIterator($folder) as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue; 
            }

            $fn = $fileInfo->getFilename();

            if (!preg_match("/.html$/", $fn)) {
                continue;
            }

            // No .html so it's fancy. Ideally we get it from the title or whatever
            $title = preg_replace("/.html$/", "", $fn);

            $contents = file_get_contents($folder . $fn);

            // Error reading file
            if ($contents === false) {
              continue;
            }

            $matches = array();
            // s flag matches across newlines.
            // From https://stackoverflow.com/a/159139.
            preg_match("/<h2.*?>(.*)<\\/h2>/s", $contents, $matches);

            $fancyTitle = $title;

            if (count($matches) > 0) {
              $fancyTitle = $matches[1];
            }

            echo "<li>";
            echo '<a href="viewpost.php?post=' . $title . '"> ' . $fancyTitle . '</a>';
            echo "</li>\n";

        }
        echo "</ul>\n";
        ?>
        </main>
        <?php require "footer.html"; ?>
    </body>
</html>
