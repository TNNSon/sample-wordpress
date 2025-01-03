<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Portal UI</title>
  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 20px;
    }

    .container {
      display: grid;
      grid-template-areas:
        "header header header"
        "section-1 section-2 section-2"
        "section-3 section-3 section-3"
        "section-4 section-4 section-5"
        "section-6 section-6 section-7";
      gap: 20px;
    }

    .header {
      grid-area: header;
      background-color: #0076c8;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 1.8em;
      font-weight: bold;
      border: 1px solid red; /* Label: Header Notification */
    }

    .section {
      background: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border: 1px solid red; /* Section Labels */
    }

    .section-1 {
      grid-area: section-1;
      display: flex;
    }

    .section-2 {
      grid-area: section-2;
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .section-3 {
      grid-area: section-3;
    }

    .section-4 {
      grid-area: section-4;
    }

    .section-5 {
      grid-area: section-5;
    }

    .section-6 {
      grid-area: section-6;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .section-7 {
      grid-area: section-7;
      display: flex;
      gap: 15px;
    }

    .sidebar {
      background-color: #0076c8;
      color: white;
      text-align: center;
      padding: 20px;
      font-weight: bold;
      flex: 0 0 80px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 5px;
    }

    .button-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      flex-grow: 1;
    }

    .button {
      flex: 1 1 calc(33.333% - 10px);
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 5px;
      text-align: center;
      padding: 15px;
      font-weight: bold;
      font-size: 0.9em;
      color: #0076c8;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .button:hover {
      background-color: #e0f0ff;
    }

    .section-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
    }

    .section-item {
      flex: 1 1 calc(33.333% - 15px);
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.9em;
    }

    .section-item img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .section-item .highlight {
      background-color: #ffeb3b;
      color: #000;
      padding: 2px 5px;
      font-weight: bold;
      border-radius: 3px;
      font-size: 0.8em;
    }

    .bxslider-container {
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .bxslider {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      gap: 10px;
    }

    .bxslider img {
      width: 190px;
      height: 63px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Header Notification -->
    <div class="header">Header Notification</div>

    <!-- Section 1 -->
    <div class="section section-1">
      <div class="sidebar">基本情報</div>
      <div class="button-grid">
        <div class="button">企業理念</div>
        <div class="button">TEPグループ</div>
        <div class="button">会社概要</div>
        <div class="button">沿革</div>
        <div class="button">事業紹介</div>
        <div class="button">所在地</div>
      </div>
    </div>

    <!-- Section 2 -->
    <div class="section section-2">
      <div class="button-grid">
        <div class="button">安全衛生</div>
        <div class="button">月別スケジュール</div>
        <div class="button">電話番号一覧</div>
        <div class="button">各種相談窓口</div>
        <div class="button">職制表</div>
        <div class="button">福利厚生</div>
      </div>
    </div>

    <!-- Section 3 -->
    <div class="section section-3">
      <div class="section-title">各種業務システム</div>
      <div class="section-grid">
        <div class="section-item">
          <img src="https://via.placeholder.com/40" alt="Icon" />
          <span>WEB明細</span>
        </div>
        <div class="section-item">
          <img src="https://via.placeholder.com/40" alt="Icon" />
          <span>メール・スケジュール</span>
        </div>
        <div class="section-item">
          <img src="https://via.placeholder.com/40" alt="Icon" />
          <span>人事・労務</span>
        </div>
      </div>
    </div>

    <!-- Section 4 -->
    <div class="section section-4">
      <div class="bxslider-container">
        <ul class="bxslider">
          <li><img src="https://via.placeholder.com/190x63?text=Logo+1" alt="Logo 1" /></li>
          <li><img src="https://via.placeholder.com/190x63?text=Logo+2" alt="Logo 2" /></li>
          <li><img src="https://via.placeholder.com/190x63?text=Logo+3" alt="Logo 3" /></li>
        </ul>
      </div>
    </div>

    <!-- Section 5 -->
    <div class="section section-5">
      <p>申請書・マニュアル等</p>
      <div class="button-grid">
        <div class="button">申請書・マニュアル</div>
        <div class="button">営業サポート</div>
        <div class="button">ITサポート</div>
        <div class="button">資産形成</div>
        <div class="button">コンプライアンス</div>
      </div>
    </div>

    <!-- Section 6 -->
    <div class="section section-6">
      <div>関連外部</div>
      <div class="grid">
        <div class="item"><img src="https://via.placeholder.com/190" alt="Item 1" /></div>
        <div class="item"><img src="https://via.placeholder.com/190" alt="Item 2" /></div>
        <div class="item"><img src="https://via.placeholder.com/190" alt="Item 3" /></div>
      </div>
    </div>

    <!-- Section 7 -->
    <div class="section section-7">
      <div class="sidebar">関連外部</div>
      <div class="grid">
        <div class="item"><img src="https://via.placeholder.com/190" alt="Item 1" /></div>
        <div class="item"><img src="https://via.placeholder.com/190" alt="Item 2" /></div>
        <div class="item"><img src="https://via.placeholder.com/190" alt="Item 3" /></div>
      </div>
      <div class="sidebar">Help</div>
    </div>
  </div>
</body>
</html>
