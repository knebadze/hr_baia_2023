<?php


// INSERT INTO `anketebi` (`id`, `specialoba`, `telefoni`, `email`, `fio`, `asaki`, `timestamp`, `fb_id`) VALUES ('1111111111', 'ძიძა', '577671339', 'nona.gogua@list.ru', 'ნუნუ გაფრინდაშვილი', '50', CURRENT_TIMESTAMP, '100000');

    // ================= Database =================
        $servername = "localhost";
        $username = "baia_hr";
        $password = "lFz9Tmpp8c";
        $db_name = "baia_hr";
        date_default_timezone_set("Asia/Tbilisi");

        try {
            $conn = new PDO(
                "mysql:host=$servername;dbname=$db_name", 
                $username,
                $password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") 
            );
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    
        function select_db($conn, $sql){
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        }
        function get_positons($conn, $sql){
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return json_encode($stmt->fetchAll());
        }
        
        function update($conn, $sql){
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            return "{
                'status': 'success'
            }";
        }

    // ================= Database =================



    if (isset($_GET['positions'])){
        echo get_positons($conn, "SELECT sataurige FROM jobs LIMIT 10");
    }

    if (isset($_GET['filter'])){
        header('Access-Control-Allow-Origin: *', false);
        echo json_encode(array(
            "category" => select_db($conn, "SELECT sataurige, id FROM jobs"),
            "city" => select_db($conn, "SELECT * FROM `invel` WHERE `subid` = 49"),
            "ubani" => select_db($conn, "SELECT * FROM `invel` WHERE `subid` = 50"),
            "grafiki" => select_db($conn, "SELECT * FROM `invel` WHERE `subid` = 41"),
            "age" => select_db($conn, "SELECT * FROM `invel` WHERE `subid` = 5"),
            "language" => select_db($conn, "SELECT * FROM `invel` WHERE `subid` = 16"),
            "salary" => select_db($conn, "SELECT * FROM `invel` WHERE `subid` = 44"),
            "edu" => select_db($conn, "SELECT * FROM `invel` WHERE `subid` = 13")
        ));
    }
    
    if (isset($_GET['daintereseba'])){
        $vac_id = $_GET["vac_id"];
        $user_id = $_GET["user_id"];
        $name = $_GET["user_id"];
        $shedegi = select_db($conn, "SELECT shedegi FROM damkveti WHERE id = $vac_id")[0]["shedegi"];
        $date = date("Y-m-d")." ".date("H:i");
        $daintereseba = select_db($conn, "SELECT daintereseba FROM damkveti WHERE id = $vac_id")[0]["daintereseba"];
        // if(strstr($daintereseba, $user_id)){
        //     echo "{
        //         'status': 'cancel'
        //     }";
        //     return "";   
        // }

        if(strstr($shedegi, "დაკავდა") != ""){
            echo "{
                'status': 'cancel'
            }";
            return "";
        } 
        if(strstr($shedegi, "გაუქმ") != ""){
            echo "{
                'status': 'cancel'
            }";
            return "";
        }
        if(strstr($shedegi, "შეჩერ") != ""){
            echo "{
                'status': 'cancel'
            }";
            return "";
        }
        if(strstr($shedegi, "შესულია") != ""){
            echo "{
                'status': 'cancel',
                'anketa': 'http://hrbaia.com/ge/admin/downloadank/$user_id'
            }";
            return "";
        }
        $text ='<a title="დრო: '.$date.'" style="color:darkblue;font-weight:bold;" onclick="navigator.clipboard.writeText(this.innerHTML.slice(2,-2));" href="https://www.facebook.com/saagentobaia1/inbox/">*'. select_db($conn, "SELECT `fio` FROM `anketebi` WHERE fb_id = $user_id")[0]["fio"] . '*</a>';

        // $text = $conn->prepare($sql);
        $data = select_db($conn, "SELECT shedegi FROM damkveti WHERE id = $vac_id")[0]["shedegi"];
       
        function str_replace_first($from, $to, $content){
            $from = '/'.preg_quote($from, '/').'/';
            return preg_replace($from, $to, $content, 1);
        }


        $daintereseba = "$daintereseba$user_id;";

        if(strpos($data, "დაინტერესდნენ:|")){
            if(!strpos($data,"* $name *")){
                $data = str_replace_first("დაინტერესდნენ:|", "დაინტერესდნენ:|/$text/,", $data);
                echo update($conn, "UPDATE damkveti SET shedegi='$data', daintereseba = '$daintereseba' WHERE id = $vac_id");
            }
        } else {
            $data ="$data დაინტერესდნენ:|/$text/|";
            echo update($conn, "UPDATE damkveti SET shedegi='$data', daintereseba = '$daintereseba' WHERE id = $vac_id");
        }
    }
    
    // UPDATE DATA
    if(isset($_POST['update_number'])){
        $update_number = $_POST["update_number"];
        $fb_id = $_POST["fb_id"];

        update($conn, "UPDATE `anketebi` SET `telefoni` = '$update_number' WHERE `anketebi`.`fb_id` ='$fb_id'");
    } 

    if(isset($_POST['update_hr'])){
        $update_number = $_POST["update_number"];
        $fb_id = $_POST["fb_id"];

        update($conn, "UPDATE `anketebi` SET `telefoni` = '$update_number' WHERE `anketebi`.`fb_id` ='$fb_id'");
    } 
    
    if(isset($_POST['update_email'])){
        $update_email = $_GET["update_email"];
        $fb_id = $_POST["fb_id"];
        echo update($conn, "UPDATE `anketebi` SET `email` = '$update_email' WHERE `anketebi`.`email` ='$fb_id'");
    } 

    if(isset($_POST['update_position'])){
        $update_position = $_GET["update_position"];
        $fb_id = $_POST["fb_id"];
        echo update($conn, "UPDATE `anketebi` SET `specialoba` = '$update_position' WHERE `anketebi`.`fio` ='$fb_id'");
    } 

    if(isset($_POST['add_client'])){
        $fb_id = $_POST['fb_id'];
        $name = $_POST['name'];
        $img_url = $_POST['img'];
        $img_date = md5(date('d-m-Y:H:i:s'));  

        file_put_contents("pictures/$img_date.jpg", file_get_contents($img_url)); 


        // $employment_type = $_POST['employment_type'];
        // if (employment_type == "client"){
        //     echo update($conn, "INSERT INTO `anketebi` (`fb_id`, `fio`, `fb_img`) VALUES ('$fb_id', '$name', '$img')");

        // } else {
        echo update($conn, "INSERT INTO `anketebi` (`fb_id`, `fio`, `file`) VALUES ('$fb_id', '$name', '$img_date.jpg')");
        // }

    }

    if (isset($_GET['filter_user'])) {
        $specialoba =  $_POST['category'];
        // $city =  $_GET['city'];
        // $ubani =  $_GET['ubani'];
        $grafiki = $_POST['grafiki'];
        $edu = $_POST['edu'];
        $min_salary = $_POST['min_salary'];
        $max_salary = $_POST['max_salary'];
        $min_age = $_POST['min_age'];
        $max_age = $_POST['max_age'];
        $language = $_POST['language'];
        $filter_query = "SELECT chatfuel_id FROM anketebi WHERE 1=1 ";
        if(isset($specialoba) && $specialoba!==''){
            $filter_query = "$filter_query AND specialoba = '$specialoba' ";
        }
        if(isset($edu) && $edu!==''){
            $filter_query = "$filter_query AND `ganatleba` LIKE '%$edu%' ";
        }
        if(isset($grafiki) && $grafiki!==''){
            $filter_query = "$filter_query AND grafiki = '$grafiki' ";
        }
        if(isset($min_salary) && isset($max_salary) && $min_salary!=='' && $max_salary!==''){
            $filter_query = "$filter_query AND (`minurov` BETWEEN $min_salary AND $max_salary) ";
        }
        if(isset($min_age) && isset($max_age) && $min_age!=='' && $max_age!==''){
            $filter_query = "$filter_query AND `asaki` BETWEEN $min_age AND $max_age";
        }

        if(isset($language) && $language!==''){
            $filter_query = "$filter_query AND `ucxoena` LIKE '%$language%' ";
        }

        echo get_positons($conn, "$filter_query AND `chatfuel_id` != ''");
        // echo "$filter_query AND `chatfuel_id` != ''";
    }
    
    if (isset($_GET['reset'])) {
        update($conn, "UPDATE `daminfo` SET `sent` = '0' WHERE `daminfo`.`id` = 1704");
        update($conn, "UPDATE `daminfo` SET `sent` = '0' WHERE `daminfo`.`id` = 1707");
        update($conn, "UPDATE `daminfo` SET `sent` = '0' WHERE `daminfo`.`id` = 1706");
        update($conn, "UPDATE `daminfo` SET `sent` = '0' WHERE `daminfo`.`id` = 1705");
    }

    if (isset($_GET['for_sent'])) {
        $dam_info = select_db($conn, "SELECT ids, id FROM daminfo WHERE `date` > date_sub(now(), interval 1 day) AND `sent` = 0 ");

        $damkveti_query = "SELECT * FROM `damkveti` WHERE 1 != 1 ";
        
        foreach ($dam_info as $dam) {
            $get_ids = explode(';', $dam["ids"]);
            foreach ($get_ids as $id) {
                if ($id != "") {
                    $damkveti_query = "$damkveti_query OR id = $id ";
                }
            }
            update($conn, "UPDATE `daminfo` SET `sent` = '1' WHERE `id` = ".$dam["id"]);
        }
        echo "[";
        echo get_positons($conn, $damkveti_query);
        echo ",";
        echo get_positons($conn, "SELECT * FROM users WHERE is_manager = 1");
        echo "]";
    }

    $conn = null;
?>