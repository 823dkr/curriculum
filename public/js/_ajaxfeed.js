$(function () {
var feed = $('.feed-toggle');
var feedCreatureId;
var text =$('.feed-toggle').text();
//console.log('test');
    feed.on('click', function () {
    var $this = $(this);
    feedCreatureId = $this.data('creature-id');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/ajaxfeed',  //routeの記述
            type: 'POST', //受け取り方法の記述（GETもある）
            data: {
                'creature_id': feedCreatureId //コントローラーに渡すパラメーター
            },
        })

        // Ajaxリクエストが成功した場合
        .done(function (data) {
        //feededクラスを追加
            $this.toggleClass('feeded'); 
        })

        // Ajaxリクエストが失敗した場合
        .fail(function (data, xhr, err) {

        //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
        //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
            console.log('エラー');
            console.log(err);
            console.log(xhr);
        });

        return false;
    });
});