<?php
/* WhisperPress Backend —— 只存密文，零明文 */
session_start();
$room = preg_replace('/[^a-zA-Z0-9\-_]/','', $_GET['room'] ?? 'default');
$file = __DIR__.'/rooms/'.$room.'.txt';

if (!is_dir('rooms')) mkdir('rooms');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

switch($_SERVER['REQUEST_METHOD']){
case 'POST':
    $json = json_decode(file_get_contents('php://input'), true);
    $line = json_encode($json, JSON_UNESCAPED_UNICODE).PHP_EOL;
    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    echo json_encode(['ok'=>true]);
    break;
case 'GET':
    $lines = file_exists($file) ? array_filter(explode(PHP_EOL, file_get_contents($file))) : [];
    echo '['.implode(',', $lines).']';
    break;
default:
    http_response_code(405);
}
?>
