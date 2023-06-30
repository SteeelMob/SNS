// $(function () {
//     $('.slide-button').click(function () {
//         $(this).toggleClass('active');
//         if($(this).hasClass('active')) {
//             $('#user-profile ul li').fadeIn().addClass('active');
//         } else {
//             $('#user-profile ul li').fadeOut().removeClass('active');
//         }
//     });

//モーダル
// $(function(){
//     $('.js-modal-open').on('click',function () {
//         $('.js-modal').fadeIn();
//         var post_id = $(this).attr('post_id');
//         var post = $(this).attr('post');
//         $('.modal_id').val(post_id);
//         $('.modal_post').text(post);
//         return false;
//     });

//     $('.js-modal-close').on('click',function () {
//         $('.js-modal').fadeOut();
//         return false;
//     });
// });

// アコーディオンメニュー
jQuery(function($){
    $('.js-accordion-title').on('click',function(){
        //コンテンツ開閉
        $(this).next().slideToggle();
        //矢印向き
        $('.accordion-point').toggleClass('add');
    })
});

$(".js-accordion-title").click(function () {
    $(".accordion-point").toggleClass("add");
  });

// $(function(){
//     $('.menu li').hide();
//     $('.accordion dl dt').click(function(e){
//         $('.accordion dl dt').toggleClass("open");
//         $('.menu li').slideToggle('normal');
//     });
// });

// $(function(){
//     $(".drawer").click(function(){
//         $(".drawer-list").slideToggle();
//     });
// });



$(function(){
    // 編集ボタン(class="js-modal-open")が押されたら発火
    $('.js-modal-open').on('click',function(){
        // モーダルの中身(class="js-modal")の表示
        $('.js-modal').fadeIn();
        // 押されたボタンから投稿内容を取得し変数へ格納
        var post = $(this).attr('post');
        // 押されたボタンから投稿のidを取得し変数へ格納（どの投稿を編集するか特定するのに必要な為）
        var post_id = $(this).attr('post_id');

        // 取得した投稿内容をモーダルの中身へ渡す
        $('.modal_post').text(post);
        // 取得した投稿のidをモーダルの中身へ渡す
        $('.modal_id').val(post_id);
        return false;
    });

    // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
    $('.js-modal-close').on('click',function(){
        // モーダルの中身(class="js-modal")を非表示
        $('.js-modal').fadeOut();
        return false;
    });
});