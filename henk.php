<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Henkilotunnus</title>
</head>
<body>
    
<form action="" method="POST" class="mt-3">
    <div class="mb-3 row">
        <label for="henkilo" class="col-sm-3 col-form-label">Henkilotunnus</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="inputhenkilo" name="henkilo">

            </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Tallenna</button>
    </div>

</form>

    
    
</body>
</html>

<?php
    if(isset($_POST['henkilo'])){
        $lista = array('0','1','2','3','4','5','6','7','8','9','A', 'B', 'C', 'D', 'E', 'F', 'H', 'J', 'K', 
        'L', 'M', 'N', 'P','R','S','T', 'U', 'V', 'W', 'X', 'Y');

        //Saa inputin viime sivun input kentältä

    
        $moi =  $_POST["henkilo"];
        $terve = $moi;
        $hei = 0;
        
        //katsoo jos input on 11 kirjainta
        if(strlen($terve) == 11){   
            
            //tarkistaa onko 1,2,3,4,5,6,8,9,10  merkit numeroita ja onko 7,11 merkit merkkejä
            
            if(is_numeric($terve[0]) && is_numeric($terve[1]) && is_numeric($terve[2])
            && is_numeric($terve[3]) && is_numeric($terve[4]) && is_numeric($terve[5])
            && is_string($terve[6]) && is_string($terve[10])
            && is_numeric($terve[7]) && is_numeric($terve[8]) && is_numeric($terve[9])) {

                    $hei = $hei + 0;
                //katsoo jos päivämäärä voi olla oikea
                if($terve[0].$terve[1] > 31 || $terve[0].$terve[1] < 1){
                    $hei = $hei + 1;
                }
                else{
                    $hei = $hei + 0;
                }
                //katsoo jos kuukausi voi olla oikea
                if($terve[2].$terve[3] > 12 || $terve[2].$terve[3] < 1){
                    $hei = $hei + 1;
                }
                else{
                    $hei = $hei + 0;
                }
                //katsoo jos vuosi voi olla oikea
                if($terve[4].$terve[5] > 99 || $terve[4].$terve[5] < 0){
                    $hei = $hei + 1;
                }
                else{
                    $hei = $hei + 0;
                }
                //katsoo jos 7 inputin kirjai on A , - tai +
                if (str_contains($terve[6], '-')||str_contains($terve[6], 'A')||str_contains($terve[6], '+')){
                    $hei = $hei + 0;
                }
                else{
                    $hei = $hei +1;
                    
                }
                //katsoo jos 3 numeroinen numero on mahdollinen
                $sum = $terve[7].$terve[8].$terve[9];
                if($sum < 001 || $sum > 999){
                    $hei = $hei + 1;
                }
                else{
                    $hei = $hei + 0;
                }

                //katsoo jos 9 numeroisen luvun jakojäännöksen ja katsoo jos tarkistus kirjain on oikea
                $yht = $terve[0].$terve[1].$terve[2].$terve[3].$terve[4].$terve[5].$terve[7].$terve[8].$terve[9];
                $ref = $yht % 31;

                if($terve[10] == $lista[$ref]){
                    $hei = $hei + 0;
                }
                else{
                    $hei = $hei + 1;
                }

            }else{
                $hei = $hei + 1;
            }   
            


        }
        else{
            $hei = $hei + 1;
        }

        //kertoo jos id on oikea tai väärennetty
        if($hei >= 1){
            echo "Väärennetty ID id: ",$terve;
        }
        else if($hei < 1){
            echo "ID on tosi";

        }
       
    }
    
    
?>
