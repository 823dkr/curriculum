$(function () {
var feed = $('.js-feed-toggle');
var feedCreatureId;

feed.on('click', function () {
    var $this = $(this);
    feedCreatureId = $this.data('creatureid');
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
//lovedクラスを追加
            $this.toggleClass('loved'); 

//.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
            $this.next('.feedsCount').html(data.creatureFeedsCount); 

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