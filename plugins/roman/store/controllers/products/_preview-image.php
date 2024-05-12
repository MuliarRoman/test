<?php if (!empty($record->preview->path)) : ?>
    <img style="object-fit: cover; border-radius: 50px;" width="83" height="83" src="<?= $record->preview->path; ?>" alt="nation flag" />
<?php endif; ?>