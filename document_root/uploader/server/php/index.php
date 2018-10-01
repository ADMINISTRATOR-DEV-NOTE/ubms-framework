<?php

fileUpload();

function fileUpload() {
    $res = "";

    $total = count($_FILES['files']['name']);

    if (is_array($_FILES['files']['name'])) {
        $filesize = 0;
        foreach ($_FILES['files']['size'] as $key => $val) {
            if ($_FILES['files']['size'][$key] > 0) {
                $filesize += $_FILES['files']['size'][$key];
            }
        }
        // 사용자 입력필드 파일 제한 크기 
        $maxfilesize = 10000000;
        if ($filesize > $maxfilesize) {
            echo "허용 파일용량을 초과하였습니다. {$filesize}";
        } else {
//            echo "total : {$filesize}";

            for ($i = 0; $i < $total; $i++) {
                $filename = $_FILES['files']['name'][$i];
                $filename_ext = strtolower(array_pop(explode('.', $filename)));
                $allow_file = array("jpg", "png", "bmp", "gif");

                if (!in_array($filename_ext, $allow_file)) {
                    echo "허용되지않은파일 : " . $filename;
                } else {
                    $file = new stdClass;
                    $file->name = date("YmdHis") . mt_rand() . "." . $filename_ext;
                    $file->content = file_get_contents($_FILES["files"]["tmp_name"][$i]);

                    $mm = date("Ym", mktime(0, 0, 0, date("m"), date("d"), date("Y")));
                    $data = base64_encode($file->content);
                    // $data is file data 
                    $post = array("imagefile" => $data, "filename" => $file->name);
                    $timeout = 120;
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'http://img.choeen.com/upload.php');
                    curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
                    curl_setopt($curl, CURLOPT_POST, 1);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
                    $result = curl_exec($curl);
                    curl_close($curl);

                    $res .= "http://img.choeen.com/upload/" . $mm . "/" . $file->name;
                }
            } //foreach
            echo $res;
        }
    }
}
