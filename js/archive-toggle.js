/**
 * 階層構造アーカイブの展開機能
 */
document.addEventListener('DOMContentLoaded', function() {
    // 年別アーカイブの展開機能
    const yearHeaders = document.querySelectorAll('.archive-year-header');
    
    yearHeaders.forEach(function(header) {
        header.addEventListener('click', function(e) {
            // リンククリックを防ぐ（トグルアイコンクリック時のみ）
            if (e.target.classList.contains('archive-toggle')) {
                e.preventDefault();
            }
            
            const year = this.getAttribute('data-year');
            const monthsContainer = document.querySelector('.archive-months[data-year="' + year + '"]');
            const toggle = this.querySelector('.archive-toggle');
            
            if (monthsContainer && toggle) {
                if (monthsContainer.style.display === 'none' || monthsContainer.style.display === '') {
                    // 展開
                    monthsContainer.style.display = 'block';
                    toggle.classList.add('expanded');
                    toggle.textContent = '▼';
                    
                    // アニメーション効果
                    monthsContainer.style.opacity = '0';
                    monthsContainer.style.maxHeight = '0';
                    
                    setTimeout(function() {
                        monthsContainer.style.transition = 'opacity 0.3s ease, max-height 0.3s ease';
                        monthsContainer.style.opacity = '1';
                        monthsContainer.style.maxHeight = '500px';
                    }, 10);
                } else {
                    // 折りたたみ
                    monthsContainer.style.transition = 'opacity 0.3s ease, max-height 0.3s ease';
                    monthsContainer.style.opacity = '0';
                    monthsContainer.style.maxHeight = '0';
                    
                    setTimeout(function() {
                        monthsContainer.style.display = 'none';
                        toggle.classList.remove('expanded');
                        toggle.textContent = '▶';
                    }, 300);
                }
            }
        });
        
        // トグルアイコンのクリックイベント
        const toggle = header.querySelector('.archive-toggle');
        if (toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                header.click();
            });
        }
    });
    
    // 現在のページに対応する年月を自動展開
    const currentUrl = window.location.href;
    const currentYear = new Date().getFullYear();
    
    // URLから年月を抽出して該当する項目を展開
    const urlParams = new URLSearchParams(window.location.search);
    const yearParam = urlParams.get('year');
    const monthParam = urlParams.get('monthnum');
    
    if (yearParam) {
        const targetHeader = document.querySelector('.archive-year-header[data-year="' + yearParam + '"]');
        if (targetHeader) {
            targetHeader.click();
            
            // 該当する月をハイライト
            if (monthParam) {
                setTimeout(function() {
                    const monthLinks = document.querySelectorAll('.archive-months[data-year="' + yearParam + '"] .archive-month-link');
                    monthLinks.forEach(function(link) {
                        if (link.href.includes('monthnum=' + monthParam)) {
                            link.style.backgroundColor = 'rgba(120, 185, 108, 0.2)';
                            link.style.fontWeight = '600';
                        }
                    });
                }, 350);
            }
        }
    }
    
    // 日付ベースのアーカイブページでも自動展開
    if (currentUrl.includes('/2024/') || currentUrl.includes('/2025/')) {
        const matches = currentUrl.match(/\/(\d{4})\//);
        if (matches) {
            const year = matches[1];
            const targetHeader = document.querySelector('.archive-year-header[data-year="' + year + '"]');
            if (targetHeader) {
                setTimeout(function() {
                    targetHeader.click();
                }, 100);
            }
        }
    }
}); 