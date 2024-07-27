<?php
if (isset($_POST["bookSlug"])) {
    $bookslug = $_POST["bookSlug"];
    $response = file_get_contents('https://hadithapi.com/api/' . $bookslug . '/chapters?apiKey=$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e');
    $response = json_decode($response, true);
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
            background-color: #525252;
            text-align: center;
        }
        .arabic {
            font-family: 'Amiri Quran', serif;
           
        }
        .arabic1 {
            font-family: 'jameel', serif;
            /* margin-bottom: 10px; */
            background-color: #d4d4bc;
            border-radius: 10px;
            padding: 10px;
            color: teal;



        }
        @font-face {
            font-family: "jameel";
            src: url(fonts/jameel.ttf);
        }
        .urdu {
       
            font-family: "jameel", serif;
            color: teal;
        }
        .english {
            color: navy;
            font-family: 'Times New Roman', Times, serif;
        }
        .card{
            background-image: url("images/i4.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        
        
        
        
        }

     
    </style>
</head>

<body>
    <div class="container mb-4">
        <h1 class="arabic1">ابواب الاحادیث</h1>
        <div class="row">
            <?php
            if (isset($response["chapters"])) {
                foreach ($response["chapters"] as $value) {
                    echo '
                    <div class="col-md-6 col-sm-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">' . $value["chapterNumber"] . '</h5>
                                <p class="arabic card-text">' . $value["chapterArabic"] . '</p>
                                <p class="urdu card-text">' . $value["chapterUrdu"] . '</p>
                                <p class="english card-text">' . $value["chapterEnglish"] . '</p>
                                <form action="hadith.php" method="post">
                                    <input type="hidden" name="bookSlug" value="' . $value["bookSlug"] . '">
                                    <input type="hidden" name="chapterNumber" value="' . $value["chapterNumber"] . '">
                                    <input type="hidden" name="chapterUrdu" value="' . $value["chapterArabic"] . '">
                                    <input type="hidden" name="chapterEnglish" value="' . $value["chapterEnglish"] . '">
                                    <input type="hidden" name="chapterArabic" value="' . $value["chapterUrdu"] . '">
                                    <button type="submit" class="btn btn-dark">Read Hadith</button>
                                </form>
                            </div>
                        </div>
                    </div>';
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
