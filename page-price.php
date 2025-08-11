<?php
/*
Template Name: 料金
*/
get_header(); ?>

<div class="captain-bg">
    <div class="captain-container">
        <div class="captain-title-row">
            <span class="captain-title-main">PRICE</span>
        </div>
        <h1 class="captain-subtitle">料金について</h1>
        <div class="captain-main-row">
            <div class="captain-image-area">
                <img class="captain-image" 
src="<?php echo get_template_directory_uri(); ?>/images/price.webp" alt="料金案内">
                <div class="captain-message-vertical">PRICE</div>
            </div>
            <div class="captain-catch">安心の料金で、気軽に賀田湾で釣り体験を。</div>
            <div class="captain-greeting">
                丈丸渡船では、人数や釣りスタイルに応じたわかりやすい料金設定をご用意しています。
                乗合はしておりませんので、他のお客様を気にせずゆったりと釣りを楽しめるのも魅力のひとつ。
                初めての方も、常連の方も安心してご利用いただけます。
            </div>
        </div>
    </div>
</div>

<?php get_template_part('template-parts/price-section'); ?>
<?php get_template_part('template-parts/price-detail-section'); ?>


<?php get_footer(); ?>
