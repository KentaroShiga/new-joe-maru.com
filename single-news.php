<?php
/**
 * The template for displaying single news posts
 *
 * @package JOEMARU
 * @subpackage JOEMARU
 * @since JOEMARU 1.0
 */

get_header(); ?>

<div class="single-post-container">
	<div class="single-post-content">
		<?php while (have_posts()) : the_post(); ?>
			<article class="single-post-article">
				<!-- タイトルヘッダー -->
				<header class="single-post-header">
					<div class="single-header-icon">
						<img src="<?php echo get_template_directory_uri(); ?>/images/h1-icon.webp" alt="お知らせアイコン" />
					</div>
					<h1 class="single-post-title"><?php the_title(); ?></h1>
					<time class="single-post-date"><?php echo get_the_date('Y-m-d'); ?></time>
				</header>

				<!-- メイン画像 -->
				<?php if (has_post_thumbnail()) : ?>
					<div class="single-post-image">
						<?php the_post_thumbnail('large'); ?>
					</div>
				<?php endif; ?>

				<!-- コンテンツ -->
				<div class="single-post-text">
					<?php the_content(); ?>
				</div>

				<!-- カテゴリー表示 -->
				<?php
				$categories = get_the_terms(get_the_ID(), 'news_category');
				if ($categories && !is_wp_error($categories)) :
				?>
					<div class="single-post-categories">
						<h3>カテゴリー</h3>
						<div class="category-tags">
							<?php foreach ($categories as $category) : ?>
								<span class="category-tag">
									<a href="<?php echo get_term_link($category); ?>">
										<?php echo esc_html($category->name); ?>
									</a>
								</span>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- 通常タグ表示 -->
				<?php
				$tags = get_the_tags();
				if ($tags && !is_wp_error($tags)) :
				?>
					<div class="single-post-normal-tags">
						<h3>タグ</h3>
						<div class="normal-tags">
							<?php foreach ($tags as $tag) : ?>
								<span class="normal-tag">
									<a href="<?php echo get_tag_link($tag); ?>">
										<?php echo esc_html($tag->name); ?>
									</a>
								</span>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

				<!-- ナビゲーション -->
				<nav class="single-post-nav">
					<div class="single-nav-links">
						<?php
						$prev_post = get_previous_post();
						$next_post = get_next_post();
						?>
						
						<?php if ($prev_post) : ?>
							<div class="single-nav-prev">
								<a href="<?php echo get_permalink($prev_post->ID); ?>">
									<span class="nav-label">前のお知らせ</span>
									<span class="nav-title"><?php echo get_the_title($prev_post->ID); ?></span>
								</a>
							</div>
						<?php endif; ?>
						
						<?php if ($next_post) : ?>
							<div class="single-nav-next">
								<a href="<?php echo get_permalink($next_post->ID); ?>">
									<span class="nav-label">次のお知らせ</span>
									<span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
								</a>
							</div>
						<?php endif; ?>
					</div>
					
					<div class="single-back-to-archive">
						<a href="<?php echo home_url('?post_type=news'); ?>" class="back-link">
							お知らせ一覧に戻る
						</a>
					</div>
				</nav>
			</article>
		<?php endwhile; ?>
	</div>
	
	<div class="single-sidebar-wrapper">
		<?php get_template_part('template-parts/news-sidebar'); ?>
	</div>
</div>

<?php get_footer(); ?> 