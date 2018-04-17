<?php
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['dates'])) {
    file_put_contents('./dates.json', $_POST['dates']);
}

$dates = file_get_contents('./dates.json');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="generator" content="Polymer Starter Kit">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=yes">

    <title>Paris grève info 🚅</title>
    <meta name="description" content="L'information sur les grèves en temps réel.">

    <!-- Add any global styles for body, document, etc. -->
    <style>
      body {
        margin: 0;
        font-family: 'Roboto', 'Noto', sans-serif;
        line-height: 1.5;
        min-height: 100%;
        background-color: #eeeeee;
      }

      textarea {
        width: 100%;
        height: auto;
      }

      section {
        margin: 24px;
        padding: 16px;
        color: #757575;
        border-radius: 1px;
        background-color: #fff;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
      }
    </style>
  </head>
  <body>
    <section>
        <h1>Greve editor</h1>
        <form action="" method="post">
            <textarea name="dates"><?php echo $dates; ?></textarea>
            <button type="submit">SUBMIT</button>
        </form>
    </section>
    <script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
    <script>
        (() => {
            autosize(document.querySelector('textarea'));
        })();
    </script>
  </body>
</html>
