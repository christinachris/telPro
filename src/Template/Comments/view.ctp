<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comment $comment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Comment'), ['action' => 'edit', $comment->comment_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Comment'), ['action' => 'delete', $comment->comment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->comment_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Comments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Comment'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="comments view large-9 medium-8 columns content">
    <h3><?= h($comment->comment_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Comment Desc') ?></th>
            <td><?= h($comment->comment_desc) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Id') ?></th>
            <td><?= $this->Number->format($comment->comment_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Comment Date') ?></th>
            <td><?= h($comment->comment_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('task_id') ?></th>
            <td><?= h($comment->task_id) ?></td>
        </tr>
    </table>
</div>
