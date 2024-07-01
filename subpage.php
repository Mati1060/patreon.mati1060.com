<?php
$dir = "files/";

if (isset($_GET["creator"]) && isset($_GET["year"]) && isset($_GET["month"]) && isset($_GET["dayFolder"])) {
    $creator = basename($_GET["creator"]);
    $year = basename($_GET["year"]);
    $month = basename($_GET["month"]);
    $dayFolder = basename($_GET["dayFolder"]);
    $dayFolderPath = $dir . $creator . "/" . $year . "/" . $month . "/" . $dayFolder . "/";

    if (is_dir($dayFolderPath)) {
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Contents of $creator/$year/$month/$dayFolder</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #000000;
                    color: #333;
                    margin: 0;
                    padding: 20px;
                }
                h1 {
                    background-color: #4CAF50;
                    color: white;
                    padding: 10px;
                    border-radius: 5px;
                }
                ul {
                    list-style-type: none;
                    padding: 0;
                }
                li {
                    background-color: #292929;
                    margin: 5px 0;
                    padding: 10px;
                    border-radius: 5px;
                    box-shadow: 0 0 5px rgba(0,0,0,0.1);
                    display: flex;
                    align-items: center;
                }
                li img {
                    max-width: 100%;
                    height: auto;
                    margin-right: 10px;
                    border-radius: 5px;
                }
                .file-content {
                    color: #4CAF50;
                }
                button {
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    padding: 10px 20px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 10px 2px;
                    cursor: pointer;
                    border-radius: 5px;
                a {
                    text-decoration: none;
                    color: #4CAF50;
                }
                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <h1>Contents of $creator/$year/$month/$dayFolder</h1>
            <ul>";

        $files = array_diff(scandir($dayFolderPath), array('.', '..'));
        foreach ($files as $file) {
            $filePath = $dayFolderPath . $file;
            $fileInfo = pathinfo($filePath);
            $extension = isset($fileInfo["extension"]) ? strtolower($fileInfo["extension"]) : '';

            if (preg_match('/^image\\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                continue;
            }

            if (preg_match('/^tags\\.(txt)$/i', $file)) {
                continue;
            }

            if (is_file($filePath)) {
                echo "<li>";
                if ($extension == "txt") {
                    $content = file_get_contents($filePath);
                    echo "<p class=\"file-content\">" . nl2br(htmlspecialchars($content)) . "</p>";
                }

                if (in_array($extension, ["jpg", "jpeg", "png", "gif", "webp"])) {
                    echo "<img src=\"$filePath\" alt=\"" . htmlspecialchars($file) . "\">";
                }

                if (in_array($extension, ["mp3", "wav", "ogg"])) {
                    echo "<audio controls>
                            <source src=\"$filePath\" type=\"audio/{$extension}\">
                            Your browser does not support the audio element.
                          </audio>";
                    echo "<p><a href=\"$filePath\" download>Download</a></p>";
                }
                echo "</li>";
            }
        }

        echo "</ul>";
        echo "<button onclick=\"window.location.href='month.php?creator=$creator&year=$year&month=$month'\">Back to $creator's $month Page</button>";
        echo "</body></html>";
    } else {
        echo "<p>Folder not found.</p>";
    }
} else {
    echo "<p>No folder specified.</p>";
}
?>
