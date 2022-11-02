<?php

$al = require_once __DIR__ . '/../../vendor/autoload.php';

// Это небольшой класс для проверки введенных фильтров. Потому что запрос приходит из аякса, а это, априори, территория врага - юзера)
$validator = new \app\Validator();
$data = $validator->validate($_POST);

/*
Здесь должно быть несколько запросов к https://pub.fsa.gov.ru
Но я не могу нормально посмотреть сам сайт и разобраться в нем - с моего хостинга через курл сайт открывается, но в браузере нет.
Судя по всему, он доступен только для российских ip, потому что публичные анонимайзеры позволяют открыть сайт, но с кучей ошибок.
А мой ip помечен как украинский.
У меня нет надежных российских прокси, поэтому не получается осмотреть сам сайт.

$curl = new \fl\curl\Curl();
$cparams = json_encode([ "username" => "anonymous", "password" => "hrgesf7HDR67Bd" ]);
$responsePost = $curl->setBody($cparams, true)->post('https://pub.fsa.gov.ru/login');
*/


// Здесь небольшой кусок кода, генерирующий тестовые данные. Из-за невозможности получить реальные.
$states = $validator->getStates();
$states_ids = ['new', 'open', 'close'];
$out = [
    'status' => 'ok',
    'data' => []
];

for($n = 0; $n < $data['count']; $n++) {
    $state = (array_key_exists('state', $data) && $data['state'] != 'any') ? $data['state'] : $states_ids[mt_rand(0,2)];
    $number = (array_key_exists('number', $data)) ? $data['number'] : mt_rand(100000, 999999);
    $createDate = date('Y-m-d', time()-86400);
    $expireDate = date('Y-m-d', time()+86400*10);
    $out['data'][] = [
        'id' => $n,
        'state' => $states[$state],
        'number' => $number,
        'createDate' => $createDate,
        'expireDate' => $expireDate,
        'productName' => 'Товар №'.$n,
        'declarant' => 'Пупкин Василий',
        'mfr' => 'ООО "Вектор"',
        'productSource' => 'завод №'.$n,
        'type' => 'Товар'
    ];
}

die(json_encode($out));
