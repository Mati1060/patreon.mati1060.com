<?php
$dir = "files/";

function getYear($yearFolder)
{
    $date = DateTime::createFromFormat('Y', $yearFolder);
    return $date ? $date->format('Y') : 'Invalid Year';
}

function sortByYearDesc($a, $b)
{
    return $b <=> $a; // Compare years in descending order
}

function outputYearsList($creator, $creatorPath)
{
    $years = scandir($creatorPath);
    if ($years === false) {
        echo "<p>Error scanning directory: $creatorPath</p>";
        return;
    }
    
    $years = array_diff($years, ['.', '..']); // Remove . and ..
    if (empty($years)) {
        echo "<p>No years found for $creator.</p>";
        return;
    }

    usort($years, 'sortByYearDesc'); // Sort years in descending order

    echo "<ul>";
    foreach ($years as $year) {
        if (is_dir($creatorPath . $year)) {
            echo "<li><a href=\"year.php?creator=$creator&year=$year\">" . getYear($year) . "</a></li>";
        }
    }
    echo "</ul>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Years for <?php echo htmlspecialchars($creator); ?></title>
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
    </style>
</head>
<body>
    <?php
    if (isset($_GET["creator"])) {
        $creator = basename($_GET["creator"]);
        $creatorPath = $dir . $creator . "/";

        if (is_dir($creatorPath)) {
            echo "<h1>Content of " . htmlspecialchars($creator) . "</h1>";
            outputYearsList($creator, $creatorPath);
            echo "<button onclick=\"window.location.href='index.php'\">Back to Main Page</button>";
        } else {
            echo "<p>Creator not found: " . htmlspecialchars($creatorPath) . "</p>";
        }
    } else {
        echo "<p>No creator specified.</p>";
    }
    ?>
</body>
</html>
