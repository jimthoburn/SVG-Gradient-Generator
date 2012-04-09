<?php

  function encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
  }

  if (isset($_GET['top']) && !empty($_GET['top'])) {
    $top = $_GET['top'];
  }
  if (isset($_POST['top']) && !empty($_POST['top'])) {
    $top = $_POST['top'];
  }
  if (isset($_GET['bot']) && !empty($_GET['bot'])) {
    $bot = $_GET['bot'];
  }
  if (isset($_POST['bot']) && !empty($_POST['bot'])) {
    $bot = $_POST['bot'];
  }
  if (isset($_GET['name']) && !empty($_GET['name'])) {
    $name = $_GET['name'];
  }
  if (isset($_POST['name']) && !empty($_POST['name'])) {
    $name = $_POST['name'];
  }

  if (isset($top) && isset($bot)) {

    if (!isset($name)) {
      $name = 'gradient';
    }

    $name = strtolower($name);

    $svg = "
<svg width=\"500px\" height=\"500px\" xmlns=\"http://www.w3.org/2000/svg\">
 <defs>
  <linearGradient id=\"gradient\" x1=\"0.5\" y1=\"0\" x2=\"0.5\" y2=\"1\">
   <stop offset=\"0\" stop-color=\"$top\" />
   <stop offset=\"1\" stop-color=\"$bot\" />
  </linearGradient>
 </defs>
 <g>
  <rect fill=\"url(#gradient)\" stroke-width=\"0\" x=\"0\" y=\"0\" width=\"500\" height=\"500\" />
 </g>
</svg>
    ";
    $base64 = base64_encode($svg);
    $style = "
<style type=\"text/css\">
  #gradient {
    /* Data URI encoded from: $name.svg */
    background: $bot url(data:image/svg+xml;base64,$base64) top repeat-x;
    background-size: contain;
  }
</style>
    ";
  }

  if ($svg && $name) {

    $dirname = 'generated';
    if (!file_exists($dirname)) {
        mkdir($dirname, 0777);
    }

    // Write the contents to the file, within a unique folder
    // (so the user won’t have to deal with a weird filename).
    $now = getdate();
    $path = "$dirname/$now[0]";
    mkdir($path);
    $file = "$name.svg";

    file_put_contents("$path/$file", trim($svg), LOCK_EX);
  }

?><!doctype html>
<html dir="ltr" lang="en"<?php if (isset($svg)) { ?> class="active"<?php } ?>>
<head>
  <meta charset="utf-8" />
  <title>CSS/SVG Gradient Generator</title>
  <style>
    html, body {
      width: 100%;
      height: 100%;
    }
    html.active,
    html.active body {
      min-height: 100%;
    }
    body {
      font: 100%/1.5 "Helvetica Neue", Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      color: white;
      display: table;
      background: rgb(25, 25, 25);
      background: rgb(25, 25, 25) url(data:image/svg+xml;base64,Cjxzdmcgd2lkdGg9IjUwMHB4IiBoZWlnaHQ9IjUwMHB4IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgogPGRlZnM+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkaWVudCIgeDE9IjAuNSIgeTE9IjAiIHgyPSIwLjUiIHkyPSIxIj4KICAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSJyZ2IoMzUsIDM1LCAzNSkiIC8+CiAgIDxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0icmdiKDI1LCAyNSwgMjUpIiAvPgogIDwvbGluZWFyR3JhZGllbnQ+CiA8L2RlZnM+CiA8Zz4KICA8cmVjdCBmaWxsPSJ1cmwoI2dyYWRpZW50KSIgc3Ryb2tlLXdpZHRoPSIwIiB4PSIwIiB5PSIwIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgLz4KIDwvZz4KPC9zdmc+CiAgICA=) fixed top repeat-x;
      background-size: contain;
      background: transparent -moz-linear-gradient(top, rgb(35, 35, 35), rgb(25, 25, 25));
      background: transparent   -o-linear-gradient(top, rgb(35, 35, 35), rgb(25, 25, 25));
    }
    a {
      color: white;
    }
    .active h1 {
      margin-top: 3em;
    }
    h1 .css {
      color: rgba(255, 255, 255, 0.25);
    }
    h1 .svg {
      color: rgba(255, 255, 255, 0.5);
    }
    h1 a {
      text-decoration: none;
    }
    h1 a:hover,
    h1 a:active {
      text-decoration: underline;
    }
    div {
      display: table-cell;
      text-align: center;
      vertical-align: middle;
    }
    input {
      width: 80%;
      max-width: 13em;
    }
    input,
    button {
      background: rgba(255, 255, 255, 0.2);
      border-width: 0;
      border-radius: 0.25em;
      color: inherit;
      font-size: inherit;
      padding: 0.5em;
    }
    label span {
      color: rgba(255, 255, 255, 0.5);
    }
    form {
      margin-top: 5em;
      margin-bottom: 5em;
    }
    input:focus,
    button:focus {
      background: rgba(255, 255, 255, 0.9);
      color: rgba(0, 0, 0, 0.9);
    }
    pre {
      background: rgba(255, 255, 255, 0.85);
      color: rgba(0, 0, 0, 0.65);
      padding: 1em;
      border-radius: 0.25em;
      max-width: 70em;
      word-wrap: break-word; 
      overflow: auto;
      margin: 3em auto;
      text-align: left;
    }
    #gradient {
      margin: 1.5em auto;
      display: inline-block;
    }
    #gradient a {
      border-radius: 0.25em;
      width: 100px;
      height: 100px;
      display: block;
      text-indent: -9999px;
      overflow: hidden;
    }
    .note,
    .randomize a {
      margin-top: 5em;
      color: rgba(255, 255, 255, 0.35);
      font-size: 0.8em;
    }
    .note strong {
      color: rgba(255, 255, 255, 0.8);
      font-weight: normal;
    }
  </style>
<?php if (isset($style)) { echo (trim($style)); } ?>
</head>
<body>
  <div>
<?php if (isset($svg)) { ?>
  <h1><a href="<?php echo "$path/$file" ?>"><?php echo $name ?>.svg</a></h1>
  <div id="gradient"><a href="<?php echo "$path/$file" ?>" title="Download <?php echo $name ?>.svg"><?php echo $name ?>.svg</a></div>
  <pre><code><?php echo htmlentities(trim($svg)); ?></code></pre>
<?php } else { ?>
  <h1><span class="css">CSS</span>/<span class="svg">SVG</span> Gradient Generator</h1>
<?php } ?>
<?php if (isset($style)) { ?>
  <pre><code><?php echo htmlentities(trim($style)); ?></code></pre>
<?php } ?>
  <form action="./" method="get">
    <p>
      <label>
        <span>Top color</span><br />
        <input type="text" name="top" value="<?php if ($top) { echo $top; } ?>" placeholder="rgb(…) or #hex" />
      </label>
    </p>
    <p>
      <label>
        <span>Bottom color</span><br />
        <input type="text" name="bot" value="<?php if ($bot) { echo $bot; } ?>" placeholder="rgb(…) or #hex" />
      </label>
    </p>
    <p>
      <label>
        <span>Make up a name <em>(optional)</em></span><br />
        <input type="text" name="name" value="<?php if ($name) { echo $name; } ?>" />
      </label>
    </p>
    <p>
      <button type="submit">Submit</button>
    </p>
    <!-- Maybe later...
    <p class="randomize"><a href="?randomize=1">Random gradient</a></p>
    -->
    <p class="note">
      <strong>Tested in the latest versions of Safari, Chrome, Opera, Firefox,
      and Internet Explorer.</strong><br />That said, be sure to test it
      within your project.&nbsp; : )
    </p>
  </form>
  </div>

</body>
</html>
