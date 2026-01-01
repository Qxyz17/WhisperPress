<?php
// WhisperPress 后端：处理房间消息的加密和存储

$room = $_GET['room'] ?? 'defaultRoom';
$file = 'messages_' . $room . '.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $messages = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    $messages[] = $data;
    file_put_contents($file, json_encode($messages));
    echo json_encode(['status' => 'success']);
} else {
    // 获取房间消息
    if (file_exists($file)) {
        echo file_get_contents($file);
    } else {
        echo json_encode([]);
    }
}
?>
