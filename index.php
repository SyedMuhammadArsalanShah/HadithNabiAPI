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

<style>
    table{
        text-align: left;
    }
    th{text-align: center;}
</style>
</head>

<body>

    <div class="container">




        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Writer Name</th>
                    <th scope="col">Writer Death</th>
                    <th scope="col">Hadiths count</th>
                    <th scope="col">Chapters count</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>






            <tbody>
                <?php


                foreach ($response["books"] as $value) {



                    echo '
                    <tr>
                            <th scope="row">' . $value["id"] . '</th>
                            <td>' . $value["bookName"] . '</td>
                            <td>' . $value["writerName"] . '</td>
                            <td>' . $value["writerDeath"] . '</td>
                            <td>' . $value["hadiths_count"] . '</td>
                            <td>' . $value["chapters_count"] . '</td>
                            <td>
            <form action="chapters.php" method="post">
             
                <input type="hidden" name="bookSlug" value="' . $value["bookSlug"] . '">
                <button type="submit" class="btn btn-primary">Read  Chapters</button>
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