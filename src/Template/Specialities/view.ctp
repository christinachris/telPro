<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Speciality $speciality
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Speciality'), ['action' => 'edit', $speciality->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Speciality'), ['action' => 'delete', $speciality->id], ['confirm' => __('Are you sure you want to delete # {0}?', $speciality->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Specialities'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Speciality'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Talents'), ['controller' => 'Talents', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Talent'), ['controller' => 'Talents', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="specialities view large-9 medium-8 columns content">
    <h3><?= h($speciality->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($speciality->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($speciality->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($speciality->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Talents') ?></h4>
        <?php if (!empty($speciality->talents)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('First Name') ?></th>
                <th scope="col"><?= __('Last Name') ?></th>
                <th scope="col"><?= __('Preferred Name') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Phone No') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('Speciality') ?></th>
                <th scope="col"><?= __('Username') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Occupied') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Cost') ?></th>
                <th scope="col"><?= __('Response Time') ?></th>
                <th scope="col"><?= __('Quality OfWork') ?></th>
                <th scope="col"><?= __('Position') ?></th>
                <th scope="col"><?= __('Speciality Id') ?></th>
                <th scope="col"><?= __('Skill Categories Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($speciality->talents as $talents): ?>
            <tr>
                <td><?= h($talents->id) ?></td>
                <td><?= h($talents->first_name) ?></td>
                <td><?= h($talents->last_name) ?></td>
                <td><?= h($talents->preferred_name) ?></td>
                <td><?= h($talents->email) ?></td>
                <td><?= h($talents->phone_no) ?></td>
                <td><?= h($talents->address) ?></td>
                <td><?= h($talents->speciality) ?></td>
                <td><?= h($talents->username) ?></td>
                <td><?= h($talents->password) ?></td>
                <td><?= h($talents->occupied) ?></td>
                <td><?= h($talents->url) ?></td>
                <td><?= h($talents->cost) ?></td>
                <td><?= h($talents->response_time) ?></td>
                <td><?= h($talents->quality_ofWork) ?></td>
                <td><?= h($talents->position) ?></td>
                <td><?= h($talents->speciality_id) ?></td>
                <td><?= h($talents->skill_categories_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Talents', 'action' => 'view', $talents->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Talents', 'action' => 'edit', $talents->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Talents', 'action' => 'delete', $talents->id], ['confirm' => __('Are you sure you want to delete # {0}?', $talents->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
