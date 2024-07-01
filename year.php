<?php
$dir = "files/";

if (isset($_GET["creator"]) && isset($_GET["year"])) {
    $creator = basename($_GET["creator"]);
    $year = basename($_GET["year"]);
    $yearPath = $dir . $creator . "/" . $year . "/";

    if (is_dir($yearPath)) {
        echo "
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Months for $creator/$year</title>
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
            <h1>Content of $creator/$year</h1>
            <ul>";

        $months = scandir($yearPath);
        $months = array_diff($months, ['.', '..']); // Remove . and ..

        foreach ($months as $month) {
            if (is_dir($yearPath . $month)) {
                $date = DateTime::createFromFormat('m.Y', $month);
                if ($date) {
                    $formattedDate = $date->format('F Y');
                    echo "<li><a href=\"month.php?creator=$creator&month=$month&year=$year\">$formattedDate</a></li>";
                } else {
                    echo "<li>Invalid month format: $month</li>";
                }
            }
        }

        echo "</ul>";
        echo "<button onclick=\"window.location.href='creator.php?creator=$creator'\">Back to $creator Page</button>";
        echo "
        </body>
        </html>";
    } else {
        echo "
        <html lang=\"en\">
        <head>
            <meta charset=\"UTF-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
            <title>Error</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #000000;
                    color: #333;
                    margin: 0;
                    padding: 20px;
                }
                p {
                    color: #FF0000;
                }
            </style>
        </head>
        <body>
            <p>Year folder not found: $yearPath</p>
        </body>
        </html>";
    }
} else {
    echo "
    <html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
        <title>Error</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #000000;
                color: #333;
                margin: 0;
                padding: 20px;
            }
            p {
                color: #FF0000;
            }
        </style>
    </head>
    <body>
        <p>Invalid request. Please specify creator and year.</p>
    </body>
    </html>";
}
?>
