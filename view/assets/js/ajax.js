/**
 * Usage:
 * <script>
 * </script>
 */
$(document).on('click', '[data-toggle="ajax"]', function (e) {
  var elm = $(e.target);

  if (elm.hasClass('disabled')) {
    return false;
  }

  var href = elm.data('href');

  $.ajax({
    url: href,
    type: 'POST',
    //data: sendData,
  }).done(function(data) {
    if ($.trim(data.message).length > 0) {
      alert(data.message);
    } else {
      window.location.reload();
    }
    return false;
  });
});