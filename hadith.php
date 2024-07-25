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

    // print_r($response["books"]);
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
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
  
    </style>
</head>

<body>

    <div class="container">

        <h1 class="chapter"><?php echo " $chapterUrdu &nbsp;&nbsp; | &nbsp;&nbsp; $chapterArabic &nbsp;&nbsp;"; ?></h1>

        <?php


        foreach ($response["hadiths"]["data"] as $value) {




            echo '<div class="conatiner mb-4 arabic">';
            echo '<h1> حدیث نمبر ' . $value["hadithNumber"] . '</h1>';
            echo '<h3>' . $value["headingArabic"] . '</h3><br>';

            echo '<p>' . $value["hadithArabic"] . '</p>';
            echo '</div>';


            echo '<div class="row"> <div class="col-md-6 english" >';
            echo '<div class="conatiner mb-4 ">';
            echo '<h6>' . $value["headingEnglish"] . '</h6>';
            echo '<p><strong>English Narrator: ' . $value["englishNarrator"] . '</strong></p>';
            echo '<blockquote>' . $value["hadithEnglish"] . '</blockquote>';
            echo '</div>';
            echo '</div>';


            echo '  <div class="col-md-6">';
            echo '<div class="conatiner mb-4">';
            echo '<p class="urdu" ><strong class="urdu" > ' . $value["urduNarrator"] . '</strong></p>';
            echo '<h6 class="urdu">' . $value["headingUrdu"] . '</h6>';
            echo '<blockquote class="urdu">' . $value["hadithUrdu"] . '</blockquote>';
            echo '</div>';
            echo '</div>';


            echo '</div>';

            echo "<hr>";
        }




        ?>


    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>