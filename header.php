<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/toppage-custom.css">
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div class="site-inner">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentysixteen' ); ?></a>

		<!-- 追加: ヘッダー用カスタムCSSの読み込み -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/header-custom.css">

		<header id="masthead" class="site-header" role="banner" style="padding:0;margin:0;">
			<div class="header-custom-bar">
				<img class="header-custom-logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="ロゴ" />
				<div class="header-custom-ic">賀田ICから約5分</div>
				<nav class="header-custom-nav">
					<a href="/" class="active">トップページ</a>
					<a href="#">釣果一覧</a>
					<a href="#">料金について</a>
					<a href="#">アクセス</a>
					<a href="#">船長紹介</a>
					<a href="#">きょうの日記</a>
				</nav>
				<div class="header-custom-telarea">
					<span class="header-custom-telicon">
						<svg width="40" height="40" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_13_52)">
								<path d="M47.9782 44.6807L43.6292 40.3318C42.8422 39.5452 41.8563 38.9869 40.7769 38.7166C39.6974 38.4462 38.5648 38.4739 37.4999 38.7967C36.4349 39.1195 35.4776 39.7253 34.7299 40.5495C33.9822 41.3736 33.4723 42.3853 33.2545 43.4765C26.0829 42.1356 19.108 35.1894 18.6738 28.9809C19.893 28.7566 21.0151 28.1665 21.8908 27.2891C23.0437 26.136 23.6915 24.5721 23.6915 22.9415C23.6915 21.3109 23.0437 19.747 21.8908 18.5939L17.5431 14.2451C16.3899 13.0922 14.826 12.4445 13.1954 12.4445C11.5647 12.4445 10.0008 13.0922 8.84767 14.2451C-4.19665 27.2891 34.9338 66.4186 47.9782 53.3746C49.1305 52.2214 49.7777 50.6578 49.7777 49.0276C49.7777 47.3974 49.1305 45.8339 47.9782 44.6807Z" fill="white"/>
							</g>
							<defs>
								<clipPath id="clip0_13_52">
									<rect width="56" height="56" fill="white"/>
								</clipPath>
							</defs>
						</svg>
					</span>
					<div class="header-custom-telnums">
						<div>090-1417-9322（村田丈幸）</div>
						<div>080-2628-2183（村田京）</div>
					</div>
				</div>
			</div>
		</header>

		<div id="content" class="site-content">
