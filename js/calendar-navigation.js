/**
 * NewJoeMaru 釣果カレンダー ナビゲーション JavaScript
 * 
 * @package JOEMARU
 * @since 1.0.0
 */

(function($) {
    'use strict';

    // カレンダー機能のメインオブジェクト
    var FishingCalendar = {
        
        // 初期化
        init: function() {
            this.bindEvents();
        },

        // イベントバインド
        bindEvents: function() {
            // 月送りナビゲーション
            $(document).on('click', '.calendar-nav-btn', function(e) {
                e.preventDefault();
                console.log('ナビゲーションボタンクリック');
                FishingCalendar.navigateMonth($(this));
            });

            // 年・月ドロップダウン変更
            $(document).on('change', '.year-selector, .month-selector', function(e) {
                console.log('ドロップダウン変更イベント発生:', $(this).attr('class'), $(this).val());
                
                // テスト用：単純なアラート
                if (typeof calendar_ajax !== 'undefined' && calendar_ajax.debug) {
                    console.log('デバッグモード: ドロップダウン変更検出');
                }
                
                FishingCalendar.navigateFromSelectors($(this));
            });

            // 日付クリック（釣果記事への遷移）
            $(document).on('click', '.calendar-day.has-posts', function(e) {
                e.preventDefault();
                console.log('日付クリック');
                FishingCalendar.navigateToPost($(this));
            });

            // キーボードナビゲーション対応
            $(document).on('keydown', '.calendar-nav-btn, .calendar-day.has-posts', function(e) {
                if (e.keyCode === 13 || e.keyCode === 32) { // Enter or Space
                    e.preventDefault();
                    $(this).click();
                }
            });
        },

        // 月送りナビゲーション処理
        navigateMonth: function($btn) {
            var year = parseInt($btn.data('year'));
            var month = parseInt($btn.data('month'));
            var $container = $btn.closest('.fishing-calendar-container');

            if (!year || !month) {
                console.error('年月データが取得できませんでした');
                return;
            }

            // ローディング状態を表示
            this.showLoading($container);

            // AJAX でカレンダーデータを取得
            $.ajax({
                url: calendar_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'update_calendar',
                    year: year,
                    month: month,
                    nonce: calendar_ajax.nonce
                },
                success: function(response) {
                    if (response) {
                        $container.replaceWith(response);
                        FishingCalendar.hideLoading();
                        
                        // アニメーション効果
                        $('.fishing-calendar-container').hide().fadeIn(300);
                    } else {
                        console.error('カレンダーデータの取得に失敗しました');
                        FishingCalendar.hideLoading();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX エラー:', error);
                    FishingCalendar.hideLoading();
                    FishingCalendar.showError('カレンダーの読み込みに失敗しました。ページを再読み込みしてください。');
                }
            });
        },

        // ドロップダウンからのナビゲーション処理
        navigateFromSelectors: function($selector) {
            var $container = $selector.closest('.fishing-calendar-container');
            var year = parseInt($container.find('.year-selector').val());
            var month = parseInt($container.find('.month-selector').val());

            console.log('ドロップダウン変更:', {year: year, month: month});

            if (!year || !month || isNaN(year) || isNaN(month)) {
                console.error('年月データが取得できませんでした', {year: year, month: month});
                return;
            }

            // ローディング状態を表示
            this.showLoading($container);

            // AJAX でカレンダーデータを取得
            $.ajax({
                url: calendar_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'update_calendar',
                    year: year,
                    month: month,
                    nonce: calendar_ajax.nonce
                },
                success: function(response) {
                    console.log('AJAX成功:', response.length + '文字');
                    if (response && response.trim().length > 0) {
                        $container.replaceWith(response);
                        FishingCalendar.hideLoading();
                        
                        // アニメーション効果
                        $('.fishing-calendar-container').hide().fadeIn(300);
                        
                        console.log('カレンダー更新完了');
                    } else {
                        console.error('カレンダーデータが空でした');
                        FishingCalendar.hideLoading();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX エラー:', {xhr: xhr, status: status, error: error});
                    FishingCalendar.hideLoading();
                    FishingCalendar.showError('カレンダーの読み込みに失敗しました。ページを再読み込みしてください。');
                }
            });
        },

        // 釣果記事への遷移
        navigateToPost: function($day) {
            var url = $day.data('url');
            var date = $day.data('date');

            if (!url) {
                console.error('記事URLが取得できませんでした');
                return;
            }

            // 直接遷移（アニメーション効果なし）
            window.location.href = url;
        },

        // ローディング状態表示
        showLoading: function($container) {
            $container.addClass('calendar-loading');
            
            // アクセシビリティ: スクリーンリーダー用
            $container.attr('aria-busy', 'true');
            $container.prepend('<div class="sr-only" id="calendar-loading-text">カレンダーを読み込み中...</div>');
        },

        // ローディング状態解除
        hideLoading: function() {
            $('.fishing-calendar-container').removeClass('calendar-loading');
            $('.fishing-calendar-container').removeAttr('aria-busy');
            $('#calendar-loading-text').remove();
        },

        // エラーメッセージ表示
        showError: function(message) {
            var $errorDiv = $('<div class="calendar-error" style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; text-align: center;">')
                .text(message);
            
            $('.fishing-calendar-container').prepend($errorDiv);
            
            // 5秒後にエラーメッセージを自動削除
            setTimeout(function() {
                $errorDiv.fadeOut(300, function() {
                    $(this).remove();
                });
            }, 5000);
        }
    };

    // カレンダー日付ホバー効果
    var CalendarEffects = {
        
        init: function() {
            this.bindHoverEffects();
        },

        bindHoverEffects: function() {
            // 日付セルのホバー効果
            $(document).on('mouseenter', '.calendar-day.has-posts', function() {
                $(this).addClass('hover-effect');
                
                // ツールチップ風の効果
                var $this = $(this);
                var date = $this.data('date');
                if (date) {
                    var tooltip = $('<div class="calendar-tooltip">釣果記事を見る</div>');
                    $this.append(tooltip);
                    
                    setTimeout(function() {
                        tooltip.addClass('show');
                    }, 100);
                }
            });

            $(document).on('mouseleave', '.calendar-day.has-posts', function() {
                $(this).removeClass('hover-effect');
                $('.calendar-tooltip').remove();
            });

            // ナビゲーションボタンのホバー効果
            $(document).on('mouseenter', '.calendar-nav-btn', function() {
                $(this).addClass('nav-hover');
            });

            $(document).on('mouseleave', '.calendar-nav-btn', function() {
                $(this).removeClass('nav-hover');
            });
        }
    };

    // ツールチップのCSS（動的に追加）
    var tooltipCSS = `
        <style>
        .calendar-tooltip {
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            z-index: 1000;
        }
        
        .calendar-tooltip.show {
            opacity: 1;
        }
        
        .calendar-tooltip::before {
            content: '';
            position: absolute;
            top: -4px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 4px solid rgba(0, 0, 0, 0.8);
        }
        
        
        .calendar-nav-btn.nav-hover {
            transform: scale(1.1);
        }
        
        @media screen and (max-width: 768px) {
            .calendar-tooltip {
                font-size: 10px;
                padding: 3px 6px;
                bottom: -20px;
            }
        }
        </style>
    `;

    // キーボードナビゲーション機能
    var KeyboardNavigation = {
        
        init: function() {
            this.bindKeyboardEvents();
        },

        bindKeyboardEvents: function() {
            // カレンダー内での矢印キーナビゲーション
            $(document).on('keydown', '.calendar-day', function(e) {
                var $current = $(this);
                var $next;

                switch(e.keyCode) {
                    case 37: // 左矢印
                        $next = $current.prev('.calendar-day:not(.empty)');
                        break;
                    case 39: // 右矢印
                        $next = $current.next('.calendar-day:not(.empty)');
                        break;
                    case 38: // 上矢印
                        $next = KeyboardNavigation.getVerticalNeighbor($current, -7);
                        break;
                    case 40: // 下矢印
                        $next = KeyboardNavigation.getVerticalNeighbor($current, 7);
                        break;
                }

                if ($next && $next.length > 0) {
                    e.preventDefault();
                    $next.focus();
                }
            });
        },

        getVerticalNeighbor: function($current, offset) {
            var $days = $('.calendar-day:not(.empty)');
            var currentIndex = $days.index($current);
            var nextIndex = currentIndex + offset;
            
            if (nextIndex >= 0 && nextIndex < $days.length) {
                return $days.eq(nextIndex);
            }
            return null;
        }
    };

    // ドキュメント準備完了時に初期化
    $(document).ready(function() {
        console.log('カレンダーJavaScript初期化開始');
        
        // AJAX設定の確認
        if (typeof calendar_ajax !== 'undefined') {
            console.log('AJAX設定確認:', {
                ajax_url: calendar_ajax.ajax_url,
                nonce: calendar_ajax.nonce ? 'あり' : 'なし'
            });
        } else {
            console.error('calendar_ajax が定義されていません');
        }
        
        // ツールチップCSSを動的に追加
        $('head').append(tooltipCSS);
        
        // 各機能を初期化
        FishingCalendar.init();
        CalendarEffects.init();
        KeyboardNavigation.init();

        // カレンダーが存在する場合のみフォーカス管理を設定
        if ($('.fishing-calendar-container').length > 0) {
            console.log('カレンダーコンテナ発見:', $('.fishing-calendar-container').length + '個');
            
            // 初期フォーカスを設定（アクセシビリティ）
            $('.calendar-day.has-posts:first').attr('tabindex', '0');
            $('.calendar-day:not(.has-posts)').attr('tabindex', '-1');
            $('.calendar-nav-btn').attr('tabindex', '0');
            
            // ドロップダウンの存在確認
            console.log('年セレクタ:', $('.year-selector').length + '個');
            console.log('月セレクタ:', $('.month-selector').length + '個');
        } else {
            console.log('カレンダーコンテナが見つかりませんでした');
        }
        
        console.log('カレンダーJavaScript初期化完了');
    });

    // パフォーマンス最適化: スクロール時の処理制御
    var scrollTimer;
    $(window).on('scroll', function() {
        clearTimeout(scrollTimer);
        scrollTimer = setTimeout(function() {
            // スクロール位置に基づく処理（将来の拡張用）
        }, 100);
    });

    // リサイズ時の対応
    var resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // レスポンシブ対応の追加処理（将来の拡張用）
        }, 250);
    });

})(jQuery);