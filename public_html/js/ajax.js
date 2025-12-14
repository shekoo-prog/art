$(document).ready(function() {
    // Handle like button
    $('.like-btn').on('click', function() {
        const poemId = $(this).data('id');
        const countElement = $(this).find('.likes-count');
        const btn = $(this);
        $.post('ajax-like.php', { poem_id: poemId }, function(response) {
            if (response.success) {
                countElement.text(response.likes);
                btn.toggleClass('liked');
            } else {
                alert('خطأ: ' + response.message);
            }
        }, 'json');
    });

    // Handle comment button
    $('.comment-btn').on('click', function() {
        const poemId = $(this).data('id');
        // Load comments
        $.get('ajax-load-comments.php', { poem_id: poemId }, function(response) {
            $('.comments-list-modal').html(response.html);
            $('.add-comment-form-modal').data('poem-id', poemId);
            $('#commentModal').show();
        }, 'json');
    });

    // Handle modal close
    $('.close-btn').on('click', function() {
        $('#commentModal').hide();
    });

    $(window).on('click', function(event) {
        if (event.target.id === 'commentModal') {
            $('#commentModal').hide();
        }
    });

    // Handle comment form in modal
    $('.add-comment-form-modal').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const poemId = form.data('poem-id');
        const commentText = form.find('textarea').val();

        if (!commentText.trim()) return;

        $.post('ajax-comment.php', { poem_id: poemId, comment: commentText }, function(response) {
            if (response.success) {
                const html = '<div class="comment"><p>' + response.comment + '</p><small>' + response.timestamp + '</small></div>';
                $('.comments-list-modal').append(html);
                form.find('textarea').val('');
            } else {
                alert('خطأ: ' + response.message);
            }
        }, 'json');
    });

    // Handle share button (simplified, opens modal or copies URL)
    $('.share-btn').on('click', function() {
        const url = window.location.href;
        if (navigator.share) {
            navigator.share({
                title: 'قصيدة',
                url: url
            });
        } else {
            prompt('انسخ الرابط:', url);
        }
    });
});
