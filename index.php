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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
   <style>
body{
    background-color: #fbfbf8;
}
        .arabic {
            font-family: 'Amiri Quran', serif;
                }
                @font-face {
                    font-family: "jameel";
                    src: url(fonts/jameel.ttf);
                }
                .arabic1 {
                    text-align: center;
            font-family: 'jameel', serif;
            /* margin-bottom: 10px; */
            background-color: #d4d4bc;
            border-radius: 10px;
            padding: 10px;
            color: teal;



        }

   </style>
</head>

<body>

    <div class="container">
    <h1 class="arabic1">کتب الاحادیث</h1>
        <div class="row">
            <?php

            $images=["images/b1.png","images/b2.jpg","images/b3.jpg","images/b4.jpg","images/b5.jpg","images/b11.jpg","images/b7.jpg","images/b8.jpg","images/b9.jpg"];
            $hadithBooks = [
                "📖 صحيح البخاري",
                "📖 صحيح مسلم",
                "📖 جامع الترمذي",
                "📖 سنن أبي داود",
                "📖 سنن ابن ماجه",
                "📖 سنن النسائي",
                "📖 مشكاة المصابيح",
                "📖 مسند أحمد",
                "📖 السلسلة الصحيحة"
            ];
            // <h4 class="title">' . $value["bookName"] . '</h4>
            foreach ($response["books"] as $key => $value) {
                echo '
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="box">
                        <img src="'.$images[$key].'">
                        <div class="box-content">
                            <div class="content">

                                <h3 class="title">' . ($key + 1) . '</h3>
                                <h2 class="arabic mb-4">' . $hadithBooks[$key]  . '</h2>
                              
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
