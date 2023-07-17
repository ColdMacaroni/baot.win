<header>
  <div id="branding-container">
    <img src="/imgs/logo.svg" class="main-logo" alt="My Logo" />
    <h1>My Webbed Site</h1>
  </div>
  <nav>
    <ul>
      <a href="index.php"><li>Home</li></a>
      <a href="posts.php"><li>Posts</li></a>
      <a href="guides.php"><li>Guides</li></a>
    </ul>
  </nav>

  <hr id="header-end" <?php
    // Pick a random image to set --img to
    $folder = "imgs/ruler/";
    
    $files = array();

    // https://www.php.net/manual/en/class.directoryiterator.php
    // Grab all the pngs
    // Need to use server root do that they're found from different folders. https://stackoverflow.com/a/15211243
  foreach (new DirectoryIterator($_SERVER["DOCUMENT_ROOT"] . "/" . $folder) as $fileInfo) {
      if ($fileInfo->isDot()) {
          continue; 
      }

          $fn = $fileInfo->getFilename();

      if (!preg_match("/.png$/", $fn)) {
          continue;
      }

      array_push($files, $fn);
  }

    $idx = array_rand($files, 1);

    echo 'style="--img: url(\'';  
    // Make it absolute because the images are outside the css folder
    echo "/" . $folder . $files[$idx];
    echo '\')"';
    ?> />
</header>
