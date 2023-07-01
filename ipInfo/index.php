<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel  = "stylesheet" href = "main.css">
    <title>IP Info Page</title>
</head>
<body>
    <div class = "container">

        <form class = "form_input_ip" method="POST">
            <h1>Input IP and check it</h1>

            <div class = "form_control">
                <input type = "text" name = "inputTextIP" autocomplete = "off" required>
                <label>Input IP</label>
            </div>

            <button class = "button">Click</button>

            <h2>IP Info</h2>

            <?php
            if(isset($_POST["inputTextIP"])){
                $arrayStr = str_split($_POST["inputTextIP"], 3);
                if((int)$arrayStr[0] < 256){
                    $url = "http://free.ipwhois.io/json/".$_POST["inputTextIP"];
                    $json = file_get_contents($url);
                    $obj = json_decode($json, true);
                    ?>
                    <div class = "IP_info"><?php
                    echo $obj['continent']."<br>";
                    echo $obj['country']."<br>";
                    echo $obj['city']."<br>";
                    echo $obj['timezone_gmt']." GMT<br>";
                    ?>
                    </div><?php
                }
                else{
                    ?><div class = "IP_info"><?php
                    echo "IP > 256 - exception";?>
                    </div><?php
                }
            }
            ?>
        </form>
    </div>
    <script src = "script.js"></script>
</body>
</html>