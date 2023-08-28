$(function() {
  $('#header .search').click(function() {
    $(this).children('.search-form').show()
  })
  $(window).click(function(e) {
    if (!$('.search').is(e.target) && $('.search').has(e.target).length == 0) {
      $('.search-form').hide();
    }
  })
  $('.icon-menu').click(function() {
    $('.overlay').show();
    $('.menu-mobile').css('transform','translateX(0)');
  })
  $('.close').click(function() {
    $('.menu-mobile').css('transform','translateX(-100%)');
    $('.overlay').hide();
  })
  $('.overlay').click(function() {
    $('.menu-mobile').css('transform','translateX(-100%)');
    $(this).hide();
  })
  $('#product .tab-item').click(function() {
    $('#product .tab-item').removeClass('active')
    $(this).addClass('active')
    let id = $(this).attr('data-id')
    $('#product .tab-detail').removeClass('active')
    $('#product .tab-content .tab-detail:nth-child(' + id + ')').addClass('active')
  })
  $('#list-product .tab-item').click(function() {
    $('#list-product .tab-item').removeClass('active')
    $(this).addClass('active')
    let id = $(this).attr('data-id')
    $('#list-product .tab-detail').removeClass('active')
    $('#list-product .tab-content .tab-detail:nth-child(' + id + ')').addClass('active')
  })
  $('#list-product .swiper-slide').click(function() {
    let id = $(this).attr('data-id')
    $('#list-product .tab-detail').removeClass('active')
    $('#list-product .tab-content .tab-detail:nth-child(' + id + ')').addClass('active')
  })
  $("#banner-video").click(function(){
    $('#header .overlay').show()
    const video = $('#banner-video .video-detail').html()
    $('#header .overlay .content').html(video)
  })

})