<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

include_once 'Csv.php';
$csv = new Csv();
$csv->download();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CSV Processor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Remove the navbar's default margin-bottom and rounded borders */
        .navbar {
            margin-bottom: 0;
            border-radius: 0;
        }

        /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
        .row.content {
            height: 450px
        }

        /* Set gray background color and 100% height */
        .sidenav {
            padding-top: 20px;
            background-color: #f1f1f1;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }

            .row.content {
                height: auto;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CSV Processor</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-2 sidenav">
            <p>


            </p>
        </div>
        <div class="col-sm-8 text-left">
            <h1>Welcome - Copy Column (H3 tag covered text)</h1>
            <p> Please upload your CSV file </p>
            <hr>
            <strong>
                <?php
                    $uploadMsg = $csv->fileUpload();
                    if ($uploadMsg !== '') {
                        echo $uploadMsg;
                    }
                ?>
            </strong>

            <form action="index.php" method="post" enctype="multipart/form-data">
                <input type="file" name="csv" id="csv" accept=".csv">
                <br/>
                <input type="submit" value="Upload CSV" name="submit">
            </form>
            <form  action="index.php" method="post">
                <br />
                <?php
                $headers = $csv->getHeaders();
                    if (count($headers) > 0) {
                        ?>
                        <select name="header">
                            <?php
                            $columnNumber = 0;
                                foreach ($headers as $header) {
                                    ?>
                                    <option value="<?php echo $header;?>" <?php echo $header === 'description_long' ? 'selected' : '';?>><?php echo $header; ?></option>
                                    <?php
                                    ++$columnNumber;
                                }
                            ?>
                        </select> Copy within &lt;h3&gt; tag to <label>
                            <input name="newColumn" value="description_taglines" />
                        </label>
                        <input type="submit" value="Download" name="submit">
                <?php
                    }
                ?>

            </form>

        </div>
        <div class="col-sm-2 sidenav">

        </div>
    </div>
</div>

<footer class="container-fluid text-center">
    <p>&copysr; All Rights Reserved by Gusti Leder</p>
</footer>

</body>
</html>

