<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */
// my_connection is defined in your database config
use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\I18n\Time;
use Cake\Core\Configure;
$conn = ConnectionManager::get('default');
?>

<div class="kt-header__topbar">
    <?php
    $results = $conn
        ->execute('select * from tasks');
    $count = 0;
    foreach ($results

             as $task) {
        $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
        $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
        $datediff = date_diff($sys_date, $due_date);

        if ($datediff->days < 10) {
            $count = $count + 1
            ?>
            <?php
        }
        if (!empty($task['moved_date'])) {
            $moved_date = date_create_from_format('Y-m-d H:i:s', $task['moved_date']);
            $datediff_Moved = date_diff($moved_date, $sys_date);
            if ($task['status_id'] == 3) {
                if ($datediff_Moved->days > 5) {
                    $count = $count + 1;
                }
            }
        }

    }

    ?>
    <!--begin: Notifications -->
    <div class="kt-header__topbar-item dropdown">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,10px">
											<span class="kt-header__topbar-icon">
												<i class="flaticon2-bell-alarm-symbol"></i>
												<span class="kt-badge kt-badge--success kt-hidden"></span>
											</span>
            <span class="kt-badge kt-badge--danger"
                  style=" position: absolute;top: -5px;right: -5px; width:24px; height:24px ;opacity: 0.9 ; font-weight: 500;font-size: 15px"> <?php echo $count; ?></span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
            <form>

                <!--begin: Head -->
                <div class="kt-head kt-head--skin-light kt-head--fit-x" style="padding-bottom: 20px">
                    <h3 class="kt-head__title" style="text-align: center">
                        User Notifications
                        <span class="btn btn-label-primary btn-sm btn-bold btn-font-md"><?php echo $count ?> new </span>
                    </h3>
                </div>

                <!--end: Head -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true"
                             data-height="300" data-mobile-height="200">
                            <?php
                            $results = $conn
                                ->execute('select * from tasks');

                            foreach ($results as $task) {
                                $due_date = date_create_from_format('Y-m-d H:i:s', $task['due_date']);
                                $sys_date = date_create_from_format('Y-m-d', date('Y-m-d'));
                                $datediff = date_diff($sys_date, $due_date);
                                if ($datediff->days < 10) {
                                    ?>
                                    <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index", $task['project_id']]); ?>" class="kt-notification__item">
                                        <div class="kt-notification__item-icon">
                                            <i class="flaticon2-line-chart kt-font-success"></i>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title">
                                                Task: <b> <?php echo $task["task_name"] ?> </b> is coming to the due
                                                date !
                                            </div>
                                            <div class="kt-notification__item-time">
                                                <?php echo $datediff->days ?> Days left
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                }
                                if (!empty($task['moved_date'])) {
                                    $moved_date = date_create_from_format('Y-m-d H:i:s', $task['moved_date']);
                                    $datediff_Moved = date_diff($moved_date, $sys_date);
                                    if ($task['status_id'] == 3) {
                                        if ($datediff_Moved->days > 5) { ?>
                                            <a href="<?php echo $this->Url->build(["controller" => "tasks", "action" => "index",  $task['project_id']]); ?>" class="kt-notification__item">
                                                <div class="kt-notification__item-icon">
                                                    <i class="flaticon2-bar-chart kt-font-info"></i>
                                                </div>
                                                <div class="kt-notification__item-details">
                                                    <div class="kt-notification__item-title">
                                                        Task: <b> <?php echo $task["task_name"] ?> </b> needs to be
                                                        followed up !
                                                    </div>
                                                    <div class="kt-notification__item-time">
                                                        <?php echo $datediff->days ?> Days passed
                                                    </div>
                                                </div>
                                            </a>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!--end: Notifications -->

    <!--begin: User bar -->
    <div class="kt-header__topbar-item kt-header__topbar-item--user">
        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,10px">
            <span class="kt-header__topbar-welcome kt-visible-desktop" style="font-size: 16px">G'day ,</span>
            <span class="kt-header__topbar-username kt-visible-desktop" style="font-size: 16px"><?php echo $this->Session->read('Auth.User.username') ?> ! </span>
            <span class="kt-header__topbar-icon kt-bg-brand kt-font-lg kt-font-bold kt-font-light kt-hidden">S</span>
            <span class="kt-header__topbar-icon kt-hidden"><i class="flaticon2-user-outline-symbol"></i></span>
        </div>
        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">

            <!--begin: Head -->
            <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                <div class="kt-user-card__avatar">


                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold kt-hidden">S</span>
                </div>
                <div class="kt-user-card__name">
                    <?php echo  $this->Session->read('Auth.User.role'). ":  ".  $this->Session->read('Auth.User.username') ?>
                </div>
<!--                <div class="kt-user-card__badge">-->
<!--                    <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">23 messages</span>-->
<!--                </div>-->
            </div>

            <!--end: Head -->

            <!--begin: Navigation -->
            <div class="kt-notification">
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-calendar-3 kt-font-success"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Profile-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            Account settings and more-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-mail kt-font-warning"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Messages-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            Inbox and tasks-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-rocket-1 kt-font-danger"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Activities-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            Logs and notifications-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <a href="#" class="kt-notification__item">-->
<!--                    <div class="kt-notification__item-icon">-->
<!--                        <i class="flaticon2-hourglass kt-font-brand"></i>-->
<!--                    </div>-->
<!--                    <div class="kt-notification__item-details">-->
<!--                        <div class="kt-notification__item-title kt-font-bold">-->
<!--                            My Tasks-->
<!--                        </div>-->
<!--                        <div class="kt-notification__item-time">-->
<!--                            latest tasks and projects-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </a>-->
                <div class="kt-notification__custom">
                    <?= $this->Html->link('<span class="btn btn-primary"><i class="flaticon2-plus]"></i> Sign Out</span>', ['controller' => 'Users', 'action' => 'logout', 'type' => 'button'], ['escape' => false]) ?>
<!--                    <a href="custom_user_login-v2.html" target="_blank" class="btn btn-label-brand btn-sm btn-bold">Sign-->
<!--                        Out</a>-->
                </div>
            </div>

            <!--end: Navigation -->
        </div>
    </div>
    <!--end: User bar -->

</div>
<!-- end:: Header Topbar -->
</div>
</div>
</div>
<!-- end:: Header -->

<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">

                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--active " aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Talents', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Clients', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
                </ul>

            </div>

        </div>
        <!-- end: Header Menu -->
    </div>
</div>

<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
<!-- Header End -->

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
        <h3 class="kt-subheader__title">
            Dashboard </h3>
        </a>

        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
               class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>

                Project List

            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
    </div>
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            <div class="btn kt-subheader__btn-daterange" title="Select dashboard daterange">
                <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                <span class="kt-subheader__btn-daterange-date"
                      id="kt_dashboard_daterangepicker_date"><?php echo date("M d") ?></span>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect id="bound" x="0" y="0" width="24" height="24"/>
                        <path
                            d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                            id="check" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path
                            d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                            id="Combined-Shape" fill="#000000"/>
                    </g>
                </svg>
            </div>
        </div>
    </div>
</div>
<div class="kt-content kt-grid__item kt-grid__item--fluid">
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg" style="border-bottom: none ; padding-top: 20px ; padding-bottom: 30px" >
                <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
                    <div class="kt-portlet__head-title">
                        <div class="kt-input-icon kt-input-icon--left">
                            <input type="text" onkeyup="myFunction()" class="form-control"
                                   placeholder="Search Project Name ..." id="generalSearch">
                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
																<span><i class="la la-search"></i></span>
															</span>
                        </div>
                    </div>

                    <!--  Begin: progress status-->
                    <div class="kt-portlet__head-title" style="padding-left: 40px">
                        <?= $this->Form->create($projects) ?>
                         <?= $this->Form->input('Progress_Status', [
                             'id'=>'progressType',
                             'label'=>false,
                             'type'=>'select',
                             'options' => array('All','Progressing','Completed'),
                             'class'=>'btn btn-secondary dropdown-toggle',
                             'empty'=>false
                             ]); ?>
                    </div>
                    <div class="kt-portlet__head-title" style="padding-left: 10px">
                        <?= $this->Form->button('<i class="la la-search"></i>',['class'=>'btn btn-brand kt-btn btn-sm kt-btn--icon','data-toggle' => "kt-popover", 'data-content' => "Query project progress", 'data-placement' => 'bottom','escape'=>false]) ?>

                       <!--<button class="btn btn-brand kt-btn btn-sm kt-btn&#45;&#45;icon" >-->
                       							  <!--<span>-->
                       							    <!--<i class="la la-search"></i>-->

                       							  <!--</span>-->
                       <!--</button>-->
                    </div>
                    <!-- End: progress status -->
                    <?= $this->Form->end() ?>



                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="dropdown dropdown-inline">
                            <?= $this->Html->link('<span class="btn btn-brand btn-icon-sm"><i class="flaticon2-plus"></i> Add New Project</span>',
                                ['controller' => 'projects', 'action' => 'add', 'type' => 'button'], ['escape' => false]) ?>
                            <?= $this->Html->link('<span class="btn btn-outline-primary"><i class="flaticon-eye"></i> View Archive</span>', ['controller' => 'Projects', 'action' => 'archiveIndex', 'type' => 'button'], ['escape' => false]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--        <div class="kt-portlet__body" style="padding: 0px; padding-left: 15px ; padding-bottom: 5px">-->
            <!--            <!--begin: Search Form -->
            <!--            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">-->
            <!--                <div class="row align-items-center">-->
            <!--                    <div class="col-xl-8 order-2 order-xl-1">-->
            <!--                        <div class="row align-items-center">-->
            <!--                            <div class="col-md-6 kt-margin-b-20-tablet-and-mobile">-->
            <!--                                <div class="kt-input-icon kt-input-icon--left">-->
            <!--                                    <input type="text" onkeyup="myFunction()" class="form-control"-->
            <!--                                           placeholder="Search Project Name ..." id="generalSearch">-->
            <!--                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">-->
            <!--																<span><i class="la la-search"></i></span>-->
            <!--															</span>-->
            <!--                                </div>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!---->
            <!--            <!--end: Search Form -->
            <!--        </div>-->
            <div class="kt-portlet__body kt-portlet__body--fit" style="padding-top: 25px">
                <!--begin: Datatable -->
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th style="width: 5%">
                        </th>
                        <th style="width: 15%"><?= $this->Paginator->sort('project_name') ?></th>
                        <th style="width: 20%"><?= $this->Paginator->sort('progress_num') ?></th>
                        <th style="width: 7%"><?= $this->Paginator->sort('start_date') ?></th>
                        <th style="width: 7%"><?= $this->Paginator->sort('end_date') ?></th>
                        <th style="width: 10%"><?= __('Client') ?></th>
                        <th style="width: 25%"><?= __('Allocated Talent') ?></th>
                        <th style="width: 10%" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr id="count">
                            <td>
                                <?= $this->Html->image("Clipboard.svg", [
                                    "alt" => "Task Board",
                                    'class' => 'flip-in-hor-bottom',
                                    'style' => 'height: 40px ;align-content: center ',
                                    'url' => ['controller' => 'Tasks', 'action' => 'index', $project->id],
                                    'data-toggle' => "kt-popover", 'data-content' => "View Task Board", 'data-placement' => 'bottom'
                                ]); ?>
                            </td>
                            <td><?= $this->Html->link($project->project_name, ['controller' => 'Projects', 'action' => 'edit', $project->id,],['data-toggle' => "kt-popover", 'data-content' => "Edit Project", 'data-placement' => 'bottom']) ?></td>
                            <!--    <td><?= h($project->project_name) ?></td> -->
                            <td>
                                <div class="progress" style="font-size: 15px ;height: 20px ; font-weight: 500">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                         role="progressbar"
                                         aria-valuenow="<?= $this->Number->format($project->progress_num) ?>"
                                         aria-valuemin="0" aria-valuemax="100"
                                         style="width: <?= $this->Number->format($project->progress_num) ?>% "><?= $this->Number->format($project->progress_num) ?>
                                        %
                                    </div>
                                </div>
                            </td>
                            <?php if(sizeOf($project->start_date)>0){ ?>
                            <td><?php echo date_format($project->start_date, "d M Y "); ?></td>
                            <?php } else { ?> <td></td> <?php } ?>
                            <?php if(sizeOf($project->end_date)>0){ ?>
                            <td><?php echo date_format($project->end_date, "d M Y "); ?></td>
                            <?php } else { ?> <td></td> <?php } ?>
                            <td><?= $project->has('client') ? $this->Html->link($project->client->first_name . ' ' . $project->client->last_name, ['controller' => 'Clients', 'action' => 'view', $project->client->id],['data-toggle' => "kt-popover", 'data-content' => "View Client Details", 'data-placement' => 'bottom']) : '' ?></td>
                            <td>
                                <div class=""><?php foreach ($project->talents as $talent) { ?>
                                        <span
                                            class=" rotate-center kt-badge kt-badge--primary  kt-badge--inline kt-badge--pill kt-badge--md"
                                            style="margin-bottom: 8px">
                        <?= $project->has('talents') ? $this->Html->link($talent->first_name . ' ' . $talent->last_name, ['controller' => 'Talents', 'action' => 'view', $talent->id], ['class' => 'alinkcolor','data-toggle' => "kt-popover", 'data-content' => "View Talent Details", 'data-placement' => 'bottom']) : '' ?>
                        </span>
                                    <?php } ?>
                                </div>
                            </td>
                            <td class="actions">
                                 <?= $this->Html->link($this->Html->tag('i', '', array('class' => 'btn btn-lg btn-clean  la la-edit', 'style' => 'padding : 5px ; font-size: 25px','data-toggle' => "kt-popover", 'data-content' => "Edit Project", 'data-placement' => 'bottom')) . '', array('controller' => 'projects', 'action' => 'edit', $project->id), array('escape' => false)) ?>

                                <?= $this->Form->postLink(' ', ['action' => 'archive', $project->id], ['confirm' => __('Are you sure you want to archive this project?'), 'class' => "btn btn-lg btn-clean  la la-archive",'style' => 'padding : 5px ; font-size: 25px', 'data-toggle' => "kt-popover", 'data-content' => "Archive Project", 'data-placement' => 'bottom'], ['confirm' => __('Are you sure you want to delete {0}?', $project->project_name)]) ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="kt-pagination  kt-pagination--brand" style="margin: 10px">
                    <ul class="kt-pagination__links">
                        <div class="kt-pagination__link--first">
                            <?= $this->Paginator->first('<i class="fa fa-angle-double-left kt-font-brand"></i> ', ['escape' => false]) ?>
                        </div>
                        <?= $this->Paginator->prev('<i class="fa fa-angle-left kt-font-brand"></i> ', ['escape' => false]) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next('<i class="fa fa-angle-right kt-font-brand"></i>', ['escape' => false]) ?>
                        <?= $this->Paginator->last('<i class="fa fa-angle-double-right kt-font-brand"></i>', ['escape' => false]) ?>
                    </ul>
                    <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .kt-pagination {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
        margin: 0;
        padding: 0;
    }

    .kt-pagination .kt-pagination__links, .kt-pagination .kt-pagination__links li a {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .kt-pagination .kt-pagination__links {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .kt-pagination .kt-pagination__links li {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        margin-right: 0.5rem;
        border-radius: 4px;
    }

    .kt-pagination .kt-pagination__links li a {
        font-weight: 600;
        color: #a7abc3;
        font-size: 1.1rem;
        padding: 0 0.2rem;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        min-width: 30px;
        min-height: 30px;
        margin: 0;
    }

    .kt-pagination .kt-pagination__links .kt-pagination__link--active a {
        color: #ffffff;
    }

    .kt-pagination .kt-pagination__toolbar {
        margin: 0;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 0;
    }

    .kt-pagination .kt-pagination__toolbar .form-control {
        padding: 0;
        margin-right: 10px;
        height: 30px;
        font-weight: 600;
        font-size: 1.1rem;
        font-weight: 500;
        line-height: 1;
        outline: none;
        border: none;
    }

    .kt-pagination .kt-pagination__toolbar .pagination__desc {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        font-weight: 500;
        color: #a7abc3;
    }

    .kt-pagination.kt-pagination--brand .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--brand .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--brand .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--brand .kt-pagination__links .kt-pagination__link--last {
        background: rgba(113, 106, 202, 0.1);
    }

    .kt-pagination.kt-pagination--brand .kt-pagination__links .kt-pagination__link--active {
        background: #716aca;
    }

    .kt-pagination.kt-pagination--brand .kt-pagination__links li:hover {
        background: #716aca;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--brand .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--brand .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--brand .kt-pagination__toolbar .form-control {
        background: rgba(113, 106, 202, 0.1);
    }

    .kt-pagination.kt-pagination--light .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--light .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--light .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--light .kt-pagination__links .kt-pagination__link--last {
        background: rgba(255, 255, 255, 0.1);
    }

    .kt-pagination.kt-pagination--light .kt-pagination__links .kt-pagination__link--active {
        background: #ffffff;
    }

    .kt-pagination.kt-pagination--light .kt-pagination__links li:hover {
        background: #ffffff;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--light .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--light .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--light .kt-pagination__toolbar .form-control {
        background: rgba(255, 255, 255, 0.1);
    }

    .kt-pagination.kt-pagination--dark .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--dark .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--dark .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--dark .kt-pagination__links .kt-pagination__link--last {
        background: rgba(40, 42, 60, 0.1);
    }

    .kt-pagination.kt-pagination--dark .kt-pagination__links .kt-pagination__link--active {
        background: #282a3c;
    }

    .kt-pagination.kt-pagination--dark .kt-pagination__links li:hover {
        background: #282a3c;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--dark .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--dark .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--dark .kt-pagination__toolbar .form-control {
        background: rgba(40, 42, 60, 0.1);
    }

    .kt-pagination.kt-pagination--primary .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--primary .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--primary .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--primary .kt-pagination__links .kt-pagination__link--last {
        background: rgba(88, 103, 221, 0.1);
    }

    .kt-pagination.kt-pagination--primary .kt-pagination__links .kt-pagination__link--active {
        background: #5867dd;
    }

    .kt-pagination.kt-pagination--primary .kt-pagination__links li:hover {
        background: #5867dd;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--primary .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--primary .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--primary .kt-pagination__toolbar .form-control {
        background: rgba(88, 103, 221, 0.1);
    }

    .kt-pagination.kt-pagination--success .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--success .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--success .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--success .kt-pagination__links .kt-pagination__link--last {
        background: rgba(29, 201, 183, 0.1);
    }

    .kt-pagination.kt-pagination--success .kt-pagination__links .kt-pagination__link--active {
        background: #1dc9b7;
    }

    .kt-pagination.kt-pagination--success .kt-pagination__links li:hover {
        background: #1dc9b7;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--success .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--success .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--success .kt-pagination__toolbar .form-control {
        background: rgba(29, 201, 183, 0.1);
    }

    .kt-pagination.kt-pagination--info .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--info .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--info .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--info .kt-pagination__links .kt-pagination__link--last {
        background: rgba(85, 120, 235, 0.1);
    }

    .kt-pagination.kt-pagination--info .kt-pagination__links .kt-pagination__link--active {
        background: #5578eb;
    }

    .kt-pagination.kt-pagination--info .kt-pagination__links li:hover {
        background: #5578eb;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--info .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--info .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--info .kt-pagination__toolbar .form-control {
        background: rgba(85, 120, 235, 0.1);
    }

    .kt-pagination.kt-pagination--warning .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--warning .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--warning .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--warning .kt-pagination__links .kt-pagination__link--last {
        background: rgba(255, 184, 34, 0.1);
    }

    .kt-pagination.kt-pagination--warning .kt-pagination__links .kt-pagination__link--active {
        background: #ffb822;
    }

    .kt-pagination.kt-pagination--warning .kt-pagination__links li:hover {
        background: #ffb822;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--warning .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--warning .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--warning .kt-pagination__toolbar .form-control {
        background: rgba(255, 184, 34, 0.1);
    }

    .kt-pagination.kt-pagination--danger .kt-pagination__links .kt-pagination__link--first, .kt-pagination.kt-pagination--danger .kt-pagination__links .kt-pagination__link--next, .kt-pagination.kt-pagination--danger .kt-pagination__links .kt-pagination__link--prev, .kt-pagination.kt-pagination--danger .kt-pagination__links .kt-pagination__link--last {
        background: rgba(253, 57, 122, 0.1);
    }

    .kt-pagination.kt-pagination--danger .kt-pagination__links .kt-pagination__link--active {
        background: #fd397a;
    }

    .kt-pagination.kt-pagination--danger .kt-pagination__links li:hover {
        background: #fd397a;
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
    }

    .kt-pagination.kt-pagination--danger .kt-pagination__links li:hover a {
        color: #ffffff;
    }

    .kt-pagination.kt-pagination--danger .kt-pagination__links li:hover a i {
        color: #fff !important;
    }

    .kt-pagination.kt-pagination--danger .kt-pagination__toolbar .form-control {
        background: rgba(253, 57, 122, 0.1);
    }

    .kt-pagination.kt-pagination--circle .kt-pagination__links li {
        min-width: 30px;
        min-height: 30px;
        border-radius: 50%;
    }

    .kt-pagination.kt-pagination--lg .kt-pagination__links li a {
        font-size: 1.3rem;
        min-width: 35px;
        min-height: 35px;
    }

    .kt-pagination.kt-pagination--lg .kt-pagination__toolbar .form-control {
        height: 35px;
        font-size: 1.2rem;
        padding: 0.2rem 0 0.2rem 0.2rem;
    }

    .kt-pagination.kt-pagination--sm .kt-pagination__links li a {
        font-size: 1rem;
        min-width: 25px;
        min-height: 25px;
    }

    .kt-pagination.kt-pagination--sm .kt-pagination__toolbar .form-control {
        height: 25px;
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .kt-pagination .kt-pagination__links {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }

        .kt-pagination .kt-pagination__links li {
            margin: 0.3rem 0.5rem 0.3rem 0;
        }

        .kt-pagination .kt-pagination__links li a {
            font-size: 0.9rem;
            min-width: 25px;
            min-height: 25px;
        }

        .kt-pagination .kt-pagination__toolbar .form-control {
            height: 25px;
            font-size: 0.9rem;
            padding: 0.2rem 0 0.2rem 0.2rem;
        }
    }

    .flip-horizontal-bottom:hover {
        -webkit-animation: flip-horizontal-bottom 0.4s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
        animation: flip-horizontal-bottom 0.4s cubic-bezier(0.455, 0.030, 0.515, 0.955) both;
    }

    /* ----------------------------------------------
 * Generated by Animista on 2019-5-25 14:40:25
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

    /**
     * ----------------------------------------
     * animation flip-horizontal-bottom
     * ----------------------------------------
     */
    .flip-in-hor-bottom:hover {
        -webkit-animation: jello-horizontal 0.9s both;
        animation: jello-horizontal 0.9s both;
    }

    @-webkit-keyframes jello-horizontal {
        0% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
        30% {
            -webkit-transform: scale3d(1.25, 0.75, 1);
            transform: scale3d(1.25, 0.75, 1);
        }
        40% {
            -webkit-transform: scale3d(0.75, 1.25, 1);
            transform: scale3d(0.75, 1.25, 1);
        }
        50% {
            -webkit-transform: scale3d(1.15, 0.85, 1);
            transform: scale3d(1.15, 0.85, 1);
        }
        65% {
            -webkit-transform: scale3d(0.95, 1.05, 1);
            transform: scale3d(0.95, 1.05, 1);
        }
        75% {
            -webkit-transform: scale3d(1.05, 0.95, 1);
            transform: scale3d(1.05, 0.95, 1);
        }
        100% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
    }

    @keyframes jello-horizontal {
        0% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
        30% {
            -webkit-transform: scale3d(1.25, 0.75, 1);
            transform: scale3d(1.25, 0.75, 1);
        }
        40% {
            -webkit-transform: scale3d(0.75, 1.25, 1);
            transform: scale3d(0.75, 1.25, 1);
        }
        50% {
            -webkit-transform: scale3d(1.15, 0.85, 1);
            transform: scale3d(1.15, 0.85, 1);
        }
        65% {
            -webkit-transform: scale3d(0.95, 1.05, 1);
            transform: scale3d(0.95, 1.05, 1);
        }
        75% {
            -webkit-transform: scale3d(1.05, 0.95, 1);
            transform: scale3d(1.05, 0.95, 1);
        }
        100% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
    }

</style>
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("generalSearch");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    function myFunction2() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("generalSearch2");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<style>
    .alinkcolor {
        color: #fff;
    }

    .alinkcolor:hover {
        color: #fff;
    }
</style>
