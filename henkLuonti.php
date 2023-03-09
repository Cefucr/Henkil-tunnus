<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HenkilötunnusLuoja</title>
</head>
<body style="text-align:center;">
    
<form method="POST" class="mt-3">
    <h1>Luo Henkilötunnus</h1>
    <input type="submit" name="tunnus" class="button" value="Luo Tunnus" />

</form>
</body>
</html>
<?php

    
    if(array_key_exists('tunnus', $_POST)) {

        //Määritellään aakkoset ja luvut joita voidaan käyttää loppumerkkinä
        $merkit = array(
        '0','1','2','3','4','5','6','7','8','9',
        'A', 'B', 'C', 'D', 'E', 'F', 'H', 'J', 'K', 
        'L', 'M', 'N', 'P','R','S','T', 'U', 'V', 'W', 'X', 'Y'
        );

        //Valitaan random vuosi ja katsotaan vuosimerkki
        $vuosi = rand(1800,date("Y"));

        if($vuosi >= 1800 and $vuosi < 1900){
            $merkki = "+";
        }
        else if($vuosi >= 1900 and $vuosi < 2000){
            $merkki = "-";
        }
        else if($vuosi >= 2000){
            $merkki = "A";
        }

        $vuosi = substr($vuosi, 2);

        //Valitaan random kuukausi, katsotaan onko karkausvuosi 
        //ja jos kuukaudi on yksi lukuinen pistetään 0 eteen

        $kuukausi = rand(1,12);

        if(strlen($kuukausi) == 1){
            $kuukausi = "0".$kuukausi;
        }

        if($kuukausi == 4 || $kuukausi == 6 || $kuukausi == 9 || $kuukausi == 11){
            $maxPvm = 30;
        }
        else if($kuukausi == 2){
            if($vuosi % 4 != 0){
                $maxPvm = 28;
            }else{
                $maxPvm = 29;
            }
        }
        else{
            $maxPvm = 31;
        }
        
        //Valitaan random päivä. Jos se on 1 lukuinen pistetään 0 eteen
        $paiva = rand(1,$maxPvm);

        if(strlen($paiva) == 1){
            $paiva = "0".$paiva;
        }
            

        //Valitaan random luvut. 
        //Jos on 1 tai 2 numeroinen pistetään nollia eteen että siitä tulee 3 lukuinen 

        $luvut = rand(2,899);

        while(strlen($luvut) < 3){
            $luvut = "0".$luvut;
        }
       
        //Määritellään loppumerkki
        $laske = [$paiva,$kuukausi,$vuosi,$luvut];

        $yht = implode("",$laske);

        $loppu = intval($yht) % 31;

        $loppu = $merkit[$loppu];

        $tunnus = [$paiva,$kuukausi,$vuosi,$merkki,$luvut,$loppu];

        
        echo "<br>Tunnuksesi: ",implode("",$tunnus);
    }
?>
