$(function () {
  //開く//
  $('.js-open-button').on('click', function () {
    $('.modal-contact').fadeIn();
    var title = $(this).attr('data-title');
    $('.data-title text').text(title);
    var time = $(this).attr('data-time');
    $('.data-time text').text(time);
    return false;


  });
  //閉じる//
  $('.js-close-button').on('click', function () {
    $('.modal-contact').fadeOut();
    return false;
  });
});
