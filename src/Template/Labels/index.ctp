<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Label[]|\Cake\Collection\CollectionInterface $labels
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Label'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="labels index large-9 medium-8 columns content">
    <h3><?= __('Labels') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('label_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('label_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('label_colour') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($labels as $label): ?>
            <tr>
                <td><?= $this->Number->format($label->label_id) ?></td>
                <td><?= h($label->label_name) ?></td>
                <td><?= h($label->label_colour) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $label->label_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $label->label_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $label->label_id], ['confirm' => __('Are you sure you want to delete # {0}?', $label->label_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
