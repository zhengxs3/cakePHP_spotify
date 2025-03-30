<div class="stats-page content">
    <h1>📊 Statistiques</h1>

    <h2>🔥 Top 5 Albums les Plus Favoris</h2>
    <ol>
        <?php foreach ($topAlbums as $item): ?>
            <li>
                <?php if ($item->has('album')): ?>
                    <?= h($item->album->name) ?> (<?= $item->count ?> favoris)
                <?php else: ?>
                    Album inconnu (ID: <?= $item->album_id ?>)
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>

    <h2>🥶 Bottom 5 Albums les Moins Favoris</h2>
    <ol>
        <?php foreach ($flopAlbums as $item): ?>
            <li>
                <?php if ($item->has('album')): ?>
                    <?= h($item->album->name) ?> (<?= $item->count ?> favoris)
                <?php else: ?>
                    Album inconnu (ID: <?= $item->album_id ?>)
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>

    <h2>👑 Top 5 Utilisateurs avec le Plus de Favoris</h2>
    <ol>
        <?php foreach ($topUsers as $item): ?>
            <li>
                <?php if ($item->has('user')): ?>
                    <?= h($item->user->username) ?> (<?= $item->count ?> favoris)
                <?php else: ?>
                    Utilisateur inconnu (ID: <?= $item->user_id ?>)
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</div>
