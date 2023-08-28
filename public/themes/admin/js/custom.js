// Custom laravel-filemanager
// Prefix route
var route_prefix = "/admin/filemanager";
// config CKEDITOR
var ck_options = {
  language: 'en',
  uiColor: '#E0F2F4',
  height: 450,
  entities: false,
  fullPage: false,
  // allow style and css
  allowedContent: true,
  // auto wrap content in p tag
  autoParagraph: false,
  // Config file & image
  filebrowserImageBrowseUrl: route_prefix + '?type=other',
  filebrowserImageUploadUrl: route_prefix + '/upload?type=other&_token=',
  filebrowserBrowseUrl: route_prefix + '?type=file',
  filebrowserUploadUrl: route_prefix + '/upload?type=file&_token=',
};

// Use single input
(function($) {
  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      var target_input = $('#' + $(this).data('input'));
      var target_preview = $('#' + $(this).data('preview'));
      // ThangNH add config to get type
      var _type = $(this).data('type');
      type = _type || type;
      // End ThangNH
      var w = 1200,
        h = 750;
      var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
      var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
      width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
      height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

      var left = ((width / 2) - (w / 2)) + dualScreenLeft;
      var top = ((height / 2) - (h / 2)) + dualScreenTop;

      window.open(route_prefix + '?type=' + type, 'FileManager', 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

      window.SetUrl = function(items) {

        var file_path = items.map(function(item) {
          return item.url;
        }).join(',');

        // set the value of the desired input to image url
        target_input.val('').val(file_path).trigger('change');

        // clear previous preview
        target_preview.html('');

        // set or change the preview image src
        items.forEach(function(item) {
          target_preview.append(
            $('<img>').css('height', '5rem').attr('src', item.thumb_url)
          );
        });

        // trigger change event
        target_preview.trigger('change');
      };
      return false;
    });
  }
})(jQuery);
$(function() {
  // js load change trạng thái hot và active
  $(document).on('click', '.lb-active', function() {
    event.preventDefault();
    let wrapActive = $(this).parents('.wrap-load-active');
    let urlRequest = wrapActive.data("url");
    let value = $(this).data("value");
    let type = $(this).data("type");
    let title = '';
    if (value=='active') {
        title = 'Bạn có chắc chắn muốn ẩn ' + type;
    } else {
        title = 'Bạn có chắc chắn muốn hiển thị ' + type;
    }
    Swal.fire({
        title: title,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, next step!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: urlRequest,
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        wrapActive.html(html);
                    }
                }
            });
        }
    })
  });
  $(document).on('change', '.lb-order', function() {
    event.preventDefault();
    let wrap = $(this);
    let urlRequest = wrap.data("url");
    let value = $(this).val();

    if (value !== '') {
        var number_regex = /([0-9]{1,})/;
        if (number_regex.test(value) == false) {
            alert('Số thứ tự của bạn không đúng định dạng!');
        } else {
            let title = '';
            title = 'Bạn có chắc chắn muốn đổi số thứ tự ';
            $.ajax({
                type: "GET",
                url: urlRequest,
                data: { order: value },
                dataType: "json",
                success: function(response) {
                    if (response.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });

                    } else {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: response.html,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                    // console.log( response.html);
                },
                error: function(response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: response.html,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    } else {
        alert('Bạn chưa điền số thứ tự');
    }
  });
  $(document).on('click', '.lb-hot', function() {
    event.preventDefault();
    let wrapActive = $(this).parents('.wrap-load-hot');
    let urlRequest = wrapActive.data("url");
    let value = $(this).data("value");
    let type = $(this).data("type");
    let title = '';
    if (value) {
        title = 'Bạn có chắc chắn muốn bỏ nổi bật ' + type;
    } else {
        title = 'Bạn có chắc chắn muốn chuyển ' + type + ' sang nổi bật';
    }
    Swal.fire({
        title: title,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, next step!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: urlRequest,
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        wrapActive.html(html);
                    }
                }
            });
        }
    })
  });
});