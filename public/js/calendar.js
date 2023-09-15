$(function () {
  //開く//
  $('.js-open-button').on('click', function () {
    $('.modal-contact').fadeIn();
    var title = $(this).attr('data-title');
    $('.data-title input').data(title);//valだと文字出力できない//
    return false;


  });
  //閉じる//
  $('.js-close-button').on('click', function () {
    $('.modal-contact').fadeOut();
    return false;
  });
});
