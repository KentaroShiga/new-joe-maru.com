<?php
// 最新のお知らせを取得
$recent_news = new WP_Query(array(
    'post_type' => 'news',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC'
));

// 月別アーカイブを取得
$archives = wp_get_archives(array(
    'type' => 'monthly',
    'post_type' => 'news',
    'echo' => false
));
?>

<div class="news-sidebar">
    <!-- Facebook -->
    <div class="news-sidebar-box">
        <div class="news-sidebar-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" fill="currentColor"/>
            </svg>
            Facebook
        </div>
            <!-- シンプルなFacebook投稿表示 -->
            <div class="facebook-simple-widget">
                <!-- Header -->
                <div class="facebook-simple-header">
                    <div class="facebook-simple-profile">
                        <div class="facebook-simple-avatar">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/face-icon.jpg" alt="丈丸渡船" />
                        </div>
                        <div class="facebook-simple-info">
                            <div class="facebook-simple-page-name">丈丸渡船</div>
                            <div class="facebook-simple-time">
                                <!-- <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor">
                                    <path d="M6 1C3.25 1 1 3.25 1 6s2.25 5 5 5 5-2.25 5-5-2.25-5-5-5zm0 9c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"/>
                                    <path d="M6.5 3.5h-1v3l2.5 1.5.5-.8-2-1.2V3.5z"/>
                                </svg> -->
                                429 followers
                            </div>
                        </div>
                    </div>
                    <a href="https://www.facebook.com/takeyuki.murata.3" target="_blank" rel="noopener noreferrer" class="facebook-simple-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>

                <!-- Post Content -->
                <div class="facebook-simple-content">
                    #丈丸渡船<br>
                    #イカダイズム<br>
                    #えさきち<br>
                    今日の桃の木カセ、倉地さんの釣果、チヌ48センチ、ヘダイ47センチ2尾。<br>
                    フグ屋形、大西さんの釣果、チヌ35センチ。
                </div>

                <!-- Post Image -->
                <div class="facebook-simple-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/face-fish.jpg" alt="釣果の写真" />
                </div>

                <!-- Action buttons -->
                <div class="facebook-simple-actions">
                    <div class="facebook-simple-action-left">
                        <div class="facebook-simple-action-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16.5 3C19.538 3 22 5.5 22 9c0 7-7.5 11-10 12.5C9.5 20 2 16 2 9c0-3.5 2.5-6 5.5-6 1.076 0 2.124.329 3 .908C11.376 3.329 12.424 3 13.5 3z"/>
                            </svg>
                        </div>
                        <div class="facebook-simple-action-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10c-1.846 0-3.618-.505-5.135-1.468L2 22l1.468-4.865C2.505 15.618 2 13.846 2 12 2 6.486 6.486 2 12 2zm-1 7v2H9v2h2v2h2v-2h2v-2h-2V9h-2z"/>
                            </svg>
                        </div>
                        <div class="facebook-simple-action-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Likes count -->
                <div class="facebook-simple-likes">
                    <strong>42件のいいね！</strong>
                </div>

                <!-- Follow button -->
                <div class="facebook-simple-follow">
                    <a href="https://www.facebook.com/takeyuki.murata.3" target="_blank" rel="noopener noreferrer" class="facebook-simple-follow-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                        Facebookで見る
                    </a>
                </div>
            </div>
    </div>

    <!-- Instagram -->
    <div class="news-sidebar-box">
        <div class="news-sidebar-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
            Instagram
        </div>
            <!-- シンプルなInstagram投稿表示 -->
                <!-- Header -->
                <div class="instagram-simple-header">
                    <div class="instagram-simple-profile">
                        <div class="instagram-simple-avatar">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/joemaru-icon.jpg" alt="joemaru_mrtk" />
                        </div>
                        <div class="instagram-simple-info">
                            <div class="instagram-simple-username">joemaru_mrtk</div>
                            <div class="instagram-simple-time">1,663 followers</div>
                        </div>
                    </div>
                    <a href="https://www.instagram.com/joemaru_mrtk/?hl=ja" target="_blank" rel="noopener noreferrer" class="instagram-simple-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>
                </div>

                <!-- Post Image -->
                <div class="instagram-simple-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/insta-fish.jpg" alt="釣果の写真" />
                </div>

                <!-- Action buttons -->
                <div class="instagram-simple-actions">
                    <div class="instagram-simple-action-left"><a href="https://www.instagram.com/joemaru_mrtk/?hl=ja" target="_blank" rel="noopener noreferrer" class="instagram-simple-link">
<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg></a>
                        <a href="https://www.instagram.com/joemaru_mrtk/?hl=ja" target="_blank" rel="noopener noreferrer" class="instagram-simple-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg></a><a href="https://www.instagram.com/joemaru_mrtk/?hl=ja" target="_blank" rel="noopener noreferrer" class="instagram-simple-link">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22,2 15,22 11,13 2,9 22,2"></polygon>
                        </svg>
                        </a>
                    </div>
                </div>

                <!-- Likes -->
                <div class="instagram-simple-likes">
                    <strong>91件のいいね！</strong>
                </div>

                <!-- Content -->
                <div class="instagram-simple-content">
                    <span class="instagram-simple-username-bold">joemaru_mrtk</span>
                    本日の釣果です🎣 フグカセ3番、チヌ38センチ🐟<br>
                    8時頃、オキアミでした！ダンゴあたりもありましたが、チヌは連発ならず😭<br>
                    暑い中お疲れ様でした！
                    <span class="instagram-simple-hashtags">#釣り #チヌ釣り #かかり釣り #三重県 #尾鷲市 #賀田湾 #丈丸渡船</span>
                </div>

                <!-- Follow button -->
                <div class="instagram-simple-follow">
                    <a href="https://www.instagram.com/joemaru_mrtk/?hl=ja" target="_blank" rel="noopener noreferrer" class="instagram-simple-follow-btn">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>
                        Follow on Instagram
                    </a>
                </div>
    </div>

    <!-- アーカイブ -->
    <div class="news-sidebar-box">
        <div class="news-sidebar-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 32 32" fill="none" class="news-sidebar-catch-icon">
                <!-- 冷凍庫本体 -->
                <rect x="6" y="10" width="20" height="18" rx="3" ry="3" fill="#FFFFFF" stroke="currentColor" stroke-width="2"/>
                <!-- 冷凍庫の蓋 -->
                <rect x="4" y="6" width="24" height="6" rx="2" ry="2" fill="currentColor"/>
                <!-- 取っ手 -->
                <rect x="24" y="8" width="3" height="2" rx="1" ry="1" fill="#FFFFFF"/>
                <!-- 冷気エフェクト -->
                <circle cx="10" cy="16" r="1.5" fill="#B8E6FF" opacity="0.7"/>
                <circle cx="14" cy="18" r="1" fill="#B8E6FF" opacity="0.5"/>
                <circle cx="18" cy="15" r="1.2" fill="#B8E6FF" opacity="0.6"/>
                <circle cx="22" cy="20" r="0.8" fill="#B8E6FF" opacity="0.4"/>
                <!-- 魚のシルエット -->
                <path d="M12 22 Q16 20 20 22 Q18 24 16 24 Q14 24 12 22 Z" fill="currentColor"/>
                <circle cx="18" cy="22" r="0.5" fill="#FFFFFF"/>
                <!-- 温度表示 -->
                <rect x="8" y="12" width="4" height="1" rx="0.5" ry="0.5" fill="currentColor"/>
                <rect x="8" y="14" width="3" height="1" rx="0.5" ry="0.5" fill="currentColor"/>
            </svg>
            <span>過去の釣果</span>
        </div>
            <?php
            // 過去の釣果は常に一般投稿（post）を表示
            $current_post_type = 'post';
            
            // 階層構造のアーカイブデータを取得
            $archive_data = get_hierarchical_archives($current_post_type);
            
            if (!empty($archive_data)) :
            ?>
                <div class="hierarchical-archives">
                    <?php foreach ($archive_data as $year_data) : ?>
                        <div class="archive-year-item">
                            <div class="archive-year-header" data-year="<?php echo esc_attr($year_data['year']); ?>">
                                <span class="archive-toggle">▶</span>
                                <a href="<?php echo esc_url($year_data['url']); ?>" class="archive-year-link">
                                    <?php echo esc_html($year_data['year']); ?>年 (<?php echo esc_html($year_data['count']); ?>)
                                </a>
                            </div>
                            <div class="archive-months" data-year="<?php echo esc_attr($year_data['year']); ?>" style="display: none;">
                                <?php foreach ($year_data['months'] as $month_data) : ?>
                                    <div class="archive-month-item">
                                        <a href="<?php echo esc_url($month_data['url']); ?>" class="archive-month-link">
                                            <?php echo esc_html($month_data['month_name']); ?> (<?php echo esc_html($month_data['count']); ?>)
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>アーカイブがありません。</p>
            <?php endif; ?>
    </div>

    <div class="news-sidebar-box">
         <div class="news-sidebar-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="28" viewBox="0 0 20 28" fill="none">
                <path d="M13.5 19.13C13.6658 19.13 13.8247 19.0642 13.9419 18.9469C14.0592 18.8297 14.125 18.6708 14.125 18.505C14.125 18.3392 14.0592 18.1803 13.9419 18.0631C13.8247 17.9458 13.6658 17.88 13.5 17.88C13.3342 17.88 13.1753 17.9458 13.0581 18.0631C12.9408 18.1803 12.875 18.3392 12.875 18.505C12.875 18.6708 12.9408 18.8297 13.0581 18.9469C13.1753 19.0642 13.3342 19.13 13.5 19.13ZM18.125 18.505C18.125 18.6708 18.0592 18.8297 17.9419 18.9469C17.8247 19.0642 17.6658 19.13 17.5 19.13C17.3342 19.13 17.1753 19.0642 17.0581 18.9469C16.9408 18.8297 16.875 18.6708 16.875 18.505C16.875 18.3392 16.9408 18.1803 17.0581 18.0631C17.1753 17.9458 17.3342 17.88 17.5 17.88C17.6658 17.88 17.8247 17.9458 17.9419 18.0631C18.0592 18.1803 18.125 18.3392 18.125 18.505ZM15.5 21.13C15.6658 21.13 15.8247 21.0642 15.9419 20.9469C16.0592 20.8297 16.125 20.6708 16.125 20.505C16.125 20.3392 16.0592 20.1803 15.9419 20.0631C15.8247 19.9458 15.6658 19.88 15.5 19.88C15.3342 19.88 15.1753 19.9458 15.0581 20.0631C14.9408 20.1803 14.875 20.3392 14.875 20.505C14.875 20.6708 14.9408 20.8297 15.0581 20.9469C15.1753 21.0642 15.3342 21.13 15.5 21.13ZM16.125 16.505C16.125 16.6708 16.0592 16.8297 15.9419 16.9469C15.8247 17.0642 15.6658 17.13 15.5 17.13C15.3342 17.13 15.1753 17.0642 15.0581 16.9469C14.9408 16.8297 14.875 16.6708 14.875 16.505C14.875 16.3392 14.9408 16.1803 15.0581 16.0631C15.1753 15.9458 15.3342 15.88 15.5 15.88C15.6658 15.88 15.8247 15.9458 15.9419 16.0631C16.0592 16.1803 16.125 16.3392 16.125 16.505ZM5 15.5C5 15.3674 5.05268 15.2402 5.14645 15.1464C5.24021 15.0527 5.36739 15 5.5 15H6.5C6.63261 15 6.75979 15.0527 6.85355 15.1464C6.94732 15.2402 7 15.3674 7 15.5C7 15.6326 6.94732 15.7598 6.85355 15.8536C6.75979 15.9473 6.63261 16 6.5 16H5.5C5.36739 16 5.24021 15.9473 5.14645 15.8536C5.05268 15.7598 5 15.6326 5 15.5Z" fill="currentColor"/>
                <path d="M4 6.915C3.7881 6.84015 3.59572 6.71864 3.43709 6.55946C3.27846 6.40027 3.15762 6.20747 3.08351 5.99531C3.0094 5.78315 2.9839 5.55705 3.00891 5.33371C3.03392 5.11038 3.10879 4.89551 3.228 4.705L3.229 4.703L3.231 4.7L3.235 4.694L3.245 4.677C3.29103 4.60446 3.33939 4.53342 3.39 4.464C3.485 4.329 3.62 4.146 3.797 3.929C4.147 3.498 4.665 2.926 5.347 2.353C6.701 1.21 8.782 0 11.5 0C15.759 0 20 3.603 20 8.5V26.5C20 26.8978 19.842 27.2794 19.5607 27.5607C19.2794 27.842 18.8978 28 18.5 28C18.1022 28 17.7206 27.842 17.4393 27.5607C17.158 27.2794 17 26.8978 17 26.5V22.21C16.3928 22.4552 15.7348 22.5476 15.0836 22.479C14.4324 22.4105 13.808 22.1832 13.2652 21.817C12.7223 21.4508 12.2777 20.9569 11.9704 20.3787C11.663 19.8006 11.5022 19.1558 11.5022 18.501C11.5022 17.8462 11.663 17.2014 11.9704 16.6233C12.2777 16.0451 12.7223 15.5512 13.2652 15.185C13.808 14.8188 14.4324 14.5915 15.0836 14.523C15.7348 14.4544 16.3928 14.5468 17 14.792V8.5C17 5.397 14.241 3 11.5 3C9.717 3 8.298 3.789 7.279 4.647C6.85928 5.00226 6.47299 5.39523 6.125 5.821C6.00368 5.97052 5.88858 6.12499 5.78 6.284L5.769 6.3V6.299C5.58917 6.58469 5.31823 6.80137 5 6.914V11H5.5C5.63261 11 5.75979 11.0527 5.85355 11.1464C5.94732 11.2402 6 11.3674 6 11.5C6 11.6326 5.94732 11.7598 5.85355 11.8536C5.75979 11.9473 5.63261 12 5.5 12H5V12.027C6.10019 12.15 7.11644 12.6742 7.85439 13.4995C8.59234 14.3247 9.00021 15.393 9 16.5C9 21.589 7.161 23.613 6.363 24.492C6.141 24.736 6 24.892 6 25V25.5C6 25.645 6.252 25.664 6.61 25.69C7.487 25.756 9 25.87 9 28H6.5C5.5 28 4.5 27 4.5 26.5C4.5 27 3.5 28 2.5 28H0C0 25.87 1.513 25.756 2.39 25.69C2.748 25.664 3 25.645 3 25.5V25C3 24.891 2.859 24.736 2.637 24.492C1.84 23.612 0 21.589 0 16.5C3.34412e-05 15.3931 0.408014 14.3251 1.14594 13.5001C1.88387 12.6751 2.89998 12.151 4 12.028V12H3.5C3.36739 12 3.24021 11.9473 3.14645 11.8536C3.05268 11.7598 3 11.6326 3 11.5C3 11.3674 3.05268 11.2402 3.14645 11.1464C3.24021 11.0527 3.36739 11 3.5 11H4V6.915ZM15.5 15.5C14.7044 15.5 13.9413 15.8161 13.3787 16.3787C12.8161 16.9413 12.5 17.7044 12.5 18.5C12.5 19.2956 12.8161 20.0587 13.3787 20.6213C13.9413 21.1839 14.7044 21.5 15.5 21.5C16.2956 21.5 17.0587 21.1839 17.6213 20.6213C18.1839 20.0587 18.5 19.2956 18.5 18.5C18.5 17.7044 18.1839 16.9413 17.6213 16.3787C17.0587 15.8161 16.2956 15.5 15.5 15.5ZM8 16.5C8 15.5717 7.63125 14.6815 6.97487 14.0251C6.3185 13.3687 5.42826 13 4.5 13C3.57174 13 2.6815 13.3687 2.02513 14.0251C1.36875 14.6815 1 15.5717 1 16.5C1 17.4283 1.36875 18.3185 2.02513 18.9749C2.6815 19.6313 3.57174 20 4.5 20C5.42826 20 6.3185 19.6313 6.97487 18.9749C7.63125 18.3185 8 17.4283 8 16.5Z" fill="currentColor"/>
            </svg>
            魚種別
        </div>
        <div class="news-sidebar-fish-species">
            <?php
            $fish_species = get_terms(array(
                'taxonomy' => 'fish_species',
                'hide_empty' => true,
            ));
            if (!empty($fish_species) && !is_wp_error($fish_species)) {
                echo '<ul class="news-sidebar-fish-species-list">';
                foreach ($fish_species as $species) {
                    echo '<li class="news-sidebar-fish-species-item">';
                    echo '<a href="' . esc_url(get_term_link($species)) . '" class="news-sidebar-fish-species-link">';
                    echo esc_html($species->name);
                    echo '<span class="news-sidebar-fish-species-count">(' . $species->count . ')</span>';
                    echo '</a>';
                    echo '</li>';
                }
                echo '</ul>';
            }

            ?>
        </div>
    </div>

    <div class="news-sidebar-box">
         <div class="news-sidebar-header">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
            お問い合わせ
        </div>
            <div class="news-sidebar-contact-item">
                <span class="news-sidebar-contact-name">村田丈幸</span>
                <a href="tel:090-1417-9322" class="news-sidebar-contact-tel">090-1417-9322</a>
            </div>
            <div class="news-sidebar-contact-item">
                <span class="news-sidebar-contact-name">村田京</span>
                <a href="tel:080-2628-2183" class="news-sidebar-contact-tel">080-2628-2183</a>
            </div>
    </div>
</div> 