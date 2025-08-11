/**
 * スクロールトップボタンの機能
 */
document.addEventListener('DOMContentLoaded', function() {
    // スクロールトップボタンを作成
    const scrollToTopBtn = document.createElement('div');
    scrollToTopBtn.className = 'scroll-to-top';
    scrollToTopBtn.setAttribute('aria-label', 'ページトップへ戻る');
    scrollToTopBtn.setAttribute('role', 'button');
    scrollToTopBtn.setAttribute('tabindex', '0');
    
    // ボタンをbodyに追加
    document.body.appendChild(scrollToTopBtn);
    
    // スクロール位置を監視してボタンの表示/非表示を制御
    function toggleScrollButton() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const showThreshold = 300; // 300px以上スクロールしたら表示
        
        if (scrollTop > showThreshold) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    }
    
    // スムーズスクロール機能
    function scrollToTop() {
        const scrollStep = -window.scrollY / (500 / 15); // 500msで完了
        
        function step() {
            if (window.scrollY !== 0) {
                window.scrollBy(0, scrollStep);
                requestAnimationFrame(step);
            }
        }
        
        requestAnimationFrame(step);
    }
    
    // より滑らかなスクロール（CSS scroll-behaviorをサポートしない場合の代替）
    function smoothScrollToTop() {
        if ('scrollBehavior' in document.documentElement.style) {
            // CSS scroll-behaviorをサポートしている場合
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            // サポートしていない場合はJavaScriptでアニメーション
            scrollToTop();
        }
    }
    
    // イベントリスナーを追加
    window.addEventListener('scroll', toggleScrollButton);
    
    // クリックイベント
    scrollToTopBtn.addEventListener('click', function(e) {
        e.preventDefault();
        smoothScrollToTop();
    });
    
    // キーボードアクセシビリティ（EnterキーとSpaceキー）
    scrollToTopBtn.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            smoothScrollToTop();
        }
    });
    
    // 初期状態をチェック
    toggleScrollButton();
    
    // リサイズ時の再チェック
    window.addEventListener('resize', function() {
        setTimeout(toggleScrollButton, 100);
    });
}); 