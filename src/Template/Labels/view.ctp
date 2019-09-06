<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Label $label
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Label'), ['action' => 'edit', $label->label_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Label'), ['action' => 'delete', $label->label_id], ['confirm' => __('Are you sure you want to delete # {0}?', $label->label_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Labels'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Label'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="labels view large-9 medium-8 columns content">
    <h3><?= h($label->label_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Label Name') ?></th>
            <td><?= h($label->label_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Label Colour') ?></th>
            <td><?= h($label->label_colour) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Label Id') ?></th>
            <td><?= $this->Number->format($label->label_id) ?></td>
        </tr>
    </table>
</div>
