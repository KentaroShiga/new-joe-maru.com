<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<!-- トップページ メインビジュアル・セクションここから -->
		<div class="toppage-mainvisual">
			<div>
				<img src="<?php echo get_template_directory_uri(); ?>/images/fish.png" alt="メインビジュアル" />
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="ロゴテキスト" />
				<div class="mainvisual-caption">カセ・筏釣りから近海船釣りまで</div>
			</div>
			<div class="toppage-section-cards">
				<div class="toppage-card">
					<img src="https://placehold.co/414x282" alt="釣果" />
					<div class="card-overlay"></div>
					<div class="card-title">釣果</div>
					<div class="card-desc">過去の釣果をご紹介</div>
				</div>
				<div class="toppage-card">
					<img src="https://placehold.co/414x282" alt="アクセス" />
					<div class="card-overlay"></div>
					<div class="card-title">アクセスについて</div>
					<div class="card-desc">丈丸渡船へのアクセス</div>
				</div>
				<div class="toppage-card">
					<img src="https://placehold.co/414x282" alt="料金" />
					<div class="card-overlay"></div>
					<div class="card-title">料金</div>
					<div class="card-desc">料金の詳細</div>
				</div>
				<div class="toppage-card">
					<img src="https://placehold.co/414x282" alt="船長紹介" />
					<div class="card-overlay"></div>
					<div class="card-title">船長紹介</div>
					<div class="card-desc">丈丸渡船の船長</div>
				</div>
				<div class="toppage-card">
					<img src="https://placehold.co/414x282" alt="ブログ" />
					<div class="card-overlay"></div>
					<div class="card-title">ブログ</div>
					<div class="card-desc">船長のブログ</div>
				</div>
			</div>
			<div class="toppage-info">
				<h2>お知らせ</h2>
				<ul>
					<li>2025年4月20日　出船時間　筏・カセ釣り（一番船） ➡ AM５：００　船釣り ➡ AM６：００</li>
					<li>2025年4月20日　出船時間　筏・カセ釣り（一番船） ➡ AM５：００　船釣り ➡ AM６：００（台風の影響による）</li>
					<li>2025年4月20日　出船時間　筏・カセ釣り（一番船） ➡ AM５：００　船釣り ➡ AM６：００</li>
				</ul>
			</div>
		</div>
		<!-- トップページ メインビジュアル・セクションここまで -->

		<!-- 丈丸渡船についてセクション -->
		<section class="toppage-about">
			<div class="about-inner">
				<div class="about-title-area">
					<img class="about-title-bar" src="https://placehold.co/45x9" alt="bar" />
					<h2 class="about-title">丈丸渡船について</h2>
					<img class="about-title-bar" src="https://placehold.co/45x9" alt="bar" />
				</div>
				<div class="about-content">
					<img class="about-image" src="https://placehold.co/642x487" alt="丈丸渡船イメージ" />
					<div class="about-text">
						三重県・尾鷲の美しい山々と海に囲まれた賀田湾。その静かで穏やかな海で、心ゆくまで釣りを楽しめるのが「丈丸渡船」です。賀田インターから車で約5分とアクセスも良く、初めての方でも気軽に訪れていただけます。<br><br>
						このエリア最大の魅力は、一年を通してチヌ（黒鯛）を狙えること。さらに、春にはアオリイカ、秋から冬にかけては青物など、季節ごとのターゲットも豊富で、年間を通じて多彩な釣りが楽しめます。<br><br>
						丈丸渡船では、筏、カセ釣りの他、完全チャーター制の船釣りをご提供しており、グループだけのプライベートな時間を確保。<br>
						他のお客様に気を遣うことなく、思いきり釣りに集中できるのがうれしいポイントです。<br><br>
						「釣って、食べて、また来たくなる」。<br>
						そんな心に残る釣り体験を、ぜひ丈丸渡船でお楽しみください。
					</div>
				</div>
				<a class="about-btn" href="#">
					<span class="about-btn-inner">
						<span class="about-btn-arrow">&rsaquo;</span>
						<span class="about-btn-label">船長紹介</span>
					</span>
				</a>
			</div>
		</section>

		<!-- 新着釣果セクション -->
		<section class="toppage-latest-catch">
			<div class="latest-catch-inner">
				<div class="latest-catch-title-area">
					<h2 class="latest-catch-title">新着釣果</h2>
				</div>
				<div class="latest-catch-cards">
					<div class="latest-catch-card">
						<div class="latest-catch-card-imgwrap">
							<img src="https://placehold.co/379x284" alt="釣果1" />
						</div>
						<div class="latest-catch-card-title">【簡単】鯛のあら炊き！捌き方もサクッと解説！誰でも作れる最高のレシピ</div>
						<div class="latest-catch-card-date">2025-05-03</div>
						<div class="latest-catch-card-desc">お客さんに真鯛をいただいてしまいました！いろいろな釣り方で狙うことができ、ご近所さんの趣味が釣りの場合はお裾分けでいただ...ただ...ただ...ただ...</div>
					</div>
					<div class="latest-catch-card">
						<div class="latest-catch-card-imgwrap">
							<img src="https://placehold.co/379x284" alt="釣果2" />
						</div>
						<div class="latest-catch-card-title">【簡単】鯛のあら炊き！捌き方もサクッと解説！誰でも作れる最高のレシピ</div>
						<div class="latest-catch-card-date">2025-05-03</div>
						<div class="latest-catch-card-desc">お客さんに真鯛をいただいてしまいました！いろいろな釣り方で狙うことができ、ご近所さんの趣味が釣りの場合はお裾分けでいただ...ただ...ただ...ただ...</div>
					</div>
					<div class="latest-catch-card">
						<div class="latest-catch-card-imgwrap">
							<img src="https://placehold.co/379x284" alt="釣果3" />
						</div>
						<div class="latest-catch-card-title">【簡単】鯛のあら炊き！捌き方もサクッと解説！誰でも作れる最高のレシピ</div>
						<div class="latest-catch-card-date">2025-05-03</div>
						<div class="latest-catch-card-desc">お客さんに真鯛をいただいてしまいました！いろいろな釣り方で狙うことができ、ご近所さんの趣味が釣りの場合はお裾分けでいただ...ただ...ただ...ただ...</div>
					</div>
				</div>
				<a class="latest-catch-btn" href="#">
					<span class="latest-catch-btn-label">釣果一覧を確認</span>
				</a>
			</div>
		</section>

		<!-- 料金についてセクション -->
		<section class="toppage-price">
			<div class="price-inner">
				<div class="price-title-area">
					<h2 class="price-title">料金について</h2>
				</div>
				<div class="price-cards">
					<!-- カセ・筏釣り -->
					<div class="price-card">
						<div class="price-card-header price-card-header--kase">
							<div class="price-card-icon"></div>
							<div class="price-card-title">カセ・筏釣り</div>
							<div class="price-card-sub">1名様～</div>
						</div>
						<div class="price-card-main">
							<div class="price-card-price">～¥4,000</div>
							<div class="price-card-unit">/ １人</div>
							<div class="price-card-tax">消費税込み</div>
						</div>
						<div class="price-card-desc">チヌ・季節に応じて青物・アオリイカなど</div>
						<div class="price-card-desc">1名様から出船します</div>
						<div class="price-card-desc">女性・子ども（中学生まで）は半額となります</div>
						<div class="price-card-desc">釣り時間はお知らせをご確認ください</div>
						<a class="price-card-btn" href="#">詳しくはこちら</a>
					</div>
					<!-- 近海チャーター船 -->
					<div class="price-card">
						<div class="price-card-header price-card-header--charter">
							<div class="price-card-icon"></div>
							<div class="price-card-title">近海チャーター船</div>
							<div class="price-card-sub">2名様～</div>
						</div>
						<div class="price-card-main">
							<div class="price-card-price">～¥12,000</div>
							<div class="price-card-unit">/ １人</div>
							<div class="price-card-tax">消費税込み</div>
						</div>
						<div class="price-card-desc">ルアー五目便</div>
						<div class="price-card-desc">2名様から出船します</div>
						<div class="price-card-desc">スタンプカード・人数によって割引がございます</div>
						<div class="price-card-desc">6時間程度</div>
						<a class="price-card-btn" href="#">詳しくはこちら</a>
					</div>
					<!-- 湾内チャーター船 -->
					<div class="price-card">
						<div class="price-card-header price-card-header--bay">
							<div class="price-card-icon"></div>
							<div class="price-card-title">湾内チャーター船</div>
							<div class="price-card-sub">1名様 ～</div>
						</div>
						<div class="price-card-main">
							<div class="price-card-price">¥15,000</div>
							<div class="price-card-unit">/ 1隻</div>
							<div class="price-card-tax">消費税込み</div>
						</div>
						<div class="price-card-desc">ルアー五目便</div>
						<div class="price-card-desc">3名程度まで乗船可能です</div>
						<div class="price-card-desc">5時間程度</div>
						<a class="price-card-btn" href="#">詳しくはこちら</a>
					</div>
				</div>
			</div>
		</section>

		<!-- アクセス・地図・紹介セクション -->
		<section class="toppage-access">
			<div class="access-title-area">
				<img class="access-title-bar" src="https://placehold.co/45x9" alt="bar" />
				<h2 class="access-title">賀田インターから約５分の丈丸渡船</h2>
				<img class="access-title-bar" src="https://placehold.co/45x9" alt="bar" />
			</div>
			<div class="access-desc">丈丸渡船では賀田湾内に設置した、１０m〜２８mまで、様々な水深のカセをご案内しております。チヌ、真鯛から、青物、ヒラメ、アオリイカなど、お客様のご要望に応じてご案内させていただきます。</div>
			<div class="access-map-area">
				<div class="access-map">
					<!-- 地図やGoogleMap埋め込みの代わりにダミー画像 -->
					<img src="https://placehold.co/900x499" alt="地図" />
				</div>
				<div class="access-map-side">
					<div class="access-tel-btns">
						<a class="access-tel-btn" href="tel:090-1417-9322">
							<span class="access-tel-btn-label">090-1417-9322</span>
							<span class="access-tel-btn-desc">＼村田丈幸に電話／</span>
						</a>
						<a class="access-tel-btn" href="tel:080-2628-2183">
							<span class="access-tel-btn-label">080-2628-2183</span>
							<span class="access-tel-btn-desc">＼村田京に電話／</span>
						</a>
					</div>
				</div>
			</div>
		</section>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
