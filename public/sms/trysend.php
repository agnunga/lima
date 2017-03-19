<?php
sendSms("+254712929181", "31/1/2015");

function sendSms($phone, $intv_date) {
    $msg = urlencode("We are glad to inform you that you are invited for an interview on $intv_date. Thank you in advance. ILTS.");
    $url = "http://localhost:603/cgi-bin/sendsms?username=kannel&password=kannel&to=$phone&text=$msg";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    $response = curl_exec($ch);
    curl_close($ch);
    echo "Message sent successfully to $phone";
    header("Location: $url");
}
?>
<script>

</script>