<?php
/**
 * Template part for displaying price section
 */

// 料金ページのURLを取得
$price_page = get_page_by_path('price');
$price_url = $price_page ? get_permalink($price_page->ID) : home_url('?page_id=3');

// 自動切り替え判定（令和8年4月1日 = 20260401）
$today = current_time('Ymd');
$switch_date = '20260401';
$is_new_season = ($today >= $switch_date);

/**
 * 料金カードを出力するサブ関数
 */
function render_price_card($plan_id, $title, $sub, $price, $unit, $descriptions, $price_url, $anchor) {
    ?>
    <div class="price-card" id="<?php echo esc_attr($plan_id); ?>">
        <div class="price-card-header">
            <div class="price-card-title"><?php echo esc_html($title); ?></div>
            <div class="price-card-sub"><?php echo esc_html($sub); ?></div>
        </div>
        <div class="price-card-main">
            <div class="price-card-price-row">
                <span class="price-card-price"><?php echo esc_html($price); ?></span>
                <span class="price-card-unit"><?php echo esc_html($unit); ?></span>
            </div>
            <div class="price-card-tax">消費税込み</div>
        </div>
        <div class="price-card-body">
            <?php foreach ($descriptions as $desc) : ?>
                <div class="price-card-desc <?php echo ($desc === '　') ? 'price-card-desc--slash' : ''; ?>">
                    <?php echo esc_html($desc); ?>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="price-card-btn" href="<?php echo is_front_page() ? esc_url($price_url . $anchor) : esc_attr($anchor); ?>">詳しくはこちら</a>
    </div>
    <?php
}
?>

<section class="toppage-price">
    <div class="price-inner">

        <?php if (!$is_new_season) : ?>
            <!-- 令和8年3月31日まで -->
            <div class="price-season-block">
                <p class="price-season-heading">＼令和8年3/31までの料金となります／</p>
                <div class="price-title-area">
                    <h2 class="price-title">料金について</h2>
                </div>
                <div class="price-cards">
                    <?php 
                    render_price_card('planA', 'カセ・筏釣り', '1名様～', '～¥4,000', '/ 1人', 
                        ['チヌ・季節に応じて青物・アオリイカなど', '1名様から出船します', '女性・子ども（中学生まで）は半額となります', '釣り時間はお知らせをご確認ください'], 
                        $price_url, '#planA-detail');
                    
                    render_price_card('planB', '近海チャーター船', '2名様～', '～¥12,000', '/ 1人', 
                        ['ルアー五目便', '2名様から出船します', 'スタンプカード・人数によって割引がございます', '6時間程度'], 
                        $price_url, '#planB-detail');

                    render_price_card('planC', '湾内チャーター船', '1名様 ～', '¥15,000', '/ 1隻', 
                        ['ルアー五目便', '3名程度まで乗船可能です', '　', '5時間程度'], 
                        $price_url, '#planC-detail');
                    ?>
                </div>
            </div>

            <!-- 下矢印演出 -->
            <div class="price-season-arrow">
                <svg width="40" height="24" viewBox="0 0 40 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 24L0 0H40L20 24Z" fill="#78B96C"/>
                </svg>
            </div>
        <?php endif; ?>

        <!-- 令和8年4月1日より（新料金ブロック） -->
        <div class="price-season-block price-season-block--new">
            <?php if (!$is_new_season) : ?>
                <p class="price-season-heading">＼令和8年4/1からの料金となります／</p>
            <?php endif; ?>
            <div class="price-title-area">
                <h2 class="price-title">料金について</h2>
            </div>
            <div class="price-cards">
                <?php 
                render_price_card('planA-new', 'カセ・筏釣り', '1名様～', '～¥4,500', '/ 1人', 
                    ['チヌ・季節に応じて青物・アオリイカなど', '1名様から出船します', '女性・子ども（中学生まで）は2000円OFFとなります', '釣り時間はお知らせをご確認ください'], 
                    $price_url, '#planA-detail');
                
                render_price_card('planB-new', '近海チャーター船', '2名様～', '～¥12,000', '/ 1人', 
                    ['ルアー五目便', '2名様から出船します', 'スタンプカード・人数によって割引がございます', '6時間程度'], 
                    $price_url, '#planB-detail');

                render_price_card('planC-new', '湾内チャーター船', '1名様 ～', '¥15,000', '/ 1隻', 
                    ['ルアー五目、アジ泳がせ便', '3名程度まで乗船可能です', '※アジ料金は別途必要、4名乗船時は16000円頂戴します', '5時間程度'], 
                    $price_url, '#planC-detail');
                ?>
            </div>
        </div>

    </div>
</section>
