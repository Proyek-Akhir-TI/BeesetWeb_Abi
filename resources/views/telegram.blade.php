

<!DOCTYPE html>
<html>
<meta http-equiv="refresh" content="30" />
<body>
<div class="text-center"> Telegram Bot
</div>
@php
    


if ($pesan == "lokasi") {
        foreach($kandang as $val){
            $balas =  $val->nama." "."https://www.google.com/maps/@".$val->latitude.",".$val->longitude."".",15.0z"; 
            echo $balas;
            $status = Telegram::sendMessage($id,$balas);
            }
        }
    else if($pesan == "berat"){
        foreach($berat as $val){
            $balas = $val->kandang." Telah panen sebanyak ".$val->berat_panen." Kg"." Tanggal Panen ". $val->created_at;
            echo $balas;
            $status = Telegram::sendMessage($id,$balas);
            }
    }
    else if($pesan == "total berat"){
        foreach($akumulasi as $v){
            $balas = $v->kandang." Telah panen sebanyak ".$v->total." Kg";
            echo $balas;
            $status = Telegram::sendMessage($id,$balas);
            }
    }
    else if($pesan == "stop"){
    }
        
            else{
                $balas = "Pesan Tidak Valid, ketik Lokasi untuk mengetahui koordinat kandang, ketik berat untuk mengetahui berat panen, ketik stop untuk berhenti";
                echo $pesan;
                $status = Telegram::sendMessage($id,$balas);
            }
            
@endphp     

</body>

<script type="text/javascript">
    setTimeout(function () {
        location.reload();
    }, 30000);
</script>


</html>
