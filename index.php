<?php

# Принимаем запрос
$data = json_decode(file_get_contents('php://input'), TRUE);

//https://api.telegram.org/bot6377368414:AAGV9oqrmwz2bdACTV114BG4TJSHVVWSPCA/setwebhook?url=https://nick-koryabkin.store/index.php

# Переменные
$token = '6377368414:AAGV9oqrmwz2bdACTV114BG4TJSHVVWSPCA';

# Обрабатываем команды
$message_in = $data['message']['text'];



if ($message_in=="/start"){
    $message_out="Данный бот, если вы нажмете кнопку, предложит то, чем вы можете заняться.";
    $keyboard = [
        [
            ['text' => 'Чем заняться?']
        ]
    ];
    $reply_markup = json_encode(["keyboard"=>$keyboard,"resize_keyboard"=>true]);
    $params = [
        'chat_id' => $data['message']['chat']['id'],
        'text'    => $message_out,
        'reply_markup' => $reply_markup
    ];
}
elseif ($message_in=="Чем заняться?"){
    $date_2=json_decode(file_get_contents('http://www.boredapi.com/api/activity/'), TRUE);
    $message_out=$date_2['activity'];
    $params = [
        'chat_id' => $data['message']['chat']['id'],
        'text'    => $message_out
    ];
}
else{
    $message_out="Нажмите на кнопку";
    $params = [
        'chat_id' => $data['message']['chat']['id'],
        'text'    => $message_out
    ];
}

file_get_contents('https://api.telegram.org/bot'.$token.'/sendMessage?'.http_build_query($params));
