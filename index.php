<?php
$dir = "files/";

function findImage($dir, $creator) {
    $extensions = ["jpg", "jpeg", "png", "gif", "webp"];
    foreach ($extensions as $ext) {
        $imagePath = "$dir$creator/image.$ext";
        if (file_exists($imagePath)) {
            return $imagePath;
        }
    }
    return "";
}

echo "<!DOCTYPE html>";
echo "<html lang=\"en\">";
echo "<head>";
echo "<meta charset=\"UTF-8\">";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
echo "<title>Main Page</title>";
echo "<style>";
echo "body {";
echo "    font-family: Arial, sans-serif;";
echo "    background-color: #000000;";
echo "    color: #333;";
echo "    margin: 0;";
echo "    padding: 20px;";
echo "}";
echo "h1 {";
echo "    background-color: #4CAF50;";
echo "    color: white;";
echo "    padding: 10px;";
echo "    border-radius: 5px;";
echo "}";
echo "ul {";
echo "    list-style-type: none;";
echo "    padding: 0;";
echo "}";
echo "li {";
echo "    background-color: #292929;";
echo "    margin: 5px 0;";
echo "    padding: 10px;";
echo "    border-radius: 5px;";
echo "    box-shadow: 0 0 5px rgba(0,0,0,0.1);";
echo "    display: flex;";
echo "    align-items: center;";
echo "}";
echo "li img {";
echo "    max-width: 100px;";
echo "    margin-right: 10px;";
echo "    border-radius: 5px;";
echo "}";
echo "a {";
echo "    text-decoration: none;";
echo "    color: #4CAF50;";
echo "}";
echo "a:hover {";
echo "    text-decoration: underline;";
echo "}";
echo "button {";
echo "    background-color: #4CAF50;";
echo "    color: white;";
echo "    border: none;";
echo "    padding: 10px 20px;";
echo "    text-align: center;";
echo "    text-decoration: none;";
echo "    display: inline-block;";
echo "    font-size: 16px;";
echo "    margin: 10px 2px;";
echo "    cursor: pointer;";
echo "    border-radius: 5px;";
echo "}";
echo "button:hover {";
echo "    background-color: #45a049;";
echo "}";
echo "</style>";
echo "</head>";
echo "<body>";
echo "<h1>Main Page</h1>";
echo "<ul>";

if (is_dir($dir)) {
    $creators = scandir($dir);
    sort($creators); // Sort alphabetically

    foreach ($creators as $creator) {
        if ($creator != "." && $creator != ".." && is_dir($dir . $creator)) {
            $imagePath = findImage($dir, $creator);
            $safeCreator = htmlspecialchars($creator, ENT_QUOTES, 'UTF-8');

            echo "<li>";
            if ($imagePath) {
                echo "<img src=\"$imagePath\" alt=\"$safeCreator\" style=\"max-width:100px;max-height:100px;\">";
            }
            echo "<a href=\"creator.php?creator=$safeCreator\">$safeCreator</a>";
            echo "</li>";
        }
    }
} else {
    echo "<p>Directory not found.</p>";
}

echo "</ul>";
echo "</body>";
echo "</html>";
?>
