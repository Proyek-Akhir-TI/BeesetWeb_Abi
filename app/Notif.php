<?php

namespace App;

class Notif
{
    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }

    public function suhu($token, $title, $isi)
    {
        $array = array("to" => $token, "notification" => ["body" => $isi, "title" => $title]);
        $field = json_encode($array);
        $headers = array();
        $headers[] = "Content-Type: application/json";
        $headers[] = "Authorization: key=AAAAIOJWNzc:APA91bEhCJVpG-1W2_VvnjYtcpehs6whqIYlLWYtY1A6RDgL5Vmrol9o-zovflnQry9ps7ajqk4RcC_lSC2E6_ffMMnir7MFXCFio2LtA7NKzkGURAcwjRkOGfDLHQ379LTnngJM6dQ3";
        $headers[] = "Connection: keep-alive";
        curl_setopt($this->ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_HEADER, true);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $field);
        $result = curl_exec($this->ch);

        return $result;
    }

    public function suhu2($token, $title, $isi)
    {
        $ch = curl_init();
        $array = array("to" => $token, "notification" => ["body" => $isi, "title" => $title]);
        $field = json_encode($array);
        curl_setopt_array($ch, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>$field,
            CURLOPT_HTTPHEADER => array(
              "Content-Type: application/json",
              "Authorization: key=AAAAIOJWNzc:APA91bEhCJVpG-1W2_VvnjYtcpehs6whqIYlLWYtY1A6RDgL5Vmrol9o-zovflnQry9ps7ajqk4RcC_lSC2E6_ffMMnir7MFXCFio2LtA7NKzkGURAcwjRkOGfDLHQ379LTnngJM6dQ3"
            ),
          ));
        $result = curl_exec($ch);
        return $result;
    }

    public function telegram()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.telegram.org/bot1368259338:AAGycYAzyo2CgURnrxt07FdriY4seAkYuwc/getUpdates",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
      ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $status = $data['ok'];
 
        if ($status) {
            $count = count($data['result']);
            if (isset($data['result'][$count-1]['message']['text'])) {
                $text = $data['result'][$count-1]['message']['text'];
                echo  $text;
            } else {
                echo "NO";
            }
        } else {
            echo "Bot Error";
        }
    }
    public function getID()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.telegram.org/bot1368259338:AAGycYAzyo2CgURnrxt07FdriY4seAkYuwc/getUpdates",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
      ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);
        $status = $data['ok'];
        if ($status) {
            $count = count($data['result']);
            $id = $data['result'][$count-1]['message']['chat']['id'];
            return $id;
        } else {
            return "No Id";
        }
    }

    public function sendMessage($id, $pesan)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.telegram.org/bot1368259338:AAGycYAzyo2CgURnrxt07FdriY4seAkYuwc/sendMessage?chat_id=$id&text=$pesan",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
          ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        $status = $data['ok'];

        return $status;
    }
}
