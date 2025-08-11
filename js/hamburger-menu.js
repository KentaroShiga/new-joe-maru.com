/**
 * ハンバーガーメニューの機能
 */
document.addEventListener('DOMContentLoaded', function() {
    // ハンバーガーメニューとモバイルメニューを作成
    createHamburgerMenu();
    
    function createHamburgerMenu() {
        const headerBar = document.querySelector('.header-custom-bar');
        if (!headerBar) return;
        
        // ハンバーガーボタンを作成
        const hamburgerBtn = document.createElement('div');
        hamburgerBtn.className = 'hamburger-menu';
        hamburgerBtn.setAttribute('aria-label', 'メニューを開く');
        hamburgerBtn.setAttribute('role', 'button');
        hamburgerBtn.setAttribute('tabindex', '0');
        
        // ハンバーガーラインを作成
        for (let i = 0; i < 3; i++) {
            const line = document.createElement('div');
            line.className = 'hamburger-line';
            hamburgerBtn.appendChild(line);
        }
        
        // オーバーレイを作成
        const overlay = document.createElement('div');
        overlay.className = 'mobile-menu-overlay';
        
        // モバイルメニューを作成
        const mobileMenu = document.createElement('div');
        mobileMenu.className = 'mobile-menu';
        
        // メニューナビゲーションを作成
        const mobileNav = document.createElement('nav');
        mobileNav.className = 'mobile-menu-nav';
        
        // 現在のナビゲーションメニューを取得
        const currentNav = document.querySelector('.header-custom-nav');
        if (currentNav) {
            const navLinks = currentNav.querySelectorAll('a');
            navLinks.forEach(link => {
                const mobileLink = link.cloneNode(true);
                mobileNav.appendChild(mobileLink);
            });
        }
        
        // 電話番号セクションを作成
        const mobileTel = document.createElement('div');
        mobileTel.className = 'mobile-menu-tel';
        
        const telTitle = document.createElement('h4');
        telTitle.textContent = 'お電話でのお問い合わせ';
        mobileTel.appendChild(telTitle);
        
        const tel1 = document.createElement('a');
        tel1.href = 'tel:090-1417-9322';
        tel1.textContent = '090-1417-9322（村田丈幸）';
        mobileTel.appendChild(tel1);
        
        const tel2 = document.createElement('a');
        tel2.href = 'tel:080-2628-2183';
        tel2.textContent = '080-2628-2183（村田京）';
        mobileTel.appendChild(tel2);
        
        // モバイルメニューに要素を追加
        mobileMenu.appendChild(mobileNav);
        mobileMenu.appendChild(mobileTel);
        
        // DOMに要素を追加
        headerBar.appendChild(hamburgerBtn);
        document.body.appendChild(overlay);
        document.body.appendChild(mobileMenu);
        
        // イベントリスナーを設定
        setupEventListeners(hamburgerBtn, overlay, mobileMenu);
    }
    
    function setupEventListeners(hamburgerBtn, overlay, mobileMenu) {
        // ハンバーガーボタンクリック
        hamburgerBtn.addEventListener('click', function() {
            toggleMenu(hamburgerBtn, overlay, mobileMenu);
        });
        
        // キーボードアクセシビリティ
        hamburgerBtn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMenu(hamburgerBtn, overlay, mobileMenu);
            }
        });
        
        // オーバーレイクリックで閉じる
        overlay.addEventListener('click', function() {
            closeMenu(hamburgerBtn, overlay, mobileMenu);
        });
        
        // メニューリンククリックで閉じる
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                closeMenu(hamburgerBtn, overlay, mobileMenu);
            });
        });
        
        // ESCキーで閉じる
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMenu(hamburgerBtn, overlay, mobileMenu);
            }
        });
        
        // ウィンドウリサイズ時の処理
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1000 && mobileMenu.classList.contains('active')) {
                closeMenu(hamburgerBtn, overlay, mobileMenu);
            }
        });
    }
    
    function toggleMenu(hamburgerBtn, overlay, mobileMenu) {
        const isActive = hamburgerBtn.classList.contains('active');
        
        if (isActive) {
            closeMenu(hamburgerBtn, overlay, mobileMenu);
        } else {
            openMenu(hamburgerBtn, overlay, mobileMenu);
        }
    }
    
    function openMenu(hamburgerBtn, overlay, mobileMenu) {
        hamburgerBtn.classList.add('active');
        overlay.classList.add('active');
        mobileMenu.classList.add('active');
        
        // ボディのスクロールを無効化
        document.body.style.overflow = 'hidden';
        
        // アクセシビリティ
        hamburgerBtn.setAttribute('aria-label', 'メニューを閉じる');
        hamburgerBtn.setAttribute('aria-expanded', 'true');
        
        // フォーカストラップ
        trapFocus(mobileMenu);
    }
    
    function closeMenu(hamburgerBtn, overlay, mobileMenu) {
        hamburgerBtn.classList.remove('active');
        overlay.classList.remove('active');
        mobileMenu.classList.remove('active');
        
        // ボディのスクロールを有効化
        document.body.style.overflow = '';
        
        // アクセシビリティ
        hamburgerBtn.setAttribute('aria-label', 'メニューを開く');
        hamburgerBtn.setAttribute('aria-expanded', 'false');
        
        // フォーカスをハンバーガーボタンに戻す
        hamburgerBtn.focus();
    }
    
    function trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
        );
        
        if (focusableElements.length === 0) return;
        
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        // 最初の要素にフォーカス
        firstElement.focus();
        
        element.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    // Shift + Tab
                    if (document.activeElement === firstElement) {
                        e.preventDefault();
                        lastElement.focus();
                    }
                } else {
                    // Tab
                    if (document.activeElement === lastElement) {
                        e.preventDefault();
                        firstElement.focus();
                    }
                }
            }
        });
    }
    
    // 画面幅の変化を監視してメニューの表示を調整
    function handleResize() {
        const hamburgerBtn = document.querySelector('.hamburger-menu');
        const mobileMenu = document.querySelector('.mobile-menu');
        const overlay = document.querySelector('.mobile-menu-overlay');
        
        if (window.innerWidth > 1000) {
            // デスクトップサイズではハンバーガーメニューを非表示
            if (hamburgerBtn && mobileMenu && overlay) {
                closeMenu(hamburgerBtn, overlay, mobileMenu);
            }
        }
    }
    
    // リサイズイベントリスナー
    window.addEventListener('resize', handleResize);
    
    // 初期チェック
    handleResize();
}); 