<?php

if(isset($_POST['form-captcha-submit'])){
    @$username = $_POST['username'];
    @$password = $_POST['passwd'];

    $captchaSecretKey = '6LeA3SodAAAAAMX6UToI9Cwor7bwsjKJdhFQ960V';
    $captchaResponseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
                'secret' => $captchaSecretKey,
                'response' => $captchaResponseKey,
                'remote' => $userIP
            ];

    $ch   = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $result = curl_exec($ch);

    curl_close($ch);

    var_dump(json_decode($result));

}

?>



<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ReCAPTCHA</title>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function testeCAPTCHA (token){
            document.getElementById('formCAPTCHA').submit()
        }

    </script>
</head>
<body>
    <form action="index.php" method="post" id="formCAPTCHA">
        <input type="text" name="username" id="username" placeholder="Usuário: ">
        <input type="password" name="passwd" id="passwd" placeholder="Senha: ">
        <input type="hidden" name="form-captcha-submit">

        <button class="g-recaptcha" data-sitekey="6LeA3SodAAAAAAIi5OjtLy5PrBVbvnf275L-tguu" data-callback='testeCAPTCHA'>Submit</button>
    </form>
</body>
</html>