$(function () {
  //開く//
  $('.js-open-button').on('click', function () {
    $('.modal-contact').fadeIn();
    var title = $(this).attr('data-title');
    $('.data-title text').text(title);
    $('.data').val(title);
    var time = $(this).attr('date-time');
    $('.date-time text').text(time);
    //timeが文字（リモ〇部）で取得されていたため数字に変換する内容//
    if (time == "リモ1部") {
      var part = 1
    } else if (time == "リモ２部") {
      var part = 2
    } else if (time == "リモ3部") {
      var part = 3
    }
    //値をpartに変換して反映する//
    $('.time').val(part);
    return false;

  });
  //閉じる//
  $('.js-close-button').on('click', function () {
    $('.modal-contact').fadeOut();
    return false;
  });
});
