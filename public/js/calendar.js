$(function () {
  //開く//
  $('.js-open-button').on('click', function () {
    $('.modal-contact').fadeIn();
    var title = $(this).attr('date_title');
    $('.modal-title input').val(title);
    return false;


  });
  //閉じる//
  $('.js-close-button').on('click', function () {
    $('.modal-contact').fadeOut();
    return false;
  });
});
