<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Request $request
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $artists
 */
?>
<?php
    $type = $this->request->getQuery('type') ?? 'artist'; // 如果没选，默认是 artist
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Requests'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="requests form content">
            <?= $this->Form->create(null, ['type' => 'get']) ?>
            <fieldset>
                <legend><?= __('Choose Request Type') ?></legend>
                <?= $this->Form->control('type', [
                    'type' => 'select',
                    'options' => ['artist' => 'Artist', 'album' => 'Album'],
                    'default' => $type,
                    'onchange' => 'this.form.submit()' // 选择后自动提交（需要一点JS）
                ]) ?>
            </fieldset>
            <?= $this->Form->end() ?>

            <!-- 主表单：添加请求 -->
            <?= $this->Form->create($request) ?>
            <fieldset>
                <?php
                    echo $this->Form->hidden('type', ['value' => $type]); // 保存类型

                    echo $this->Form->control('name');
                    echo $this->Form->control('url');

                    if ($type === 'album') {
                        echo $this->Form->control('release_year', ['empty' => true]);
                        echo $this->Form->control('artist_id', ['options' => $artists, 'empty' => true]);
                    }
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>