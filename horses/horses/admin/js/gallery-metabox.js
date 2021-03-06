jQuery(document).ready(function () {
    jQuery(function ($) {

        var file_frame;

        $(document).on('click', '#horse_gallery a.gallery-add', function (e) {

            e.preventDefault();

            if (file_frame)
                file_frame.close();

            file_frame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader-title'),
                button: {
                    text: $(this).data('uploader-button-text'),
                },
                multiple: true
            });

            file_frame.on('select', function () {
                var listIndex = $('#horse-gallery-list li').index($('#horse-gallery-list li:last')),
                        selection = file_frame.state().get('selection');

                selection.map(function (attachment, i) {
                    attachment = attachment.toJSON(),
                            index = listIndex + (i + 1);

                    $('#horse-gallery-list').append('<li><input type="hidden" name="horse_gallery_id[' + index + ']" value="' + attachment.id + '"><img class="image-preview" src="' + attachment.sizes.thumbnail.url + '"><a class="change-image button button-small" href="#" data-uploader-title="Поменять картинку" data-uploader-button-text="Поменять картинку"><i class="fas fa-pencil-alt"></i></a>Поменять картинку<br><small><a class="remove-image" href="#"><i class="fas fa-times"></i></a>Удалить картинку</small></li>');
                });
            });

            makeSortable();

            file_frame.open();

        });

        $(document).on('click', '#horse_gallery a.change-image', function (e) {

            e.preventDefault();

            var that = $(this);

            if (file_frame)
                file_frame.close();

            file_frame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader-title'),
                button: {
                    text: $(this).data('uploader-button-text'),
                },
                multiple: false
            });

            file_frame.on('select', function () {
                attachment = file_frame.state().get('selection').first().toJSON();

                that.parent().find('input:hidden').attr('value', attachment.id);
                that.parent().find('img.image-preview').attr('src', attachment.sizes.thumbnail.url);
            });

            file_frame.open();

        });

        function resetIndex() {
            $('#horse-gallery-list li').each(function (i) {
                $(this).find('input:hidden').attr('name', 'horse_gallery_id[' + i + ']');
            });
        }

        function makeSortable() {
            $('#horse-gallery-list').sortable({
                opacity: 0.6,
                stop: function () {
                    resetIndex();
                }
            });
        }

        $(document).on('click', '#horse-gallery a.remove-image', function (e) {
            e.preventDefault();

            $(this).parents('li').animate({opacity: 0}, 200, function () {
                $(this).remove();
                resetIndex();
            });
        });

        makeSortable();

    });
});