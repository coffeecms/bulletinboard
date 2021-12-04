<?php

class BB_Captcha_Image
{
    
    public static function make($totalChar=6)
    {
        

        // $db1=array('so','feel','catch','great','well','type','run','fast','call','like','hot','cold','cool','can','write','read','speed');

        // $db2=array('me','what','baby','care','rank','park','summer','katy');

        // shuffle($db1);

        // shuffle($db2);

        $main_img = imagecreatetruecolor(250, 78);

        $bg_color = imagecolorallocate($main_img, 255, 255, 255);

        imagefill($main_img, 0, 0, $bg_color);

        $captcha_str =randNumber($totalChar);

        $captcha_str=strtoupper($captcha_str);
 
        // $captcha_str = $db1[0] . ' ' . $db2[0];

        $dbColor = array(
            0 => array(100, 161, 39),
            1 => array(64, 64, 64),
            2 => array(65, 192, 209),
            3 => array(237, 89, 26),
            4 => array(237, 26, 72),
            5 => array(163, 39, 161),
            6 => array(78, 207, 96),
            7 => array(219, 24, 157)

        );
        $dbRotator = array(
            45,
            10,
            30,
            -5,
            -10,
            -30,
            -50
        );
        $dbUpDown = array(
            55,
            40,
            50,
            45,
            35,
            30,
            65

        );

        $font_file = ROOT_PATH . 'public/Eirik Raude.ttf';

        $strLen = strlen($captcha_str);

        $db=new Database(); 

        $db->nonquery("delete from bb_captcha_session_data where session_id='".Configs::$_['visitor_data']['session_id']."'");

        $insertData=array(
            'session_id'=>Configs::$_['visitor_data']['session_id'],
            'captcha_id'=>'IMAGE',
            'answer'=>$captcha_str
        );    
    
        $queryStr=arrayToInsertStr('bb_captcha_session_data',$insertData);
    
        $db->nonquery($queryStr);

        $space = 20;

        for ($i = 0; $i < $strLen; $i++) {

            $colorRand = rand(0, 7);

            $rotatorRand = rand(0, 5);

            $updownRand = rand(0, 3);

            $black = imagecolorallocate($main_img, $dbColor[$colorRand][0], $dbColor[$colorRand][1], $dbColor[$colorRand][2]);

            imagefttext($main_img, 30, 5, $space, 50, $black, $font_file, $captcha_str[$i]);

            $space += 30;
        }


//        $colorRand = rand(0, 7);
//
//        $black = imagecolorallocate($main_img, $dbColor[$colorRand][0], $dbColor[$colorRand][1], $dbColor[$colorRand][2]);
//
//        imagefttext($main_img, 30, 0, 15, 55, $black, $font_file, $captcha_str);

//        Create session

//        self::$thisHash=$hash;

     
//        End create session

//         if ($is_text == 'no') {
//             header("Content-type: image/png");

//             imagepng($main_img);
//         } else {

//             $savePath = ROOT_PATH . 'public/caches/' . Strings::randAlpha(12) . '.png';

//             imagepng($main_img, $savePath);

// //            $dataImg = ob_get_contents();

// //            ob_end_clean();

//             $dataImg = file_get_contents($savePath);

//             unlink($savePath);

//             return 'data:image/png;base64,' . base64_encode($dataImg);
//         }

        // $savePath = ROOT_PATH . 'public/caches/' . Strings::randAlpha(12) . '.png';

        // imagepng($main_img, $savePath);
        ob_start();
        imagepng($main_img);
        // Capture the output and clear the output buffer
        $dataImg = ob_get_clean();
        
//            $dataImg = ob_get_contents();

//            ob_end_clean();

        // $dataImg = file_get_contents($savePath);

        // unlink($savePath);

        return 'data:image/png;base64,' . base64_encode($dataImg);
    }
}