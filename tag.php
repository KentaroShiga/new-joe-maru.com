<?php
/**
 * The template for displaying tag archive pages
 *
 * @package JOEMARU
 * @subpackage JOEMARU
 * @since JOEMARU 1.0
 */

get_header(); ?>

<div class="mainvisual mainvisual-news">
    <div>
        <img src="<?php echo get_template_directory_uri(); ?>/images/blog.webp" alt="メインビジュアル" />
        <div class="mainvisual-overlay"></div>
        <h1 class="news-title"><?php echo esc_html(single_tag_title('', false)); ?>の記事一覧</h1>
    </div>
</div>

<div class="news-container">
    
    <div class="news-content">
        <div class="news-main">
            <div class="latest-catch-cards">
                <?php 
                // 全ての投稿タイプからタグ付きの投稿を取得
                $tag_slug = get_query_var('tag');
                $custom_query = new WP_Query(array(
                    'tag' => $tag_slug,
                    'post_type' => array('post', 'news', 'diary'),
                    'posts_per_page' => get_option('posts_per_page'),
                    'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($custom_query->have_posts()) : 
                    while ($custom_query->have_posts()) : $custom_query->the_post(); ?>
                    <article class="latest-catch-card">
                        <div class="latest-catch-card-imgwrap">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php 
                                    $post_type = get_post_type();
                                    $default_image = ($post_type === 'diary' || $post_type === 'news') ? 'footer-logo.png' : 'fish.png';
                                    ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $default_image; ?>" alt="<?php the_title(); ?>" />
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="latest-catch-card-title">
                            <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <div class="latest-catch-card-date"><?php echo get_the_date('Y-m-d'); ?></div>
                        <div class="latest-catch-card-desc"><?php 
                            $excerpt = get_the_excerpt();
                            if (empty($excerpt)) {
                                $excerpt = wp_trim_words(get_the_content(), 30, '...');
                            }
                            echo esc_html($excerpt); 
                        ?></div>
                        
                        <?php /*
                        <div class="catch-post-tags">
                            <?php
                            // 魚種タグを表示（釣果投稿のみ）
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
                            <?php endif; ?>
                            
                            <?php
                            // 通常タグを表示
                            $tags = get_the_tags();
                            if ($tags && !is_wp_error($tags)) :
                            ?>
                                <div class="catch-post-normal-tags">
                                    <div class="normal-tags-list">
                                        <?php foreach ($tags as $tag) : ?>
                                            <span class="normal-tag">
                                                <a href="<?php echo get_tag_link($tag); ?>"><?php echo esc_html($tag->name); ?></a>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        */ ?>
                    </article>
                <?php endwhile; ?>
                
                <?php else : ?>
                    <p class="news-no-posts"><?php echo esc_html(single_tag_title('', false)); ?>の記事はまだありません。</p>
                <?php endif; ?>
                
                <?php wp_reset_postdata(); ?>
            </div>
            
            <!-- ページネーションを投稿一覧の直下に配置 -->
            <?php if ($custom_query->have_posts()) : ?>
                <div class="news-pagination">
                    <?php
                    // カスタムクエリ用のページネーション
                    $big = 999999999;
                    echo paginate_links(array(
                        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'format' => '?paged=%#%',
                        'current' => max(1, get_query_var('paged')),
                        'total' => $custom_query->max_num_pages,
                        'mid_size' => 2,
                        'prev_text' => '‹‹',
                        'next_text' => '››',
                    ));
                    ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="news-sidebar-wrapper">
            <?php get_template_part('template-parts/news-sidebar'); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 