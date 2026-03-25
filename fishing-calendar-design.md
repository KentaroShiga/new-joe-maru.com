# NewJoeMaru テーマ 釣果カレンダー機能 - 設計書

## 🎯 機能概要

NewJoeMaruテーマ（釣り船・渡船サイト）のトップページに釣果カレンダー機能を追加し、日付をクリックしてその日の釣果記事に直接アクセスできる機能を実装します。

## 📋 要件・仕様

### 基本要件
- トップページの「新着釣果」セクションの上に「カレンダーで釣果を確認」セクションを追加
- PC・モバイル両対応のレスポンシブカレンダー
- 日付をクリックするとその日の釣果記事ページに遷移
- 「新着釣果」セクションの見出しを「最新の釣果」に変更

### 現在のサイト構造（調査結果）
```
NewJoeMaru/
├── index.php (トップページ、釣果投稿type=post)
├── archive-diary.php (日記アーカイブ)
├── single-diary.php (日記単一ページ)
├── taxonomy-fish_species.php (魚種別アーカイブ)
├── functions.php (テーマ機能)
├── css/ (スタイルシート群)
├── js/ (JavaScript群)
└── images/ (画像リソース)
```

### 投稿タイプ構造
- **post** : 釣果投稿（メインコンテンツ）
- **diary** : 船長の日記投稿
- **news** : お知らせ投稿
- **fish_species** : 魚種タクソノミー

## 🎨 UI設計

### カレンダーセクション構成
```
┌─────────────────────────────────────────────────┐
│            カレンダーで釣果を確認                 │
├─────────────────────────────────────────────────┤
│  ◀ 2025年 1月 ▶                                │
│                                               │
│  日  月  火  水  木  金  土                    │
│           1   2   3   4                      │
│  5   6   7   8   9  10  11                   │
│ 12  13  14  15  16  17  18                   │
│ 19  20  21  22  23  24  25                   │
│ 26  27  28  29  30  31                       │
│                                               │
│  ● = 釣果記事あり    ○ = 釣果記事なし          │
└─────────────────────────────────────────────────┘
```

### レスポンシブ対応
```css
/* PC版 (768px以上) */
.calendar-container {
  max-width: 800px;
  padding: 40px 20px;
}

/* モバイル版 (767px以下) */
.calendar-container {
  padding: 20px 15px;
  font-size: 14px;
}
```

## 🔧 技術仕様

### 必要なファイル構成
```
NewJoeMaru/
├── functions.php (カレンダー関数追加)
├── css/
│   └── calendar-custom.css (新規作成)
├── js/
│   └── calendar-navigation.js (新規作成)
└── index.php (カレンダーセクション追加)
```

### データ取得仕様
```php
// 指定月の釣果投稿データ取得
function get_fishing_calendar_data($year, $month) {
    $posts_by_date = array();
    
    $query = new WP_Query(array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'date_query' => array(
            array(
                'year' => $year,
                'month' => $month
            )
        ),
        'orderby' => 'date',
        'order' => 'ASC'
    ));
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $date = get_the_date('j'); // 日付のみ
            $posts_by_date[$date] = array(
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'url' => get_permalink()
            );
        }
        wp_reset_postdata();
    }
    
    return $posts_by_date;
}
```

### カレンダー表示関数
```php
function display_fishing_calendar($year = null, $month = null) {
    if (!$year) $year = date('Y');
    if (!$month) $month = date('n');
    
    $posts_data = get_fishing_calendar_data($year, $month);
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $first_day_of_week = date('w', mktime(0, 0, 0, $month, 1, $year));
    
    // カレンダーHTML生成
    // ...
}
```

## 🎨 スタイル設計

### カラーパレット（NewJoeMaruブランド準拠）
```css
:root {
  --fishing-primary: #2e8b8b;     /* 海の青緑 */
  --fishing-secondary: #ffd700;   /* 魚のゴールド */
  --fishing-text: #333333;        /* テキスト */
  --fishing-border: #ddd;         /* ボーダー */
  --fishing-bg: #f8f9fa;         /* 背景 */
  --fishing-hover: #4a9d9d;      /* ホバー色 */
}
```

### カレンダースタイル
```css
.fishing-calendar-section {
  background: var(--fishing-bg);
  padding: 40px 20px;
  text-align: center;
}

.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 2px;
  max-width: 600px;
  margin: 0 auto;
}

.calendar-day {
  width: 40px;
  height: 40px;
  border: 1px solid var(--fishing-border);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
}

.calendar-day.has-posts {
  background: var(--fishing-primary);
  color: white;
  font-weight: bold;
}

.calendar-day.has-posts:hover {
  background: var(--fishing-hover);
  transform: scale(1.1);
}
```

## ⚡ パフォーマンス考慮

### 最適化方針
- 月単位でのクエリ最適化（1ヶ月分のみ取得）
- 日付別投稿データをPHPで事前処理
- JavaScriptでのDOM操作を最小限に抑制
- CSSアニメーションでUX向上

### キャッシュ戦略
```php
// 将来的な拡張：月別データキャッシュ
function get_cached_calendar_data($year, $month) {
    $cache_key = "calendar_data_{$year}_{$month}";
    $cached_data = wp_cache_get($cache_key);
    
    if (false === $cached_data) {
        $cached_data = get_fishing_calendar_data($year, $month);
        wp_cache_set($cache_key, $cached_data, '', 3600); // 1時間キャッシュ
    }
    
    return $cached_data;
}
```

## 🚀 実装ステップ

### Phase 1: 基本構造 (45分)
1. CSS・JSファイル作成
2. functions.phpにカレンダー関数追加
3. index.phpに基本HTML構造実装

### Phase 2: カレンダー機能 (60分)
1. 月別釣果データ取得機能
2. カレンダーグリッド生成機能
3. 日付クリック時の遷移機能

### Phase 3: スタイリング (45分)
1. レスポンシブカレンダーCSS実装
2. NewJoeMaruブランドカラー適用
3. ホバーアニメーション追加

### Phase 4: 統合・調整 (30分)
1. 「新着釣果」→「最新の釣果」見出し変更
2. セクション順序調整
3. 動作確認・微調整

## 📊 成功基準

### 必須機能
- ✅ カレンダーがトップページに正しく表示される
- ✅ 釣果投稿がある日付が視覚的に判別できる
- ✅ 日付クリックで該当日の釣果ページに遷移する
- ✅ 月送り・月戻しナビゲーションが機能する

### 品質基準
- ✅ PC・モバイル両対応のレスポンシブデザイン
- ✅ NewJoeMaruテーマとデザイン調和
- ✅ 表示速度が適切（3秒以内）
- ✅ エラーハンドリング実装済み

## 🔮 将来の拡張可能性

### 次のPhaseで追加予定
- 魚種別フィルタリング機能
- 月間釣果統計表示
- カレンダー上での釣果プレビュー
- 釣果投稿数表示（ヒートマップ形式）
- 印刷対応スタイル

---

**作成日**: 2025年10月6日  
**バージョン**: 1.0  
**対象サイト**: NewJoeMaru（丈丸渡船サイト）  
**開発者**: Claude Code