<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Artist $artist
 */
?>

<div class="column column-80">
    <div class="artists view content">
        <h3><?= h($artist->name) ?></h3>
        <div class="related">
            <?php if (!empty($artist->albums)) : ?>
            <div class="table-responsive">
                <table>
                    <tr>
                        <th><?= __('Name') ?></th>
                        <th><?= __('Albums') ?></th>
                        <th><?= __('Release Year') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($artist->albums as $album) : ?>
                    <tr>
                        <td><?= h($album->name) ?></td>
                        <td>
                            <iframe src="<?= h($album->url) ?>" width="230" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                        </td>
                        <td><?= h($album->release_year) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Albums', 'action' => 'view', $album->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Albums', 'action' => 'edit', $album->id]) ?>
                            <?= $this->Form->postLink(
                                __('Delete'),
                                ['controller' => 'Albums', 'action' => 'delete', $album->id],
                                [
                                    'method' => 'delete',
                                    'confirm' => __('Are you sure you want to delete # {0}?', $album->id),
                                ]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
