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
        $aakkoset = array('0','1','2','3','4','5','6','7','8','9','A', 'B', 'C', 'D', 'E', 'F', 'H', 'J', 'K', 
        'L', 'M', 'N', 'P','R','S','T', 'U', 'V', 'W', 'X', 'Y');

        //Saa inputin viime sivun input kentältä

    
        $henkilo =  $_POST["henkilo"];
        $tunnus = $henkilo;
        $vaara = 0;
        
        //katsoo jos input on 11 kirjainta
        if(strlen($tunnus) == 11){   
            
            //tarkistaa onko 1,2,3,4,5,6,8,9,10  merkit numeroita ja onko 7,11 merkit merkkejä
            
            if(is_numeric($tunnus[0]) && is_numeric($tunnus[1]) && is_numeric($tunnus[2])
            && is_numeric($tunnus[3]) && is_numeric($tunnus[4]) && is_numeric($tunnus[5])
            && str_contains($tunnus[6], '-')||str_contains($tunnus[6], 'A')||str_contains($tunnus[6], '+')
            && ctype_alpha($tunnus[10])
            && is_numeric($tunnus[7]) && is_numeric($tunnus[8]) && is_numeric($tunnus[9])){

                //katsoo jos päivämäärä voi olla oikea
                if($tunnus[0].$tunnus[1] > 31 || $tunnus[0].$tunnus[1] < 1){
                    $vaara++;
                }
                //katsoo jos kuukausi voi olla oikea
                if($tunnus[2].$tunnus[3] > 12 || $tunnus[2].$tunnus[3] < 1){
                    $vaara++;
                }
                //katsoo jos vuosi voi olla oikea
                if($tunnus[4].$tunnus[5] > 99 || $tunnus[4].$tunnus[5] < 0){
                    $vaara++;
                }
                
                //katsoo jos 7 inputin kirjai on A , - tai +
                if (!(str_contains($tunnus[6], '-')||str_contains($tunnus[6], 'A')||str_contains($tunnus[6], '+'))){
                    $vaara++;
                }
                //katsoo jos 3 numeroinen numero on mahdollinen
                $sum = $tunnus[7].$tunnus[8].$tunnus[9];
                if($sum < 001 || $sum > 999){
                    $vaara++;
                }
                
                //katsoo jos 9 numeroisen luvun jakojäännöksen ja katsoo jos tarkistus kirjain on oikea
                $yht = $tunnus[0].$tunnus[1].$tunnus[2].$tunnus[3].$tunnus[4].$tunnus[5].$tunnus[7].$tunnus[8].$tunnus[9];
                $ref = $yht % 31;

                if($tunnus[10] != $aakkoset[$ref]){
                    $vaara++;
                }

            }else{
                $vaara++;
            }   

        }
        else{
            $vaara++;
        }

        //kertoo jos id on oikea tai väärennetty
        if($vaara >= 1){
            echo "Väärennetty ID id: ",$tunnus;
        }
        else{
            echo "ID on tosi";

        }
       
    }
    
//AarniLove    
?>
