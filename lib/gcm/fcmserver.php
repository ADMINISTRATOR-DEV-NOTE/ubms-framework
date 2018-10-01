<?php

class FcmServer {

    public function send($arrTokens, $message, $arrData) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array(
            'registration_ids' => $arrTokens,
            'notification' => $message,
            'data' => $arrData
        );

        $headers = array(
            'Authorization:key =' . CConfig::FCM_SERVER_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);

        $res = json_decode($result);
        if ($res->failure == 0) {
        	return array(
        			"result" => true,
        			"data" => json_decode($result, true)
        	);
//            echo json_encode(array("result" => true, "data" => $result));
        } else {
        	return array(
        			"result" => false
        	);
        }
    }

}

/*
  $fcm = $this->load->lib("gcm/fcm");
        $token = array();

        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");
        array_push($token, "dTHLWHuntwY:APA91bGt35E_B1tiSPXHMhkgTXvRRxpU1iiOIxm3j4BA4eKlyBaHmGC5fvlceT6jUgqRbwDmILEdvP33wHsvOIvMSdk1WXeYK6ZwyD8_sAP6uBOkSbevKPLfjq9gOeNXZRc3Mudi0bbv");

        $msg = array(
            "body" => "message",
            "title" => "title",
            "sound" => "Enable");
        $data = array("url" => "http://naver.com");
        $fcm->send($token, $msg, $data);
 */
