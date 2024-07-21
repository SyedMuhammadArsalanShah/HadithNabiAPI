<?php
if (isset($_POST["bookSlug"])) {

    $bookslug = $_POST["bookSlug"];
    # code...

    $response = file_get_contents('https://hadithapi.com/api/' . $bookslug . '/chapters?apiKey=$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e');
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

        .english {
            color: navy;
            text-align: left;
            font-family: 'Times New Roman', Times, serif;
        }
        table {
            text-align: center;
            direction: rtl;
        }
    </style>

<body>

    <div class="container">




        <table class="table table-striped table-hover">
            <thead>
                <tr>

                    <th scope="col">Chapter Number</th>
                    <th scope="col">Chapter Arabic</th>
                    <th scope="col">Chapter Urdu</th>
                    <th scope="col">Chapter English</th>
                  
                    
                    <th scope="col">Handle</th>
                </tr>
            </thead>






            <tbody>
                <?php


                foreach ($response["chapters"] as $value) {



                    echo '
                    <tr>
                       
                           <th scope="row">' . $value["chapterNumber"] . '</th>
                           <td class="arabic" >' . $value["chapterArabic"] . '</td>
                           <td class="urdu" >' . $value["chapterUrdu"] . '</td>
                           <td class="english">' . $value["chapterEnglish"] . '</td>
                    
                            <td>
            <form action="hadith.php" method="post">
             
                <input type="hidden" name="bookSlug" value="' . $value["bookSlug"] . '">
                <input type="hidden" name="chapterNumber" value="' . $value["chapterNumber"] . '">
                <input type="hidden" name="chapterUrdu" value="' . $value["chapterArabic"] . '">
                <input type="hidden" name="chapterEnglish" value="' . $value["chapterEnglish"] . '">
                <input type="hidden" name="chapterArabic" value="' . $value["chapterUrdu"] . '">
                <button type="submit" class="btn btn-dark">ReadHadith</button>
            </form>
        </td>
                    </tr>';
                }




                ?>



            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>