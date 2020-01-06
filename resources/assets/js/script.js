try {
    $(document).ready(function () {

        $(".btn-edit").on("click", function () {
            var text = $(this).parents(".post-item").find(".post-content").text();
            var url = $(this).data('url');

            $("textarea#textPostEdit").val(text);

            $(".form-create").css("display", "none");
            $(".form-edit").css("display", "block").attr('action', url);

            $('html,body').animate({scrollTop: $(".create-post").offset().top},'slow');
        });
    });
} catch (e) {
}
