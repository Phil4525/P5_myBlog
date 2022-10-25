<div class="d-flex" id="<?= $comment->id ?>">
    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
    <div class="ms-3 mb-3">
        <div class="fw-bold"><?= $comment->author ?></div>
        <div class="text-muted fst-italic"><small>le <?= $comment->frenchCreationDate ?></small></div>
        <p><?= $comment->comment ?></p>
        <!-- modify or reply condition -->
        <?php if (isset($session) && $session['username'] == $comment->author) { ?>
            <a href="" data-bs-toggle="modal" data-bs-target="#updateComment-<?= $comment->id ?>"><small>(Modifier)</small></a>
            <a href="" data-bs-toggle="modal" data-bs-target="#deleteComment-<?= $comment->id ?>"><small>(Supprimer)</small></a>
        <?php } ?>
        <?php if (isset($session) && $session['username'] !== $comment->author) { ?>
            <a href="" data-bs-toggle="modal" data-bs-target="#replyTo-<?= $comment->id ?>"><small>(Repondre)</small></a>
        <?php } ?>
    </div>
</div>
<!-- update comment modal -->
<div class="modal fade" id="updateComment-<?= $comment->id ?>" tabindex="-1" aria-labelledby="updateCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier votre commentaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="mb-4" action="index.php?action=updateComment&id=<?= $comment->id ?>" method="post">
                    <div class="form-group mb-5">
                        <textarea class="form-control mb-2" rows="3" name="comment" placeholder="update your comment!"><?= $comment->comment ?></textarea>
                    </div>
                    <div class="modal-footer form-group">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- delete comment modal -->
<div class="modal fade" id="deleteComment-<?= $comment->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete your comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer ?</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a class="btn btn-primary" href="index.php?action=deleteComment&id=<?= urlencode($comment->id) ?>" role="button">Confirmer</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- reply to comment modal -->
<div class="modal fade" id="replyTo-<?= $comment->id ?>" tabindex="-1" aria-labelledby="replyToCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Répondre au commentaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="mb-4" action="index.php?action=addComment&id=<?= urlencode($post->id) ?>&parentCommentId=<?= $comment->id ?>" method="post">
                    <div class="form-group mb-5">
                        <textarea class="form-control mb-2" rows="3" name="comment" placeholder="Laissez un commentaire!"></textarea>
                    </div>
                    <div class="modal-footer form-group">
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div style="margin-left: 50px;">
    <?php if (isset($comment->children)) {
        foreach ($comment->children as $replies) {
            foreach ($replies as $comment) {
                require 'templates/comment.php';
            }
        }
    } ?>
</div>