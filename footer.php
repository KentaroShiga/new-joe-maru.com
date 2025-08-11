<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package JOEMARU
 * @subpackage JOEMARU
 * @since JOEMARU 1.0
 */
?>

<footer class="footer" id="contact">
			<!-- アクセス・地図・紹介セクション -->
			<div class="toppage-access">
			<div class="access-title-area">
			<img src="<?php echo get_template_directory_uri(); ?>/images/lines.png" alt="bar" />
				<h3 class="access-title">賀田インターから約５分の丈丸渡船</h3>
				<img src="<?php echo get_template_directory_uri(); ?>/images/lines.png" alt="bar" />
			</div>
			<div class="access-desc">丈丸渡船では賀田湾内に設置した、１０m〜２８mまで、様々な水深のカセをご案内しております。チヌ、真鯛から、青物、ヒラメ、アオリイカなど、お客様のご要望に応じてご案内させていただきます。</div>
			<div class="access-map-area">
			<div class="access-map" id="footer-map">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5291.0072789545475!2d136.20333007711932!3d33.96596897318979!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x600678010e90ac39%3A0x2587f5260111125c!2z5LiI5Li45rih6Ii5!5e1!3m2!1sja!2sjp!4v1747218634048!5m2!1sja!2sjp&maptype=roadmap" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
				<div class="access-map-side">
					<div class="access-tel-btns">
						<a class="access-tel-btn" href="tel:090-1417-9322">
						<span class="access-tel-btn-desc">＼村田丈幸に電話／</span>
						<!-- <svg width="40" height="40" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_13_52)">
								<path d="M47.9782 44.6807L43.6292 40.3318C42.8422 39.5452 41.8563 38.9869 40.7769 38.7166C39.6974 38.4462 38.5648 38.4739 37.4999 38.7967C36.4349 39.1195 35.4776 39.7253 34.7299 40.5495C33.9822 41.3736 33.4723 42.3853 33.2545 43.4765C26.0829 42.1356 19.108 35.1894 18.6738 28.9809C19.893 28.7566 21.0151 28.1665 21.8908 27.2891C23.0437 26.136 23.6915 24.5721 23.6915 22.9415C23.6915 21.3109 23.0437 19.747 21.8908 18.5939L17.5431 14.2451C16.3899 13.0922 14.826 12.4445 13.1954 12.4445C11.5647 12.4445 10.0008 13.0922 8.84767 14.2451C-4.19665 27.2891 34.9338 66.4186 47.9782 53.3746C49.1305 52.2214 49.7777 50.6578 49.7777 49.0276C49.7777 47.3974 49.1305 45.8339 47.9782 44.6807Z" fill="white"/>
							</g>
							<defs>
								<clipPath id="clip0_13_52">
									<rect width="56" height="56" fill="white"/>
								</clipPath>
							</defs>
						</svg> -->
							<span class="access-tel-btn-label">090-1417-9322</span>
							
						</a>
						<a class="access-tel-btn" href="tel:080-2628-2183">
						<span class="access-tel-btn-desc">＼村田京に電話／</span>
							<span class="access-tel-btn-label">080-2628-2183</span>
							
						</a>
					</div>
				</div>
			</div>
		</div>
	<div class="footer-inner">
		<div class="footer-logo-area">
			<img class="footer-logo-img" src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png" alt="丈丸渡船ロゴ">
			<div class="ｃ">賀田ICから約5分</div>
		</div>
		<div class="footer-content">
			<div class="footer-col footer-col--info">
				<div class="footer-title">丈丸渡船</div>
				<div>船頭：村田丈幸<br>若船頭：村田京<br>〒519-3924 三重県尾鷲市曽根町149番地<br>090-1417-9322（村田丈幸） <br>080-2628-2183（村田京）</div>
				<div class="footer-rule-title">業務規程・規約</div>
				<ul class="footer-rule-list">
										<?php
					$pdf_url = joemaru_get_footer_pdf_url();
					$pdf_filename = joemaru_get_footer_pdf_filename();
					if ($pdf_url && $pdf_filename) {
						echo '<li><a href="' . esc_url($pdf_url) . '" download="' . esc_attr($pdf_filename) . '" target="_blank">・ダウンロードはコチラ</a></li>';
					} else {
						echo '<li><a href="' . get_template_directory_uri() . '/images/業務規程_6273.pdf" download="業務規程_6273.pdf" target="_blank">・ダウンロードはコチラ</a></li>';
					}
					?>
				</ul>
			</div>
			<div class="footer-col footer-col--menu">
				<ul class="footer-menu">
					<li><a href="<?php echo home_url('/'); ?>">トップページ</a></li>
					<li><a href="<?php echo home_url('?post_type=post'); ?>">釣果一覧</a></li>
					<?php
					$price_page = get_page_by_path('price');
					$price_url = $price_page ? get_permalink($price_page->ID) : home_url('?page_id=3');
					?>
					<li><a href="<?php echo esc_url($price_url); ?>">料金について</a></li>
				</ul>
			</div>
			<div class="footer-col footer-col--menu">
				<?php
				$access_page = get_page_by_path('access');
				$access_url = $access_page ? get_permalink($access_page->ID) : home_url('?page_id=2');
				$captain_page = get_page_by_path('captain');
				$captain_url = $captain_page ? get_permalink($captain_page->ID) : home_url('?page_id=4');
				?>
				<ul class="footer-menu">
					<li><a href="<?php echo esc_url($access_url); ?>">アクセス</a></li>
					<li><a href="<?php echo esc_url($captain_url); ?>">船長紹介</a></li>
					<li><a href="<?php echo home_url( '/diary/'); ?>">きょうの日記</a></li>
				</ul>
			</div>
		</div>
		<div class="footer-sns">
			<a href="https://www.instagram.com/joemaru_mrtk/?hl=ja" target="_blank" rel="noopener noreferrer" class="footer-social-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
					<path d="M24.1667 0H10.8333C4.85 0 0 4.85 0 10.8333V24.1667C0 30.15 4.85 35 10.8333 35H24.1667C30.15 35 35 30.15 35 24.1667V10.8333C35 4.85 30.15 0 24.1667 0ZM32.0833 24.1667C32.0833 28.95 28.95 32.0833 24.1667 32.0833H10.8333C6.05 32.0833 2.91667 28.95 2.91667 24.1667V10.8333C2.91667 6.05 6.05 2.91667 10.8333 2.91667H24.1667C28.95 2.91667 32.0833 6.05 32.0833 10.8333V24.1667Z" fill="#78B96C"/>
					<path d="M17.5 8.75C12.3917 8.75 8.25 12.8917 8.25 18C8.25 23.1083 12.3917 27.25 17.5 27.25C22.6083 27.25 26.75 23.1083 26.75 18C26.75 12.8917 22.6083 8.75 17.5 8.75ZM17.5 24.0833C14.0083 24.0833 11.1667 21.2417 11.1667 17.75C11.1667 14.2583 14.0083 11.4167 17.5 11.4167C20.9917 11.4167 23.8333 14.2583 23.8333 17.75C23.8333 21.2417 20.9917 24.0833 17.5 24.0833Z" fill="#78B96C"/>
					<path d="M26.25 8.16667C26.25 8.85833 25.6917 9.41667 25 9.41667C24.3083 9.41667 23.75 8.85833 23.75 8.16667C23.75 7.475 24.3083 6.91667 25 6.91667C25.6917 6.91667 26.25 7.475 26.25 8.16667Z" fill="#78B96C"/>
				</svg>
			</a>
			<a href="https://www.facebook.com/takeyuki.murata.3" target="_blank" rel="noopener noreferrer" class="footer-social-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35" fill="none">
					<path d="M34.5832 17.5003C34.5832 8.07033 26.9298 0.416992 17.4998 0.416992C8.06984 0.416992 0.416504 8.07033 0.416504 17.5003C0.416504 25.7687 6.29317 32.6532 14.0832 34.242V22.6253H10.6665V17.5003H14.0832V13.2295C14.0832 9.93241 16.7653 7.25033 20.0623 7.25033H24.3332V12.3753H20.9165C19.9769 12.3753 19.2082 13.1441 19.2082 14.0837V17.5003H24.3332V22.6253H19.2082V34.4982C27.8353 33.6441 34.5832 26.3666 34.5832 17.5003Z" fill="#78B96C"/>
				</svg>
			</a>
		</div></br>
	</div>
	<div class="footer-bar">
		丈丸渡船 Home Page since 2025 / Copyright 2025 丈丸渡船. All Rights Reserved / Powered by <a href="https://asakura-mie.com/" target="_blank" rel="noopener">ASAKURA Inc.</a>
	</div>
</footer>

		</div><!-- .site-content -->

		<!-- WordPressデフォルトフッターは非表示
		<footer id="colophon" class="site-footer" role="contentinfo" style="display: none;">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'joemaru' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'joemaru' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the joemaru footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					do_action( 'joemaru_credits' );
				?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'joemaru' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'joemaru' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>

<script>
// Googleマップで丈丸渡船を新しいタブで開く機能
function openMapInNewTab() {
  console.log('openMapInNewTab function called');
  
  // 丈丸渡船の情報
  const businessName = '丈丸渡船';
  const address = '三重県尾鷲市曽根町149番地';
  
  // GoogleマップのURLを生成（検索クエリ付き）
  const mapUrl = `https://www.google.com/maps/search/${encodeURIComponent(businessName + ' ' + address)}`;
  
  console.log('Opening Google Maps URL:', mapUrl);
  
  // 新しいタブでGoogleマップを開く
  window.open(mapUrl, '_blank', 'noopener,noreferrer');
}

// DOMが読み込まれた後にイベントリスナーを設定
document.addEventListener('DOMContentLoaded', function() {
  console.log('DOM loaded, setting up map button event listener');
  
  // ACCESSページのボタンにイベントリスナーを追加
  const mapBtn = document.getElementById('access-map-btn');
  if (mapBtn) {
    console.log('Map button found, adding click listener');
    mapBtn.addEventListener('click', function() {
      console.log('Map button clicked - opening Google Maps in new tab');
      openMapInNewTab();
    });
  } else {
    console.log('Map button not found (may not be on ACCESS page)');
  }
});

// 念のため、グローバル関数も残しておく
function scrollToMap() {
  openMapInNewTab();
}
</script>

</body>
</html>
