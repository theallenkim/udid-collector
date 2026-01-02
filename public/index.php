<?php
$host = $_SERVER['HTTP_HOST'];
$scheme = 'https';

if (isset($_GET['download'])) {
    $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
    
    $mobileconfig = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>PayloadContent</key>
    <dict>
        <key>URL</key>
        <string>{$scheme}://{$host}/receive.php</string>
        <key>DeviceAttributes</key>
        <array>
            <string>UDID</string>
            <string>PRODUCT</string>
            <string>VERSION</string>
            <string>SERIAL</string>
        </array>
    </dict>
    <key>PayloadOrganization</key>
    <string>UDID Collector</string>
    <key>PayloadDisplayName</key>
    <string>UDID 확인</string>
    <key>PayloadDescription</key>
    <string>기기 정보 확인 후 자동 삭제됩니다.</string>
    <key>PayloadVersion</key>
    <integer>1</integer>
    <key>PayloadUUID</key>
    <string>{$uuid}</string>
    <key>PayloadIdentifier</key>
    <string>io.udid.collector.{$uuid}</string>
    <key>PayloadType</key>
    <string>Profile Service</string>
</dict>
</plist>
XML;
    
    header('Content-Type: application/x-apple-aspen-config');
    header('Content-Disposition: attachment; filename="udid.mobileconfig"');
    echo $mobileconfig;
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDID 확인</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f5f5f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 { font-size: 24px; margin-bottom: 16px; color: #1d1d1f; }
        p { color: #86868b; margin-bottom: 30px; line-height: 1.5; }
        .btn {
            display: inline-block;
            background: #007aff;
            color: white;
            padding: 16px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 600;
        }
        .btn:hover { background: #0056b3; }
        .steps {
            margin-top: 30px;
            text-align: left;
            background: #f5f5f7;
            padding: 20px;
            border-radius: 12px;
        }
        .steps h3 { font-size: 14px; color: #1d1d1f; margin-bottom: 12px; }
        .steps ol { color: #86868b; font-size: 14px; padding-left: 20px; }
        .steps li { margin-bottom: 8px; }
        .warning { margin-top: 20px; font-size: 12px; color: #ff3b30; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📱 UDID 확인</h1>
        <p>iPhone/iPad UDID를 확인합니다.<br>Safari에서만 작동합니다.</p>
        <a href="?download=1" class="btn">UDID 확인하기</a>
        <div class="steps">
            <h3>진행 순서</h3>
            <ol>
                <li>위 버튼 탭</li>
                <li>"허용" 선택</li>
                <li>설정 앱 → 프로파일 다운로드됨 → 설치</li>
                <li>"서명되지 않음" 경고 → 설치</li>
                <li>UDID 복사해서 전달</li>
            </ol>
        </div>
        <p class="warning">⚠️ 반드시 Safari로 접속하세요</p>
    </div>
</body>
</html>
