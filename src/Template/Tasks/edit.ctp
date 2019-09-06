<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task $task
 */


?>

<!--

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
    __('Delete'),
    ['action' => 'delete', $task->id],
    ['confirm' => __('Are you sure you want to delete # {0}?', $task->id)]
)
?></li>
        <li><?= $this->Html->link(__('List Tasks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Projects'), ['controller' => 'Projects', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Project'), ['controller' => 'Projects', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Status'), ['controller' => 'Status', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Status'), ['controller' => 'Status', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Colours'), ['controller' => 'Colours', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Colour'), ['controller' => 'Colours', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Labels'), ['controller' => 'Labels', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Label'), ['controller' => 'Labels', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tasks form large-9 medium-8 columns content">
    <?= $this->Form->create($task) ?>
    <fieldset>
        <legend><?= __('Edit Task') ?></legend>
        <?php
echo $this->Form->control('task_name');
echo $this->Form->control('create_date');
echo $this->Form->control('due_date', ['empty' => true]);
echo $this->Form->control('description');
echo $this->Form->control('project_id', ['options' => $projects, 'empty' => true]);
echo $this->Form->control('status_id', ['options' => $status, 'empty' => true]);
echo $this->Form->control('colour_id', ['options' => $colours, 'empty' => true]);
//            echo $this->Form->control('comment_id', ['options' => $comments]);
echo $this->Form->control('label_id', ['options' => $labels]);
?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
-->
<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Edit Task Details
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <?= $this->Form->create($task) ?>

        <div class="kt-portlet__body">
            <div class="kt-form__content">
                <div class="kt-alert m-alert--icon alert alert-danger kt-hidden" role="alert" id="kt_form_1_msg">
                    <div class="kt-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="kt-alert__text">
                        Oh snap! Change a few things up and try submitting again.
                    </div>
                    <div class="kt-alert__close">
                        <button type="button" class="close" data-close="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group row kt-margin-b-20">
                <?php echo $this->Form->control('task_name', [
                    'templates' => ['inputContainer' => '{{content}}'],
                    'class' => 'form-control col-lg-4 col-md-6 col-sm-12',
                    'label' => [
                        'class' => 'col-form-label col-lg-3 col-sm-12',
                        'text' => 'Task Title'
                    ]
                ]); ?>
            </div>

            <?php echo $this->Form->hidden('create_date', ['value' => $task->create_date]); ?>
            <div class="form-group row">
                <?php echo $this->Form->control('due_date', [
                    'templates' => ['inputContainer' => '{{content}}'],
                    'class' => 'input-group date form-control col-lg-4 col-md-6 col-sm-12 ',
                    'type' => 'text',
                    'id' => 'kt_datetimepicker_2', // this ID is fixed, using for Helper Datepicker !
                    'label' => [
                        'class' => 'col-form-label col-lg-3 col-sm-12',
                        'text' => 'Task Due Date'
                    ]
                ]); ?>
                <div class="input-group-append">
						<span class="input-group-text">
							<i class="la la-calendar"></i>
						</span>
                </div>
            </div>


            <div class="form-group row kt-margin-b-20">
                <?php
                $options = ['empty' => '     '];
                echo $this->Form->control('colour_id',
                    [
                        'templates' => ['inputContainer' => '{{content}}'],
                        'type' => 'select',
                        'options' => $options + $card_types,
                        'class' => 'form-control col-lg-6 col-md-7 col-sm-12',
                        'label' => [
                            'class' => 'col-form-label col-lg-3 col-sm-12',
                            'text' => 'Card Type'
                        ]
                    ]); ?>
            </div>


            <div class="kt-form__seperator kt-form__seperator--dashed kt-form__seperator--space"></div>
            <div class="form-group row ">
                <?php echo $this->Form->control('description', [
                    'templates' => ['inputContainer' => '{{content}}'],
                    'type' => 'textarea',
                    'data-provide' => 'markdown',
                    'row' => '10',
                    'class' => 'form-control ',
                    'label' => [
                        'class' => 'col-form-label col-lg-3 col-sm-12',
                        'text' => 'Description'
                    ]
                ]); ?>

            </div>
            <div class="form-group row kt-margin-b-20">
                <label class=" col-lg-3 col-sm-12"> Comments </label>
            <!--Begin::Portlet-->

                <div class="kt-portlet__body">
                            <div class="kt-timeline-v1 kt-timeline-v1--justified">
                                <div class="kt-timeline-v1__items">
                                    <div class="kt-timeline-v1__marker"></div>
                                    <?php foreach($comments as $comment) {  ?>
                                    <div class="kt-timeline-v1__item">
                                        <div class="kt-timeline-v1__item-circle">
                                            <div class="kt-bg-danger"></div>
                                        </div>

                                        <span class="kt-timeline-v1__item-time kt-font-brand" style="right: 0;">
															<?php echo $comment->comment_date; ?><span>AM</span>
														</span>
                                        <div class="kt-timeline-v1__item-content" style="padding: 1rem">
                                            <div class="kt-timeline-v1__item-title">
                                                Users Joined Today
                                            </div>
                                            <div class="kt-timeline-v1__item-body">

                                                <p>
                                                    <?php echo $comment->comment_desc; ?>
                                                </p>
                                            </div>
                                            <div class="kt-timeline-v1__item-actions">
                                               HERE has something.
                                            </div>
                                        </div>
                                    </div>
                                    <?php }; ?>
                        </div>
                    </div>
                </div>

            </div>
            <!--End::Portlet-->


            <?php
            echo $this->Form->hidden('project_id', ['value' => $task->project_id]);
            echo $this->Form->hidden('status_id', ['value' => $task->status_id]);
            echo $this->Form->hidden('label_id', ['value' => $task->label_id]);
            ?>
            <!--                <div class="form-group row">-->
            <!--                    <label class="col-form-label col-lg-3 col-sm-12">Select2 *</label>-->
            <!--                    <div class="col-lg-4 col-md-9 col-sm-12">-->
            <!--                        <select class="form-control m-select2" id="kt_select2" name="select2">-->
            <!--                            <option></option>-->
            <!--                            <optgroup label="Alaskan/Hawaiian Time Zone">-->
            <!--                                <option value="AK">Alaska</option>-->
            <!--                                <option value="HI">Hawaii</option>-->
            <!--                            </optgroup>-->
            <!--                            <optgroup label="Pacific Time Zone">-->
            <!--                                <option value="CA">California</option>-->
            <!--                                <option value="NV">Nevada</option>-->
            <!--                                <option value="OR">Oregon</option>-->
            <!--                                <option value="WA">Washington</option>-->
            <!--                            </optgroup>-->
            <!--                            <optgroup label="Mountain Time Zone">-->
            <!--                                <option value="AZ">Arizona</option>-->
            <!--                                <option value="CO">Colorado</option>-->
            <!--                                <option value="ID">Idaho</option>-->
            <!--                                <option value="MT">Montana</option>-->
            <!--                                <option value="NE">Nebraska</option>-->
            <!--                                <option value="NM">New Mexico</option>-->
            <!--                                <option value="ND">North Dakota</option>-->
            <!--                                <option value="UT">Utah</option>-->
            <!--                                <option value="WY">Wyoming</option>-->
            <!--                            </optgroup>-->
            <!--                        </select>-->
            <!--                        <span class="form-text text-muted">Select an option</span>-->
            <!--                    </div>-->
            <!--                </div>-->

            <!--                <div class="kt-form__seperator kt-form__seperator--dashed kt-form__seperator--space"></div>-->
            <!--                <div class="form-group row">-->
            <!--                    <label class="col-form-label col-lg-3 col-sm-12">Markdown *</label>-->
            <!--                    <div class="col-lg-7 col-md-9 col-sm-12">-->
            <!--                        <textarea name="markdown" class="form-control" data-provide="markdown" rows="10"></textarea>-->
            <!--                        <span class="form-text text-muted">Enter some markdown content</span>-->
            <!--                    </div>-->
            <!--                </div>-->
        </div>

        <div id="taskid" value="<?php echo $task->id ?>" data-task-id="<?php echo $task->id ?>"
             data-url="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task->project_id]); ?>"
             data-project-id="<?php $task->project_id ?>"></div>

        <div class="kt-portlet__foot">
            <div class=" ">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 ml-lg-auto">

                        <?= $this->Html->link(
                            '<span class="btn btn-outline-secondary"> Back </span>',
                            ['action' => 'index', $task->project_id],
                            ['escape' => false]
                        ) ?>

                        <button type="button" class="btn btn-danger btn-custom" id="kt_sweetalert_demo_8"> Delete
                        </button>
                        <?php
                        $this->Form->setTemplates([
                            'button' => '<button{{attrs}}>{{text}}</button>'])
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <?= $this->Form->button('Submit ', [
                            'type' => 'submit',
                            'class' => 'btn btn-success col-3',
                            'escape' => false
                        ]);
                        ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Form-->
    </div>

    <!--end::Portlet-->
</div>

<!-- end:: Content -->
<?= $this->Html->script('https://code.jquery.com/jquery-1.12.4.js') ?>
<?= $this->Html->script('base/scripts.bundle.js') ?>
<script>
    $(function () {
        var taskId = $("#taskid").data("task-id");
        var url = $("#taskid").data("url");
        var projectId = $("#taskid").data("project-id");
        var fullurl = url + '/projects/' + projectId;
        $('#kt_sweetalert_demo_8').click(function (e) {
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url: '<?php echo $this->Url->build([
                            "controller" => "tasks",
                            "action" => "delete"
                        ]);?>' + '/' + taskId,
                        type: 'GET',
                        success: function (data) {
                            swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            window.location.href = url;
                        }
                    });
                }
            });
        });
    });
</script>
