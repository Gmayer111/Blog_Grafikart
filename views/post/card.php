<div class="col-md-3 mb-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlentities($post->getName()) ?></h5>
            <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
            <p><?=  $post->getExcerpt() ?></p>
            <a href="<?= $router->url('post', ['id' => $post->getId(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">Voir plus</a>
        </div>
    </div>  
</div>