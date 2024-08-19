<?php

$response = file_get_contents('https://hadithapi.com/api/books?apiKey=$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e');
$response = json_decode($response, true);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadith Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
   <style>
        body {
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
            background-color: #d4d4bc;
            border-radius: 10px;
            padding: 10px;
            color: teal;
        }
        .card {
            background-color: #389bde;
            border: 1px solid #d4d4bc;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            color: #ffffff;
        }
        .card h3 {
            margin-bottom: 10px;
            color: #ffffff;
        }
        .card p {
            color: #e0f3ff;
        }
        .btn-custom {
            background-color: #ffffff;
            border: none;
            color: #389bde;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #e0f3ff;
            color: #005f99;
        }
   </style>
</head>

<body>

<?php include 'navbar.php'; ?>

    <div class="container">
        <h1 class="arabic1">کتب الاحادیث</h1>
        <div class="row">
            <?php

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

            foreach ($response["books"] as $key => $value) {
                echo '
                <div class="col-md-4 col-sm-6 mb-3">
                    <div class="card">
                        <h3 class="arabic">' . ($key + 1) . ' - ' . $hadithBooks[$key]  . '</h3>
                        <p>' . $value["writerName"] . ' | ' . $value["writerDeath"] . '</p>
                        <p>Chapters: ' . $value["chapters_count"] . '  |  Hadiths: ' . $value["hadiths_count"] . '</p>
                        <form action="chapters.php" method="post">
                            <input type="hidden" name="bookSlug" value="' . $value["bookSlug"] . '">
                            <button type="submit" class="btn btn-custom">View Chapters</button>
                        </form>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
