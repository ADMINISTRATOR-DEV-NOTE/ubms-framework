<?php

class Img {

    public function saveThumbnail($saveToDir, $imagePath, $imageName, $max_x, $max_y) {
        preg_match("'^(.*)\.(gif|jpe?g|png)$'i", $imageName, $ext);
        switch (strtolower($ext[2])) {
            case 'jpg' :
            case 'jpeg': $im = imagecreatefromjpeg($imagePath);
                break;
            case 'gif' : $im = imagecreatefromgif($imagePath);
                break;
            case 'png' : $im = imagecreatefrompng($imagePath);
                break;
            default : $stop = true;
                break;
        }

        if (!isset($stop)) {
            $x = imagesx($im);
            $y = imagesy($im);

            if (($max_x / $max_y) < ($x / $y)) {
                $save = imagecreatetruecolor($x / ($x / $max_x), $y / ($x / $max_x));
            } else {
                $save = imagecreatetruecolor($x / ($y / $max_y), $y / ($y / $max_y));
            }
            imagecopyresized($save, $im, 0, 0, 0, 0, imagesx($save), imagesy($save), $x, $y);

            imagegif($save, "{$saveToDir}{$ext[1]}.gif");
            imagedestroy($im);
            imagedestroy($save);
        }
    }

}
