<?php
if (isset($_POST["bookSlug"])) {

    $bookslug = $_POST["bookSlug"];
    $chapterNumber = $_POST["chapterNumber"];
    $chapterArabic = $_POST["chapterArabic"];
    $chapterEnglish = $_POST["chapterEnglish"];
    $chapterUrdu = $_POST["chapterUrdu"];
    $apiKey = '$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e';

    $response = file_get_contents(
        'https://hadithapi.com/api/hadiths/?apiKey=' . $apiKey . '&book=' . $bookslug . '&chapter=' . $chapterNumber . '&paginate=100000'
    );
    $response = json_decode($response, true);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadith Chapter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri+Quran&family=Aref+Ruqaa&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400..700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #fbfbf8;
        }

        .arabic {
            font-family: 'Amiri Quran', serif;
            text-align: center;
        }

        @font-face {
            font-family: "jameel";
            src: url(fonts/jameel.ttf);
        }

        .urdu {
            text-align: right;
            font-family: "jameel", serif;
            color: teal;
        }

        .chapter {
            text-align: center;
            font-family: "jameel", serif;
            color: cadetblue;
            background-color: #d4d4bc;
            border-radius: 10px;
            padding: 10px;
        }

        .english {
            color: navy;
            text-align: justify;
            font-family: 'Times New Roman', Times, serif;
        }

        .btn-primary {
            background-color: #005f99;
            border-color: #005f99;
        }

        .btn-primary:hover {
            background-color: #004c7a;
            border-color: #004c7a;
        }

        .badge-success {
            background-color: #28a745;
            color: #fff;
        }

        .badge-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container">
        <h1 class="chapter"><?php echo "$chapterUrdu &nbsp;&nbsp; | &nbsp;&nbsp; $chapterArabic &nbsp;&nbsp;"; ?></h1>

        <?php if (isset($response["hadiths"]["data"])): ?>
            <?php foreach ($response["hadiths"]["data"] as $value): ?>
                <div class="container mb-4 arabic">
                    <h1> حديث نمبر <?php echo $value["hadithNumber"]; ?></h1>
                    <h3><?php echo $value["headingArabic"]; ?></h3><br>
                    <p><?php echo $value["hadithArabic"]; ?></p>
                </div>

                <div class="row">
                    <div class="col-md-6 english">
                        <div class="container mb-4">
                            <h6><?php echo $value["headingEnglish"]; ?></h6>
                            <p><strong>English Narrator: <?php echo $value["englishNarrator"]; ?></strong></p>
                            <blockquote><?php echo $value["hadithEnglish"]; ?></blockquote>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="container mb-4">
                            <p class="urdu"><strong class="urdu"> <?php echo $value["urduNarrator"]; ?></strong></p>
                            <h6 class="urdu"><?php echo $value["headingUrdu"]; ?></h6>
                            <blockquote class="urdu"><?php echo $value["hadithUrdu"]; ?></blockquote>
                        </div>
                    </div>
                </div>

                <?php
                    if ($value['status'] == 'Sahih') {
                        echo '<span class="badge badge-success"> Hadith Status : ' . $value["status"] . '</span>';
                    } elseif ($value['status'] == 'Da`eef') {
                        echo '<span class="badge badge-danger"> Hadith Status : ' . $value["status"] . '</span>';
                    } elseif ($value['status'] == 'Hasan') {
                        echo '<span class="badge badge-warning"> Hadith Status : ' . $value["status"] . '</span>';
                    }
                ?>

                <hr>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
