// テキストオーバーフロー検出とフェードアウト効果の適用
document.addEventListener('DOMContentLoaded', function() {
    // お知らせコーナーのリンク要素を取得
    const newsLinks = document.querySelectorAll('.toppage-info li a');
    
    newsLinks.forEach(function(link) {
        // テキストがオーバーフローしているかチェック
        if (link.scrollWidth > link.clientWidth) {
            // オーバーフローしている場合、data属性を追加
            link.setAttribute('data-overflow', 'true');
        }
    });
    
    // ウィンドウサイズ変更時に再チェック
    window.addEventListener('resize', function() {
        newsLinks.forEach(function(link) {
            // data属性をリセット
            link.removeAttribute('data-overflow');
            
            // 再度チェック
            if (link.scrollWidth > link.clientWidth) {
                link.setAttribute('data-overflow', 'true');
            }
        });
    });
}); 