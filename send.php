<?php
// работа с данным скриптом показана в видео на сайте http://rek9.ru/otpravka-zayavok-v-google-forms/
// формируем запись в таблицу google (изменить)
$url = "https://docs.google.com/forms/d/e/1FAIpQLSf_L6uwFnBM2iE5TORIBIN8YGSzSRi-G7-h7GuuXDLhOY00yQ/formResponse";
// сохраняем url, с которого была отправлена форма в переменную utm
$utm = $_SERVER["HTTP_REFERER"];
// ссылка для переадресации (изменить)
$link = "http://newpeople.dance/thank-you.html";

// массив данных (изменить entry, draft и fbzx)
$post_data = array (
 "entry.1301220644" => $_POST['name'],
 "entry.43897567" => $_POST['email'],
 "entry.1966778042" => $_POST['phone'],
 "entry.1917523835" => $utm,
 "draftResponse" => "[null,null,&quot;-1762899048076259052&quot;]",
 "pageHistory" => "0",
 "fbzx" => "-1762899048076259052"
);

// Далее не трогать
// с помощью CURL заносим данные в таблицу google
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// указываем, что у нас POST запрос
curl_setopt($ch, CURLOPT_POST, 1);
// добавляем переменные
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
//заполняем таблицу google
$output = curl_exec($ch);
curl_close($ch);

//перенаправляем браузер пользователя на скачивание оффера по нашей ссылке
header('Location: '.$link);
?>