<?php
$dir = "files/";

function getDayName($dayFolder) {
    return DateTime::createFromFormat('d.m', substr($dayFolder, 0, 5))->format('jS F');
}

function findImage($dayPath) {
    $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    foreach ($imageTypes as $type) {
        $imagePath = $dayPath . "/image.$type";
        if (file_exists($imagePath)) {
            return $imagePath;
        }
    }
    return null;
}

function getTags($dayPath) {
    $tagsFilePath = $dayPath . "/tags.txt";
    if (file_exists($tagsFilePath)) {
        $tags = file_get_contents($tagsFilePath);
        return array_map('trim', explode(',', $tags));
    }
    return [];
}

if (isset($_GET["creator"]) && isset($_GET["year"]) && isset($_GET["month"])) {
    $creator = basename($_GET["creator"]);
    $year = basename($_GET["year"]);
    $month = str_pad(basename($_GET["month"]), 2, '0', STR_PAD_LEFT);
    $monthPath = $dir . $creator . "/" . $year . "/" . $month . "/";

    if (is_dir($monthPath)) {
        echo "<!DOCTYPE html>
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Days for $creator/$year/$month</title>
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
                    max-width: 100px;
                    margin-right: 10px;
                    border-radius: 5px;
                }
                a {
                    text-decoration: none;
                    color: #4CAF50;
                }
                a:hover {
                    text-decoration: underline;
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
                }
                button:hover {
                    background-color: #45a049;
                }
                .tags {
                    margin-left: auto;
                    color: #4CAF50;
                    font-size: 0.9em;
                }
            </style>
        </head>
        <body>
            <h1>Content of $creator/$year/$month</h1>
            <ul>";
        
        $days = scandir($monthPath);
        $days = array_diff($days, ['.', '..']); // Remove . and ..

        if (empty($days)) {
            echo "<p>No day folders found in: $monthPath</p>";
        } else {
            foreach ($days as $day) {
                $dayPath = $monthPath . $day;
                if (is_dir($dayPath)) {
                    $dayName = getDayName($day);
                    $folderName = substr($day, 6); // Extract the folder name part
                    $imagePath = findImage($dayPath);
                    $tags = getTags($dayPath);
                    
                    echo "<li>";
                    if ($imagePath) {
                        echo "<img src=\"$imagePath\" alt=\"$folderName\">";
                    }
                    echo "<a href=\"subpage.php?creator=$creator&year=$year&month=$month&dayFolder=$day\">$dayName - $folderName</a>";
                    if (!empty($tags)) {
                        echo "<span class=\"tags\">" . implode(', ', $tags) . "</span>";
                    }
                    echo "</li>";
                }
            }
        }

        echo "</ul>";
        echo "<button onclick=\"window.location.href='year.php?creator=$creator&year=$year'\">Back to $creator's $year Page</button>";
        echo "</body></html>";
    } else {
        echo "<p>Month folder not found: $monthPath</p>";
    }
} else {
    echo "<p>Invalid request. Please specify creator, year, and month.</p>";
}
?>
