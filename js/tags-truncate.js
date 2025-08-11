// タグの省略表示を制御
document.addEventListener('DOMContentLoaded', function() {
    // 魚種タグと通常タグの省略処理
    const tagContainers = document.querySelectorAll('.catch-post-tags');
    
    tagContainers.forEach(function(container) {
        const fishSpeciesList = container.querySelector('.fish-species-list');
        const normalTagsList = container.querySelector('.normal-tags-list');
        
        let hasTruncation = false;
        
        // 魚種タグの省略処理
        if (fishSpeciesList) {
            const fishTags = fishSpeciesList.querySelectorAll('.fish-species-tag');
            if (fishTags.length > 3) {
                hasTruncation = true;
            }
        }
        
        // 通常タグの省略処理
        if (normalTagsList) {
            const normalTags = normalTagsList.querySelectorAll('.normal-tag');
            if (normalTags.length > 3) {
                hasTruncation = true;
            }
        }
        
        // 省略表示が必要な場合はクラスを追加
        if (hasTruncation) {
            container.classList.add('tags-truncated');
        }
    });
}); 