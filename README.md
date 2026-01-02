# iOS UDID Collector (Render)

원격지 iPhone/iPad의 UDID를 수집하는 서비스입니다.

## 특징

- ✅ 무료 (카드 등록 불필요)
- ✅ 폰에서 배포 가능
- ✅ 데이터 저장 안 함
- ✅ HTTPS 자동

---

## 배포 방법 (폰에서 가능)

### 1단계: GitHub에 코드 올리기

1. GitHub 접속 (앱 또는 웹)
2. 새 Repository 생성
   - Repository name: `udid-collector`
   - Public 선택
   - Create repository

3. 파일 업로드
   - "Add file" → "Upload files"
   - 아래 파일들을 모두 업로드:
     ```
     Dockerfile
     render.yaml
     public/index.php
     public/receive.php
     public/result.php
     ```
   - "Commit changes"

### 2단계: Render 가입

1. https://render.com 접속
2. "Get Started" 클릭
3. "GitHub" 로 로그인

### 3단계: 배포

1. Dashboard에서 "New" → "Web Service"
2. "Build and deploy from a Git repository" 선택
3. GitHub repo 연결 허용
4. `udid-collector` 저장소 선택
5. 설정:
   - Name: 원하는 이름 (URL이 됨)
   - Region: Singapore (한국에서 가장 가까움)
   - Instance Type: **Free** 선택
6. "Create Web Service" 클릭

### 4단계: 완료

배포 완료되면 URL 생성됨:
```
https://원하는이름.onrender.com
```

이 URL을 원격 사용자에게 전달하면 됩니다.

---

## 사용법

1. 원격 사용자에게 URL 전송
2. 사용자가 iPhone Safari로 접속
3. 안내에 따라 진행
4. UDID 복사해서 전달받음

### 사용자 안내 문구 예시

```
iPhone 정보 확인 부탁드립니다.

1. 아래 링크를 Safari로 접속
   https://원하는이름.onrender.com

2. "UDID 확인하기" 버튼 탭
3. "허용" 선택
4. 설정 앱 → 상단 "프로파일 다운로드됨" → 설치
5. "서명되지 않음" 경고는 무시하고 설치
6. 화면에 나온 UDID 복사해서 보내주세요

※ 기기에 아무것도 남지 않습니다.
```

---

## 참고사항

### 슬립 모드
- 15분 미사용시 서버가 슬립됨
- 다시 접속하면 30초 후 자동으로 깨어남
- 비용 영향 없음

### 비용
- 완전 무료
- 카드 등록 불필요

### 보안
- UDID 등 기기 정보는 서버에 저장되지 않음
- URL 파라미터로 전달 → 화면 표시 → 끝

---

## 파일 구조

```
udid-collector/
├── Dockerfile
├── render.yaml
└── public/
    ├── index.php      # 메인 페이지
    ├── receive.php    # iOS 콜백 처리
    └── result.php     # 결과 표시
```
