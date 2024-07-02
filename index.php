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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
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
    <h1>Main Page</h1>
    <ul>
    <?php if (is_dir($dir)): ?>
        <?php
        $creators = scandir($dir);
        sort($creators); // Sort alphabetically
        foreach ($creators as $creator):
            if ($creator != "." && $creator != ".." && is_dir($dir . $creator)):
                $imagePath = findImage($dir, $creator);
                $safeCreator = htmlspecialchars($creator, ENT_QUOTES, 'UTF-8');
        ?>
            <li>
                <?php if ($imagePath): ?>
                    <img src="<?= $imagePath ?>" alt="<?= $safeCreator ?>" style="max-width:100px;max-height:100px;">
                <?php endif; ?>
                <a href="creator.php?creator=<?= $safeCreator ?>"><?= $safeCreator ?></a>
            </li>
        <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Directory not found.</p>
    <?php endif; ?>
    </ul>
</body>
</html>
