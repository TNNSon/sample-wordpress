<?php
/* Template Name: Custom Portal Layout */
get_header(); ?>

<div class="container">
  <!-- Header Section -->
  <header class="section header">
    <h1><?php bloginfo('name'); ?></h1>
  </header>

  <!-- Section 1 -->
  <div class="section section-1">
    <div class="sidebar"><?php _e('基本情報', 'your-theme-text-domain'); ?></div>
    <div class="button-grid">
      <a href="<?php echo esc_url(home_url()); ?>" class="button">
        <img src="https://img.icons8.com/fluency/48/000000/corporate.png" alt="Corporate Vision Icon" class="icon" />
        Corporate Vision
        <!-- <?php _e('Corporate Vision', 'your-theme-text-domain'); ?> -->
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img src="https://img.icons8.com/fluency/48/000000/organization.png" alt="TEP Group Actions Icon" class="icon" />
        TEP Group Actions
        <!-- <?php _e('TEP Group Actions', 'your-theme-text-domain'); ?> -->
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img src="https://img.icons8.com/fluency/48/000000/globe.png" alt="SD Goals Icon" class="icon" />
        Sustainable Development Goals
        <!-- <?php _e('Sustainable Development Goals', 'your-theme-text-domain'); ?> -->
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img src="https://img.icons8.com/fluency/48/000000/virus.png" alt="COVID-19 Info Icon" class="icon" />
        COVID-19 Info
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img
          src="https://img.icons8.com/fluency/48/000000/news.png"
          alt="TEP News Icon"
          class="icon" />
        TEP News
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img
          src="https://img.icons8.com/fluency/48/000000/go.png"
          alt="NEXTEP 30 Icon"
          class="icon" />
        NEXTEP 30
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img
          src="https://img.icons8.com/fluency/48/000000/family.png"
          alt="Ichigan 2024 Icon"
          class="icon" />
        Ichigan 2024
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img
          src="https://img.icons8.com/fluency/48/000000/document.png"
          alt="Company Policy Icon"
          class="icon" />
        Company Policy
      </a>
      <a href="<?php echo esc_url(home_url('')); ?>" class="button">
        <img
          src="https://img.icons8.com/fluency/48/000000/goal.png"
          alt="Other Goal Icon"
          class="icon" />
        Other Goals
      </a>
      <!-- Add more buttons similarly with dynamic links and text as necessary -->
    </div>
  </div>

  <!-- Section 2 -->
  <div class="section section-2">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="section-2-item">
      <img src="https://img.icons8.com/fluency/48/000000/first-aid-kit.png" alt="Safety Icon" />
      <?php _e('Safety & Health', 'your-theme-text-domain'); ?>
    </a>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="section-2-item">
      <img src="https://img.icons8.com/fluency/48/000000/calendar.png" alt="Schedule Icon" />
      <?php _e('Monthly Schedule', 'your-theme-text-domain'); ?>
    </a>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="section-2-item">
      <img
        src="https://img.icons8.com/fluency/48/000000/phone.png"
        alt="Phone Directory Icon"
      />
      Phone Directory
    </a>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="section-2-item">
      <img
        src="https://img.icons8.com/fluency/48/000000/advice.png"
        alt="Consultation Icon"
      />
      Consultation Services
    </a>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="section-2-item">
      <img
        src="https://img.icons8.com/fluency/48/000000/table.png"
        alt="Salary Table Icon"
      />
      Salary Table
    </a>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="section-2-item">
      <img
        src="https://img.icons8.com/fluency/48/000000/family.png"
        alt="Welfare Icon"
      />
      Welfare Program
    </a>
    <!-- Add more links and items dynamically as required -->
  </div>

  <!-- Section 3 -->
  <div class="section section-3">
    <div class="section-3-title"><?php _e('各種業務システム', 'your-theme-text-domain'); ?></div>
    <div class="section-3-grid">
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img src="https://img.icons8.com/fluency/48/000000/check.png" alt="Icon" class="icon" />
          <?php _e('Decision & Application', 'your-theme-text-domain'); ?>
        </div>
        <div class="section-3-item-go"><?php _e('GO', 'your-theme-text-domain'); ?></div>
      </div>
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img
            src="https://img.icons8.com/fluency/48/000000/work.png"
            alt="Icon"
            class="icon"
          />
          HR & Labor
        </div>
        <div class="section-3-item-go">GO</div>
      </div>
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img
            src="https://img.icons8.com/fluency/48/000000/invoice.png"
            alt="Icon"
            class="icon"
          />
          Invoice Submission
        </div>
        <div class="section-3-item-go">GO</div>
      </div>
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img
            src="https://img.icons8.com/fluency/48/000000/sell.png"
            alt="Icon"
            class="icon"
          />
          OBIC Sales Management
        </div>
        <div class="section-3-item-go">GO</div>
      </div>
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img
            src="https://img.icons8.com/fluency/48/000000/email.png"
            alt="Icon"
            class="icon"
          />
          Mail & Schedule
        </div>
        <div class="section-3-item-go">GO</div>
      </div>
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img
            src="https://img.icons8.com/fluency/48/000000/book.png"
            alt="Icon"
            class="icon"
          />
          Accounting & Budget Management
        </div>
        <div class="section-3-item-go">GO</div>
      </div>
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img
            src="https://img.icons8.com/fluency/48/000000/cloud.png"
            alt="Icon"
            class="icon"
          />
          Electronic Data Storage
        </div>
        <div class="section-3-item-go">GO</div>
      </div>
      <div class="section-3-item">
        <div class="section-3-item-text">
          <img
            src="https://img.icons8.com/fluency/48/000000/shopping-cart.png"
            alt="Icon"
            class="icon"
          />
          Office Supplies Purchase
        </div>
        <div class="section-3-item-go">GO</div>
      </div>
      <!-- Repeat items as needed -->
    </div>
  </div>

  <!-- Section 4 -->
  <div class="section section-4">
    <div class="section-4-title">
      <?php _e('会社からのお知らせ', 'your-theme-text-domain'); ?>
      <a href="<?php echo esc_url(home_url('/news')); ?>"><?php _e('一覧表示', 'your-theme-text-domain'); ?></a>
    </div>
    <div class="section-4-content">
      <p><?php _e('AI-OCRシステムで手書き書類をデータ化', 'your-theme-text-domain'); ?></p>
    </div>
    <div class="section-4-scrollable">
      <div class="section-4-item">
        【ご案内】本社営業本部 11-12月イベント
        <span class="section-4-item-date">11/05</span>
      </div>
      <div class="section-4-item">
        【お知らせ】月別スケジュールを更新しました
        <span class="section-4-item-date">11/01</span>
      </div>
      <div class="section-4-item">
        在宅勤務補助手当の適用開始
        <span class="section-4-item-date">11/01</span>
      </div>
      <!-- Additional items as necessary -->
    </div>
  </div>

  <!-- Section 5 and 6 container -->
  <div class="section section-5and6">
    <!-- Section 5 -->
    <div class="section-5">
      <div class="section-5-title"><?php _e('申請書・マニュアル等', 'your-theme-text-domain'); ?></div>
      <div class="section-5-grid">
      <a href="<?php echo esc_url(home_url('/content')); ?>" class="section-5-item">
      <img src="https://img.icons8.com/fluency/48/000000/document.png" alt="Icon" class="icon" />
      <div class="section-5-item-text"><?php _e('申請書・マニュアル', 'your-theme-text-domain'); ?></div>
    </a>
        <div class="section-5-item">
          <img
            src="https://img.icons8.com/fluency/48/000000/handshake.png"
            alt="Icon"
            class="icon"
          />
          <div class="section-5-item-text">営業サポート</div>
        </div>
        <div class="section-5-item">
          <img
            src="https://img.icons8.com/fluency/48/000000/security-checked.png"
            alt="Icon"
            class="icon"
          />
          <div class="section-5-item-text">コンプライアンス</div>
        </div>
        <div class="section-5-item">
          <img
            src="https://img.icons8.com/fluency/48/000000/investment.png"
            alt="Icon"
            class="icon"
          />
          <div class="section-5-item-text">資産形成</div>
        </div>
        <div class="section-5-item">
          <img
            src="https://img.icons8.com/fluency/48/000000/technical-support.png"
            alt="Icon"
            class="icon"
          />
          <div class="section-5-item-text">ITサポート</div>
        </div>
        <div class="section-5-item">
          <img
            src="https://img.icons8.com/fluency/48/000000/automation.png"
            alt="Icon"
            class="icon"
          />
          <div class="section-5-item-text">RPA</div>
        </div>
        <!-- Repeat items dynamically if needed -->
      </div>
    </div>

    <!-- Section 6 -->
    <div class="section-6">
      <div class="section-6-link">
        <div class="section-6-link-title"><?php _e('採用・募集関連', 'your-theme-text-domain'); ?></div>
        <ul class="section-6-link-content">
          <li>求人募集情報・募集マニュアル</li>
          <li>HP求人掲載方法など</li>
        </ul>
      </div>
      <div class="section-6-link">
        <div class="section-6-link-title">社内問い合わせポータル</div>
        <ul class="section-6-link-content">
          <li>人事労務・安全衛生・資産管理</li>
          <li>経費清算・旅行管理・調達・発注</li>
          <li>事業管理ライン別・情報システム</li>
        </ul>
      </div>
      <!-- Additional links as necessary -->
    </div>
  </div>

  <!-- Section 7 -->
  <div class="section section-7">
    <div class="section-sidebar"><?php _e('関連外部', 'your-theme-text-domain'); ?></div>
    <div class="section-grid">
      <div class="section-item">
        <img src="https://via.placeholder.com/70x50?text=Company+1" alt="Company 1" />
      </div>
      <!-- Additional items as needed -->
    </div>
  </div>

  <!-- Section 8 -->
  <div class="section section-8">
    <div class="section-sidebar"><?php _e('一覧はこちら', 'your-theme-text-domain'); ?></div>
    <div class="section-grid">
      <div class="section-item section-8-button"><?php _e('no content', 'your-theme-text-domain'); ?></div>
    </div>
  </div>
</div>

<?php get_footer(); ?>