<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JOEMARU
 * @subpackage JOEMARU
 * @since JOEMARU 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<!-- トップページ メインビジュアル・セクションここから -->
		<div class="toppage-mainvisual">
			<div>
				        <img src="<?php echo get_template_directory_uri(); ?>/images/fish.png" alt="メインビジュアル" />
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="ロゴテキスト" />
				<h1 class="sr-only">丈丸渡船</h1>
				<div class="mainvisual-caption">カセ・筏釣りから近海船釣りまで</div>
			</div>
			<div class="toppage-section-cards">
				<div class="toppage-cards-row">
					<a href="<?php echo esc_url( home_url( '?post_type=post' ) ); ?>" class="toppage-card">
						<img src="<?php echo get_template_directory_uri(); ?>/images/tyoka.png" alt="釣果一覧">
						<div class="card-overlay"></div>
						<h3 class="card-title">釣果一覧</h3>
						<div class="card-desc">過去の釣果をご紹介</div>
					</a>
					<?php
					$access_page = get_page_by_path('access');
					$access_url = $access_page ? get_permalink($access_page->ID) : home_url('?page_id=2');
					?>
					<a href="<?php echo esc_url( $access_url ); ?>" class="toppage-card">
						<img src="<?php echo get_template_directory_uri(); ?>/images/access.png" alt="アクセス">
						<div class="card-overlay"></div>
						<h3 class="card-title">アクセスについて</h3>
						<div class="card-desc">丈丸渡船へのアクセス</div>
					</a>
				</div>
				<div class="toppage-cards-row">
					<?php
					$price_page = get_page_by_path('price');
					$price_url = $price_page ? get_permalink($price_page->ID) : home_url('?page_id=3');
					?>
					<a href="<?php echo esc_url( $price_url ); ?>" class="toppage-card">
						<img src="<?php echo get_template_directory_uri(); ?>/images/price.png" alt="料金について">
						<div class="card-overlay"></div>
						<h3 class="card-title">料金</h3>
						<div class="card-desc">料金の詳細</div>
					</a>
					<?php
					$captain_page = get_page_by_path('captain');
					$captain_url = $captain_page ? get_permalink($captain_page->ID) : home_url('?page_id=4');
					?>
					<a href="<?php echo esc_url( $captain_url ); ?>" class="toppage-card">
						        <img src="<?php echo get_template_directory_uri(); ?>/images/captain-new.jpg" alt="船長紹介">
						<div class="card-overlay"></div>
						<h3 class="card-title">船長紹介</h3>
						<div class="card-desc">丈丸渡船の船長</div>
					</a>
					<a href="<?php echo esc_url( home_url( '?post_type=diary' ) ); ?>" class="toppage-card">
						        <img src="<?php echo get_template_directory_uri(); ?>/images/blog.png" alt="きょうの日記">
						<div class="card-overlay"></div>
						<h3 class="card-title">きょうの日記</h3>
						<div class="card-desc">船長のブログ</div>
					</a>
				</div>
			</div>
			<div class="toppage-info">
				<h2 class="latest-catch-title">お知らせ</h2>
				<ul>
					<?php
					// お知らせ投稿を最新3件取得
					$news_query = new WP_Query(array(
						'post_type' => 'news',
						'posts_per_page' => 3,
						'post_status' => 'publish',
						'orderby' => 'date',
						'order' => 'DESC'
					));
					
					if ($news_query->have_posts()) :
						while ($news_query->have_posts()) : $news_query->the_post();
					?>
						<li>
							<a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
								<?php echo get_the_date('Y年n月j日'); ?>　<?php the_title(); ?>
							</a>
						</li>
					<?php
						endwhile;
						wp_reset_postdata();
					else :
					?>
						<li>現在お知らせはありません。</li>
					<?php endif; ?>
				</ul>
				<a href="<?php echo esc_url( home_url( '?post_type=news' ) ); ?>" class="info-more-btn">
					<span class="info-more-btn-label">＞ MORE</span>
				</a>
			</div>
		</div>
		<!-- トップページ メインビジュアル・セクションここまで -->

		<!-- 丈丸渡船についてセクション -->
		<section class="toppage-about">
			<div class="about-inner">
				
				<div class="about-content">
					<img class="about-image" src="<?php echo get_template_directory_uri(); ?>/images/about-joe-maru.jpg" alt="丈丸渡船イメージ" />
					<div class="about-text">
					<div class="about-title-area">
					<img src="<?php echo get_template_directory_uri(); ?>/images/lines.png" alt="" class="about-title-bar">
					<h2 class="about-title">丈丸渡船について</h2>
					<img src="<?php echo get_template_directory_uri(); ?>/images/lines.png" alt="" class="about-title-bar">
				</div>
						三重県・尾鷲の美しい山々と海に囲まれた賀田湾。その静かで穏やかな海で、心ゆくまで釣りを楽しめるのが「丈丸渡船」です。賀田インターから車で約5分とアクセスも良く、初めての方でも気軽に訪れていただけます。<br><br>
						このエリア最大の魅力は、一年を通してチヌ（黒鯛）を狙えること。さらに、春にはアオリイカ、秋から冬にかけては青物など、季節ごとのターゲットも豊富で、年間を通じて多彩な釣りが楽しめます。<br><br>
						丈丸渡船では、筏、カセ釣りの他、完全チャーター制の船釣りをご提供しており、グループだけのプライベートな時間を確保。<br>
						他のお客様に気を遣うことなく、思いきり釣りに集中できるのがうれしいポイントです。<br><br>
						「釣って、食べて、また来たくなる」。<br>
						そんな心に残る釣り体験を、ぜひ丈丸渡船でお楽しみください。
						
						<?php
						$captain_page = get_page_by_path('captain');
						$captain_about_url = $captain_page ? get_permalink($captain_page->ID) : home_url('?page_id=4');
						?>
						<a class="about-btn about-btn--inline" href="<?php echo esc_url( $captain_about_url ); ?>">
							<span class="about-btn-inner">
								<span class="about-btn-arrow">&rsaquo;</span>
								<span class="about-btn-label">船長紹介</span>
							</span>
						</a>
					</div>
				</div>
			</div>
		</section>

		<!-- 新着釣果セクション -->
		<section class="toppage-latest-catch">
			<div class="latest-catch-inner">
				<div class="latest-catch-title-area">
					<h2 class="latest-catch-title">新着釣果</h2>
				</div>
				<div class="latest-catch-cards">
					<?php
					// 釣果投稿を最新3件取得
					$catch_query = new WP_Query(array(
						'post_type' => 'post',
						'posts_per_page' => 3,
						'post_status' => 'publish',
						'orderby' => 'date',
						'order' => 'DESC'
					));
					
					if ($catch_query->have_posts()) :
						while ($catch_query->have_posts()) : $catch_query->the_post();
							$excerpt = get_the_excerpt();
							if (empty($excerpt)) {
								$excerpt = wp_trim_words(get_the_content(), 30, '...');
							}
					?>
						<div class="latest-catch-card">
							<div class="latest-catch-card-imgwrap">
								<?php if (has_post_thumbnail()) : ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
									</a>
								<?php else : ?>
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo get_template_directory_uri(); ?>/images/fish.png" alt="<?php the_title(); ?>" />
									</a>
								<?php endif; ?>
							</div>
							<div class="latest-catch-card-title">
								<a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
									<?php the_title(); ?>
								</a>
							</div>
							<div class="latest-catch-card-date"><?php echo get_the_date('Y-m-d'); ?></div>
							<div class="latest-catch-card-desc"><?php echo esc_html($excerpt); ?></div>
							
							<?php /*
							// 魚種タグを表示
							$fish_species = get_the_terms(get_the_ID(), 'fish_species');
							if ($fish_species && !is_wp_error($fish_species)) :
							?>
								<div class="catch-post-fish-species">
									<div class="fish-species-list">
										<?php foreach ($fish_species as $species) : ?>
											<span class="fish-species-tag">
												<a href="<?php echo get_term_link($species); ?>"><?php echo esc_html($species->name); ?></a>
											</span>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endif;
							*/ ?>
						</div>
					<?php
						endwhile;
						wp_reset_postdata();
					else :
					?>
						<div class="latest-catch-card">
							<div class="latest-catch-card-imgwrap">
								<img src="<?php echo get_template_directory_uri(); ?>/images/fish.png" alt="釣果なし" />
							</div>
							<div class="latest-catch-card-title">釣果投稿がありません</div>
							<div class="latest-catch-card-date"><?php echo date('Y-m-d'); ?></div>
							<div class="latest-catch-card-desc">まだ釣果投稿がありません。管理画面から釣果を投稿してください。</div>
						</div>
					<?php endif; ?>
				</div>
				<a class="latest-catch-btn" href="<?php echo esc_url( home_url( '?post_type=post' ) ); ?>">
					<span class="latest-catch-btn-label">釣果一覧を確認</span>
				</a>
			</div>
		</section>

		<!-- 料金についてセクション -->
		<?php get_template_part('template-parts/price-section'); ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
