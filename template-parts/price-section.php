<?php
/**
 * Template part for displaying price section
 */

// 料金ページのURLを取得（トップページからの遷移用）
$price_page = get_page_by_path('price');
$price_url = $price_page ? get_permalink($price_page->ID) : home_url('?page_id=3');
?>

<section class="toppage-price">
    <div class="price-inner">
        <div class="price-title-area">
            <h2 class="price-title">料金について</h2>
        </div>
        <div class="price-cards">
            <!-- カセ・筏釣り -->
            <div class="price-card" id="planA">
                <div class="price-card-header price-card-header--kase">
                    <div class="price-card-title">カセ・筏釣り</div>
                    <div class="price-card-sub">1名様～</div>
                </div>
                <div class="price-card-main">
                    <div>
                        <div class="price-card-price">～¥4,000</div>
                        <div class="price-card-unit">/ １人</div>
                    </div>
                    <div class="price-card-tax">消費税込み</div>
                </div>
                <div class="price-card-desc">チヌ・季節に応じて青物・アオリイカなど</div>
                <div class="price-card-desc">1名様から出船します</div>
                <div class="price-card-desc">女性・子ども（中学生まで）は半額となります</div>
                <div class="price-card-desc">釣り時間はお知らせをご確認ください</div>
                <?php if (is_front_page()) : ?>
                    <a class="price-card-btn" href="<?php echo esc_url($price_url); ?>#planA-detail">詳しくはこちら</a>
                <?php else : ?>
                    <a class="price-card-btn" href="#planA-detail">詳しくはこちら</a>
                <?php endif; ?>
            </div>
            <!-- 近海チャーター船 -->
            <div class="price-card" id="planB">
                <div class="price-card-header price-card-header--charter">
                    <div class="price-card-title">近海チャーター船</div>
                    <div class="price-card-sub">2名様～</div>
                </div>
                <div class="price-card-main">
                    <div>
                        <div class="price-card-price">～¥12,000</div>
                        <div class="price-card-unit">/ １人</div>
                    </div>
                    <div class="price-card-tax">消費税込み</div>
                </div>
                <div class="price-card-desc">ルアー五目便</div>
                <div class="price-card-desc">2名様から出船します</div>
                <div class="price-card-desc">スタンプカード・人数によって割引がございます</div>
                <div class="price-card-desc">6時間程度</div>
                <?php if (is_front_page()) : ?>
                    <a class="price-card-btn" href="<?php echo esc_url($price_url); ?>#planB-detail">詳しくはこちら</a>
                <?php else : ?>
                    <a class="price-card-btn" href="#planB-detail">詳しくはこちら</a>
                <?php endif; ?>
            </div>
            <!-- 湾内チャーター船 -->
            <div class="price-card" id="planC">
                <div class="price-card-header price-card-header--bay">
                    <div class="price-card-title">湾内チャーター船</div>
                    <div class="price-card-sub">1名様 ～</div>
                </div>
                <div class="price-card-main">
                    <div>
                        <div class="price-card-price">¥15,000</div>
                        <div class="price-card-unit">/ 1隻</div>
                    </div>
                    <div class="price-card-tax">消費税込み</div>
                </div>
                <div class="price-card-desc">ルアー五目便</div>
                <div class="price-card-desc">3名程度まで乗船可能です</div>
                <div class="price-card-desc price-card-desc--slash">　</div>
                <div class="price-card-desc">5時間程度</div>
                <?php if (is_front_page()) : ?>
                    <a class="price-card-btn" href="<?php echo esc_url($price_url); ?>#planC-detail">詳しくはこちら</a>
                <?php else : ?>
                    <a class="price-card-btn" href="#planC-detail">詳しくはこちら</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section> 