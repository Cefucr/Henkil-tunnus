<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Henkilötunnus</title>
</head>
<body style="text-align:center;">
<form action="" method="POST" class="mt-3">
    <div class="mb-3 row">
        <label for="henkilo" class="col-sm-3 col-form-label">Henkilötunnus</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="inputhenkilo" name="henkilo">
            </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Lähetä</button>
    </div>
</form>
</body>
</html>

<?php
    if(isset($_POST['henkilo'])){
        $kirjaimetJaMerkit = array('0','1','2','3','4','5','6','7','8','9','A', 'B', 'C', 'D', 'E', 'F', 'H', 'J', 'K', 
        'L', 'M', 'N', 'P','R','S','T', 'U', 'V', 'W', 'X', 'Y');
    
        $input = $_POST["henkilo"];
        $onkoVaarin = false;
        $errorMsg = [];
     
        //katsoo jos input on 11 kirjainta
        if(strlen($input) == 11){        

            $paiva = $input[0].$input[1];
            $kuukausi = $input[2].$input[3];
            $vuosi = $input[4].$input[5];
            $merkki = $input[6];
            $luvut = $input[7].$input[8].$input[9];
            $lopetusMerkki = $input[10];

            if(is_numeric($paiva) == true && is_numeric($kuukausi) == true && is_numeric($vuosi) == true ){
                
                //katsoo jos vuosi voi olla oikea
                if($vuosi > 99 || $vuosi < 0){
                    $onkoVaarin = true;
                    array_push($errorMsg, 'Tarkista Vuosi!');
                }
                
                //katsoo jos kuukausi voi olla oikea
                if($kuukausi > 12 || $kuukausi < 1 ){
                    $onkoVaarin = true;
                    array_push($errorMsg, 'Tarkista Kuukausi!');
                }
                
                //kuinka monta pvm on kussakin kuukaudessa
                if($kuukausi == 4
                || $kuukausi == 6
                || $kuukausi == 9
                || $kuukausi == 11){
                    $maxPvm = 30;
                }else if($kuukausi == 2){

                    //onko karkausvuosi
                    if($vuosi % 4 != 0){
                        $maxPvm = 28;
                    }else{
                        $maxPvm = 29;
                    }
                }else{
                    $maxPvm = 31;
                }

                //katsoo jos päivämäärä voi olla oikea
                if($paiva > $maxPvm){
                    $onkoVaarin = true;
                    array_push($errorMsg, 'Tarkista Pvm!');
                }
                
                //katsoo jos 7 inputin kirjain on A , - tai +
                if (!str_contains($merkki, '-') && !str_contains($merkki, 'A') && !str_contains($merkki, '+')){
                    $onkoVaarin = true;
                    array_push($errorMsg, 'Tarkista Merkki!');
                }

                //katsoo jos 3 numeroinen numero on mahdollinen
                if(is_numeric($input[7]) == false 
                || is_numeric($input[8]) == false 
                || is_numeric($input[9]) == false){
                    $onkoVaarin = true;
                    array_push($errorMsg, 'Kohta 8,9,10 pitäisi olla numeroita!');
                }else{
                    if($luvut < 2 || $luvut > 899){
                        $onkoVaarin = true;
                        array_push($errorMsg, 'Tarkista kohta 8,9,10!');
                    }

                    //katsoo jos 9 numeroisen luvun jakojäännöksen ja katsoo jos tarkistus kirjain on oikea
                    $yht = $input[0].$input[1].$input[2].$input[3].$input[4].$input[5].$input[7].$input[8].$input[9];
                    $ref = $yht % 31;
                
                    if(!str_contains($lopetusMerkki,$kirjaimetJaMerkit[$ref])){
                        $onkoVaarin = true;
                        array_push($errorMsg, 'Tarkista lopetuskirjain!');
                    }
                }
            }else{
                $onkoVaarin = true;
                array_push($errorMsg, 'Kohdat 1-6 ja 8-10 pitää olla numeroita!');
            }
        }else{
            $onkoVaarin = true;
            array_push($errorMsg, 'Liian lyhyt!');
        }

        //kertoo jos tunnus on oikea tai väärennetty
        if($onkoVaarin == true){
            echo $errorMsg[0],"<br><br> Tunnus: ",$input;
        }
        else if($onkoVaarin <= false){
            echo "Tunnus on OK! :)";
        }
    }
?>
