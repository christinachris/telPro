<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Colour $colour
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Colour'), ['action' => 'edit', $colour->colour_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Colour'), ['action' => 'delete', $colour->colour_id], ['confirm' => __('Are you sure you want to delete # {0}?', $colour->colour_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Colours'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Colour'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="colours view large-9 medium-8 columns content">
    <h3><?= h($colour->colour_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Colour Name') ?></th>
            <td><?= h($colour->colour_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Colour Id') ?></th>
            <td><?= $this->Number->format($colour->colour_id) ?></td>
        </tr>
    </table>
</div>
