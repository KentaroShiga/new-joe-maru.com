<?php get_header(); ?>

<div class="mainvisual mainvisual-news">
    <div>
        <img src="<?php echo get_template_directory_uri(); ?>/images/news-new-full.webp" alt="メインビジュアル" />
        <div class="mainvisual-overlay"></div>
        <h1 class="news-title">お知らせ</h1>
        <div class="mainvisual-caption">丈丸渡船のお知らせ</div>
    </div>
</div>

<div class="news-container">
    
    <div class="news-content">
        <div class="news-main">
            <div class="latest-catch-cards">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article class="latest-catch-card">
                        <div class="latest-catch-card-imgwrap">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.webp" alt="<?php the_title(); ?>" />
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
                    <p class="news-no-posts">お知らせはまだありません。</p>
                <?php endif; ?>
            </div>
            
            <!-- ページネーションを投稿一覧の直下に配置 -->
            <?php if (have_posts()) : ?>
                <div class="news-pagination">
                    <?php
                    the_posts_pagination(array(
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