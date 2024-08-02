<?php
if (isset($_POST["bookSlug"])) {

    $bookslug = urlencode($_POST["bookSlug"]);
    $selectedLanguage = $_POST["language"];
    $searchQuery = urlencode($_POST["searchQuery"]);
    $apiKey = '$2y$10$BylaBcXs5Lw7ZOtYmQ3PXO1x15zpp26oc1FeGktdmF6YeYoRd88e';

    $url = 'https://hadithapi.com/api/hadiths/?apiKey=' . $apiKey . '&book=' . $bookslug . '&paginate=100000';

    if (!empty($searchQuery)) {
        if ($selectedLanguage == 'arabic') {
            $url .= '&hadithArabic=' . $searchQuery;
        } elseif ($selectedLanguage == 'english') {
            $url .= '&hadithEnglish=' . $searchQuery;
        } elseif ($selectedLanguage == 'urdu') {
            $url .= '&hadithUrdu=' . $searchQuery;
        }
        elseif ($selectedLanguage == 'h-num') {
            $url .= '&hadithNumber=' . $searchQuery;
        }
    }

    $response = file_get_contents($url);
    $response = json_decode($response, true);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hadith Search</title>
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
            text-align: justify;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>

<body>

    <div class="container">

        <form method="POST" action="">
        <div class="mb-3">
    <label for="bookSlug" class="form-label">Book Slug</label>
    <select class="form-select" id="bookSlug" name="bookSlug" required>
        <option value="sahih-bukhari">Sahih Bukhari</option>
        <option value="sahih-muslim">Sahih Muslim</option>
        <option value="al-tirmidhi">Jami' at-Tirmidhi</option>
        <option value="abu-dawood">Sunan Abu Dawood</option>
        <option value="ibn-e-majah">Sunan Ibn-e-Majah</option>
        <option value="sunan-nasai">Sunan An-Nasa`i</option>
        <option value="mishkat">Mishkat Al-Masabih</option>
        <option value="musnad-ahmad">Musnad Ahmad</option>
        <option value="al-silsila-sahiha">Al-Silsila Sahiha</option>
    </select>
</div>

            <div class="mb-3">
                <label for="language" class="form-label">Search Language</label>
                <select class="form-select" id="language" name="language" required>
                    <option value="arabic">Arabic</option>
                    <option value="english">English</option>
                    <option value="urdu">Urdu</option>
                    <option value="h-num">Hadith Number</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="searchQuery" class="form-label">Search Query</label>
                <input type="text" class="form-control" id="searchQuery" name="searchQuery" placeholder="Enter search query">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if (isset($response["hadiths"]["data"])): ?>
            <?php foreach ($response["hadiths"]["data"] as $value): ?>
                <div class="conatiner mb-4 arabic">
                    <h1> حديث نمبر <?php echo $value["hadithNumber"]; ?></h1>
                    <h3><?php echo $value["headingArabic"]; ?></h3><br>
                    <p><?php echo $value["hadithArabic"]; ?></p>
                </div>

                <div class="row">
                    <div class="col-md-6 english">
                        <div class="conatiner mb-4">
                            <h6><?php echo $value["headingEnglish"]; ?></h6>
                            <p><strong>English Narrator: <?php echo $value["englishNarrator"]; ?></strong></p>
                            <blockquote><?php echo $value["hadithEnglish"]; ?></blockquote>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="conatiner mb-4">
                            <p class="urdu"><strong class="urdu"> <?php echo $value["urduNarrator"]; ?></strong></p>
                            <h6 class="urdu"><?php echo $value["headingUrdu"]; ?></h6>
                            <blockquote class="urdu"><?php echo $value["hadithUrdu"]; ?></blockquote>
                        </div>
                    </div>
                </div>
                <?php
                          if( $value['status'] == 'Sahih') {
                            echo '<span class="badge text-bg-success"> Hadith Status : ' . $value["status"] . '</span>';}
                            elseif( $value['status'] == 'Da`eef') {
                                echo '<span class="badge text-bg-danger"> Hadith Status : ' . $value["status"] . '</span>';}
                              elseif( $value['status'] == 'Hasan') {
                                    echo '<span class="badge text-bg-warning"> Hadith Status : ' . $value["status"] . '</span>';}
            
                ?>

                <hr>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
