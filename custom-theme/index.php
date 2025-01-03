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

    /* Flexbox Layout for IE Support */
    .container {
      display: flex; /* Use Flexbox for layout */
      flex-wrap: wrap; /* Allow wrapping */
      margin: -10px; /* Negative margin for consistent spacing */
    }

    .header {
      width: 100%;
      background-color: #0076c8;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 1.8em;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .section {
      background: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin: 10px; /* Adjust spacing */
      flex: 1 1 calc(33.333% - 20px); /* Responsive columns */
    }

    /* Sidebar Styling */
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
      height: 100%; /* Full height */
    }

    /* Button Grid and Items */
    .button-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
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

    /* Section Grids */
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

    /* bxSlider Styling */
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
    <!-- Header -->
    <div class="header">Portal Dashboard</div>

    <!-- Section 1 -->
    <div class="section section-1">
      <div class="sidebar">Menu</div>
      <div class="button-grid">
        <div class="button">Button 1</div>
        <div class="button">Button 2</div>
        <div class="button">Button 3</div>
        <div class="button">Button 4</div>
        <div class="button">Button 5</div>
        <div class="button">Button 6</div>
      </div>
    </div>

    <!-- Section 2 -->
    <div class="section section-2">
      <p>Content for Section 2</p>
    </div>

    <!-- Section 3 -->
    <div class="section section-3">
      <div class="section-title">Section 3 Title</div>
      <div class="section-grid">
        <div class="section-item">
          <img src="https://via.placeholder.com/40" alt="Icon" />
          <span>Item 1</span>
          <span class="highlight">New</span>
        </div>
        <div class="section-item">
          <img src="https://via.placeholder.com/40" alt="Icon" />
          <span>Item 2</span>
        </div>
        <div class="section-item">
          <img src="https://via.placeholder.com/40" alt="Icon" />
          <span>Item 3</span>
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
      <p>Content for Section 5</p>
    </div>

    <!-- Section 7 -->
    <div class="section section-7">
      <div class="sidebar">External</div>
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
