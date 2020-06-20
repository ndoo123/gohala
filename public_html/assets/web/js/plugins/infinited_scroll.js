//Infinite scroll
$(window).on("scroll", function() {
 var scrollHeight = $(document).height();
  var scrollPos = $(window).height() + $(window).scrollTop();
  if ((scrollHeight - scrollPos) / scrollHeight == 0) {
 get_product();
    console.log("bottom!");
  }
});