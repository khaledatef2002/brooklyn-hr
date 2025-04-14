$('.auto-image-show input[type="file"]').on('change', function() {
    var file = this.files[0];
    var input = $(this)
    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            input.closest(".auto-image-show").find("img").attr('src', e.target.result);
        }

        reader.readAsDataURL(file);
    }
});