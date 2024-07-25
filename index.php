<?php

$response = file_get_contents('https://hadithapi.com/api/books?apiKey=$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e');
$response = json_decode($response, true);
// print_r($response["books"]);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
</head>

<body>

    <div class="container">
        <div class="row">
            <?php
            foreach ($response["books"] as $key => $value) {
                echo '
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="box">
                        <img src="images/11.jpg">
                        <div class="box-content">
                            <div class="content">
                                <h3 class="title">' . ($key + 1) . '</h3>
                                <h4 class="title">' . $value["bookName"] . '</h4>
                                <p class="post">' . $value["writerName"] . ' | ' . $value["writerDeath"] . '</p>
                                <span class="post">Chapters: ' . $value["chapters_count"] . '  |  Hadiths: ' . $value["hadiths_count"] . '</span>
                                <ul class="icon">
                                    <li>
                                        <form action="chapters.php" method="post">
                                            <input type="hidden" name="bookSlug" value="' . $value["bookSlug"] . '">
                                            <button type="submit"><i class="bi bi-box-arrow-up-right"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
