<?php
$udid = $_GET['udid'] ?? '';
$product = $_GET['product'] ?? '';
$version = $_GET['version'] ?? '';
$serial = $_GET['serial'] ?? '';

if (empty($udid)) {
    header('Location: /');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDID 확인 완료</title>
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
            max-width: 450px;
            width: 100%;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .success { text-align: center; margin-bottom: 30px; }
        .success-icon { font-size: 48px; margin-bottom: 16px; }
        h1 { font-size: 24px; color: #1d1d1f; }
        .info-group { margin-bottom: 20px; }
        .info-label {
            font-size: 12px;
            color: #86868b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .info-value {
            background: #f5f5f7;
            padding: 14px 16px;
            border-radius: 10px;
            font-family: 'SF Mono', Monaco, monospace;
            font-size: 14px;
            color: #1d1d1f;
            word-break: break-all;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }
        .info-value span { flex: 1; user-select: all; }
        .copy-btn {
            background: #007aff;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            white-space: nowrap;
        }
        .copy-btn:hover { background: #0056b3; }
        .copy-btn.copied { background: #34c759; }
        .notice {
            margin-top: 24px;
            padding: 16px;
            background: #d4edda;
            border-radius: 10px;
            font-size: 13px;
            color: #155724;
        }
        .home-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007aff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success">
            <div class="success-icon">✅</div>
            <h1>기기 정보 확인 완료</h1>
        </div>
        
        <div class="info-group">
            <div class="info-label">UDID</div>
            <div class="info-value">
                <span id="udid"><?= htmlspecialchars($udid) ?></span>
                <button class="copy-btn" onclick="copyText('udid', this)">복사</button>
            </div>
        </div>
        
        <?php if ($product): ?>
        <div class="info-group">
            <div class="info-label">모델</div>
            <div class="info-value">
                <span id="product"><?= htmlspecialchars($product) ?></span>
                <button class="copy-btn" onclick="copyText('product', this)">복사</button>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($version): ?>
        <div class="info-group">
            <div class="info-label">iOS 버전</div>
            <div class="info-value">
                <span id="version"><?= htmlspecialchars($version) ?></span>
                <button class="copy-btn" onclick="copyText('version', this)">복사</button>
            </div>
        </div>
        <?php endif; ?>
        
        <?php if ($serial): ?>
        <div class="info-group">
            <div class="info-label">시리얼</div>
            <div class="info-value">
                <span id="serial"><?= htmlspecialchars($serial) ?></span>
                <button class="copy-btn" onclick="copyText('serial', this)">복사</button>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="notice">
            ✅ 이 정보는 서버에 저장되지 않습니다.<br>
            UDID를 복사해서 전달해주세요.
        </div>
        
        <a href="/" class="home-link">← 처음으로</a>
    </div>
    
    <script>
    function copyText(id, btn) {
        const text = document.getElementById(id).textContent;
        navigator.clipboard.writeText(text).then(() => {
            btn.textContent = '완료!';
            btn.classList.add('copied');
            setTimeout(() => {
                btn.textContent = '복사';
                btn.classList.remove('copied');
            }, 2000);
        });
    }
    </script>
</body>
</html>
