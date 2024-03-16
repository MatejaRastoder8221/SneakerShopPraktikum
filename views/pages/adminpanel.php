    <?php
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        if ($user['role_id'] == 1) {
            require_once "config/connection.php";

            echo "<div class='container'>
                    <div class='row'>
                        <div class='col-12'>
                            <h3 class='mb-5 mt-5 text-center'>Welcome " . $user['name'] . "</h3>
                        </div>
                    </div>
                </div>";


            //ovde ubaciti statistiku pristupa stranicama
            $log=file('data/log.txt');
            //var_dump($log); 
            //$brojPristupa=count($log);
            $brojPristupa=0;
            //var_dump($brojPristupa); 
            $HOME=0;
            $DOC=0;
            $AP=0;
            $SHOP=0;
            $ABOUT=0;
            $CONTACT=0;
            foreach($log as $linija){
                $stranica=explode("__",$linija)[0];
                $vreme=explode("__",$linija)[3];
                if($vreme>(time()-86400)){
                    $brojPristupa++;
                    switch ($stranica) {

                        case "home":
                            $HOME++;
                            break;
                        case "Documentation":
                            $DOC++;
                            break;
                        case "admin Panel":
                            $AP++;
                            break;
                        case "contact":
                            $CONTACT++;
                            break;  
                        case "about":
                            $ABOUT++;
                            break;
                        case"shop":
                            $SHOP++;
                            break;  
                        default:
                            break;
                    }
                }
            }
            $procenat = 100 / $brojPristupa;
            $HOME=$HOME*$procenat;
            $DOC=$DOC*$procenat;
            $AP=$AP*$procenat;
            $SHOP=$SHOP*$procenat;
            $ABOUT=$ABOUT*$procenat;
            $CONTACT=$CONTACT*$procenat;

            //var_dump($HOME);

            ?>
            <div class="container">
            <h4 class="text-center">Last 24h of user activity</h4>
            <div class="row">
            <div class="col-12" id="pristupStranicama">
                <p class="fs-5">Home page</p>
                <div class="w3-border">
                <div class="w3-blue" style="height:24px;width:<?=$HOME?>%"><?=number_format($HOME, 2)."%";?></div>
                </div>
                <p class="fs-5">Documentation page</p>
                <div class="w3-border">
                <div class="w3-blue" style="height:24px;width:<?=$DOC?>%"><?=number_format($DOC, 2)."%";?></div>
                </div>
                <p class="fs-5">Admin panel page</p>
                <div class="w3-border">
                <div class="w3-blue" style="height:24px;width:<?=$AP?>%"><?=number_format($AP, 2)."%";?></div>
                </div>
                <p class="fs-5">Shop page</p>
                <div class="w3-border">
                <div class="w3-blue" style="height:24px;width:<?=$SHOP?>%"><?=number_format($SHOP, 2)."%";?></div>
                </div>
                <p class="fs-5">About page</p>
                <div class="w3-border">
                <div class="w3-blue" style="height:24px;width:<?=$ABOUT?>%"><?=number_format($ABOUT, 2)."%";?></div>
                </div>
                <p class="fs-5">Contact page</p>
                <div class="w3-border">
                <div class="w3-blue" style="height:24px;width:<?=$CONTACT?>%"><?=number_format($CONTACT, 2)."%";?></div>
                </div>
            </div>
            </div>
            </div>
            <?php
            include 'models/adminmenu.php';



            echo '<div class="container">
            <div class="row">
            <div class="col-12" id="adminIspis"></div>
            </div></div> </div>';
        }
    }
    ?>






    