<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Task[]|\Cake\Collection\CollectionInterface $tasks
 */

use Cake\Datasource\ConnectionManager;
use Cake\I18n\I18n;
use Cake\I18n\Time;

//I18n::Locale('es-au');
// my_connection is defined in your database config
$conn = ConnectionManager::get('default');
?>
<?= $this->Flash->render() ?>

<!-- begin:: Header Topbar -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

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
            <span class="kt-header__topbar-username kt-visible-desktop" style="font-size: 16px"><?php echo $user_name ?> ! </span>
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
                    <?php echo $user_role. ":  ". $user_name ?>
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
<?= $this->Html->css('wizard-v3.demo8.css') ?>

<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">

                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item   " aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>" class="kt-menu__link "><span class="kt-menu__link-text">Projects </span></a></li>
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Talents', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Talent</span></a></li>
                    <li class="kt-menu__item kt-menu__item--active kt-menu__item--submenu kt-menu__item--rel" aria-haspopup="true"><a href="<?php echo $this->Url->build(['controller'=>'Clients', 'action'=>'index'])?>" class="kt-menu__link "><span class="kt-menu__link-text">Client</span></a></li>
                </ul>

            </div>

        </div>
        <!-- end: Header Menu -->
    </div>
</div>




<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">


            <div class="kt-subheader   kt-grid__item" id="kt_subheader">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        Dashboard </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                           <i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <a href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>"
                           class="kt-subheader__breadcrumbs-link">
                            Client List
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <span
                                class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active"><?= h($client->first_name) . " " . h($client->last_name) ?>
                            's Details</span>

                        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker"
                           data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
                            <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date"
                                  id="kt_dashboard_daterangepicker_date">Aug 16</span>

                            <!--<i class="flaticon2-calendar-1"></i>-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1"
                                 class="kt-svg-icon kt-svg-icon--sm">
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
                        </a>

                    </div>
                </div>
            </div>

            <div class="kt-content kt-grid__item kt-grid__item--fluid">
                <!-- begin:: Content -->
                <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body kt-portlet__body--fit">

                            <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white id="kt_wizard_v2"
                            data-ktwizard-state="first">

                            <div class="kt-grid__item kt-wizard-v2__aside" >

                                <!--begin: Form Wizard Nav -->
                                <div class="kt-wizard-v3__nav">
                                    <div class="kt-wizard-v3__nav-items">
                                        <a data-ktwizard-type="step" data-ktwizard-state="current">
                                            <a href="<?php echo $this->Url->build(['controller' => 'Clients',
                                                'action' => 'index']) ?>"
                                               class="btn btn-secondary  kt-font-transform-u">
                                                <i class="la la-long-arrow-left"></i>
                                                Back

                                            </a>
                                            <div style="margin-right: ;float:right;">
                                                <a >
                                                    <?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm" ><i class="flaticon2-note"></i></span>', ['action' => 'edit', $client->id], ['escape' => false, 'data-toggle' => "kt-popover", 'data-content' => "Edit Client", 'data-placement' => 'bottom']) ?>

                                                </a></div>
                                            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                                                 data-ktwizard-state="current">
                                                <div class="kt-heading kt-heading--md"><?= h($client->first_name).' '.($client->last_name) ?>
                                                <h6><p>
                                                        <?php if (!empty($client->emails)): ?>
                                                            <?php foreach ($client->emails as $emails): ?>
                                                                <?php if ($emails->is_primary == 1): ?>
                                                                        <?= h($emails->email_address) ?>
                                                                <?php endif; ?>
                                                                <br><br>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>

                                                    </p></h6>

                                                </div>

                                                <div class="kt-form__section kt-form__section--first">
                                                    <div class="kt-wizard-v3__review">
                                                        <div class="kt-wizard-v3__review-item">
                                                            <div class="kt-wizard-v2__review-content">

                                                                First Name:<br><h5> <?= h($client->first_name) ?></h5><br>
                                                                Last Name:<br> <h5><?= h($client->last_name) ?></h5><br>
                                                                Preferred Name:<br><h5> <?= h($client->preferred_name) ?></h5>
                                                                <br>
                                                                Phone Number: <br><h5>
                                                                    <?php if (!empty($client->phones)): ?>

                                                                        <?php foreach ($client->phones as $phones): ?>
                                                                            <a>Title</a>: <?= h($phones->title) . '  ' ?>,  Phone no: <?= h($phones->phone_no) ?>
                                                                            <br>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?></h5><br>
                                                                Email address:<br><h5>
                                                                    <?php if (!empty($client->emails)): ?>
                                                                        <?php foreach ($client->emails as $emails): ?>
                                                                            Title: <?= h($emails->title) . '  ' ?>, Email address: <?= h($emails->email_address) ?>
                                                                            <br><br>
                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?></h5><br>

                                                                Company Name:<br><h5> <?= h($client->company_name) ?></h5><br>
                                                                Url Address: <br><h5><?= h($client->address_url) ?></h5><br>
                                                                Credential:<br><h5> <?= h($client->credential) ?></h5><br>
                                                                Lifecycle Stage:<br><h5> <?= h($client->lifecycle_stage) ?></h5><br>
                                                                Last Contacted Date:<br><h5> <?= h($client->last_contactdate) ?></h5><br>



                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                                <!--end: Form Wizard Nav -->

                            </div>

                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper " >
                                <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" >

                                    <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3"
                                         data-ktwizard-state="step-first">
                                        <div class="kt-grid__item">

                                            <!--begin: Form Wizard Nav -->
                                            <div class="kt-wizard-v3__nav">
                                                <div class="kt-wizard-v3__nav-items">
                                                    <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                                                       data-ktwizard-state="current">
                                                        <div class="kt-wizard-v3__nav-body">
                                                            <div class="kt-wizard-v3__nav-label">
                                                                Notes
                                                            </div>
                                                            <div class="kt-wizard-v3__nav-bar"></div>
                                                        </div>
                                                    </a>
                                                    <a class="kt-wizard-v3__nav-item" href="##"
                                                       data-ktwizard-type="step">
                                                        <div class="kt-wizard-v3__nav-body">
                                                            <div class="kt-wizard-v3__nav-label">
                                                                Activities
                                                            </div>
                                                            <div class="kt-wizard-v3__nav-bar"></div>
                                                        </div>
                                                    </a>
                                                    <a class="kt-wizard-v3__nav-item" href="###"
                                                       data-ktwizard-type="step">
                                                        <div class="kt-wizard-v3__nav-body">
                                                            <div class="kt-wizard-v3__nav-label">
                                                                Projects
                                                            </div>
                                                            <div class="kt-wizard-v3__nav-bar"></div>
                                                        </div>
                                                    </a>

                                                </div>
                                            </div>

                                            <!--end: Form Wizard Nav -->
                                        </div>
                                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper" style="width: 120%; float: left">

                                            <!--begin: Form Wizard Form-->
                                            <form id="kt_form">

                                                <!--begin: Form Wizard Step 1-->
                                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                                                     data-ktwizard-state="current">
                                                    <div class="col-xl-12 kt-scroll ps ps--active-y">
                                                        <div class="kt-portlet__body" style="width: 130%; float: left; margin-left: -10%">

                                                            <div class="row" style="width: 90%;">
                                                                <div class="col-xl-4" style="margin-left: auto; float:right;">
                                                                    <?php echo $this->Html->link('<span class="btn btn-primary" style="float:right" ><i class="flaticon2-plus"></i>Add Note</span>',
                                                                        array('type' => 'button'), ['escape' => false, 'data-target' => '#kt_modal_6note', 'data-toggle' => 'modal'])
                                                                    ?>

                                                                </div>


                                                                <div class="col-lg-12" data-scroll="true" data-height="500"
                                                                     style="height: 500px; overflow: hidden; ">

                                                                    <div
                                                                        class="kt-timeline-v1 kt-timeline-v1--justified"
                                                                        style="margin-left:5%;">
                                                                        <?php if (!empty($client->client_notes)): ?>
                                                                            <?php foreach (array_reverse($client->client_notes) as $clientNotes): ?>

                                                                                <div class="kt-timeline-v1__items"
                                                                                     style="margin-bottom: -5%;">
                                                                                    <div
                                                                                        class="kt-timeline-v1__marker"></div>
                                                                                    <div
                                                                                        class="kt-timeline-v1__item kt-timeline-v1__item--first">
                                                                                        <div
                                                                                            class="kt-timeline-v1__item-circle">
                                                                                            <div
                                                                                                class="kt-bg-danger"></div>
                                                                                        </div>
                                                                                        <span class=" kt-font-brand"><b><?php echo date_format($clientNotes->create_date,'d/m/Y H:m') ?></b></span>

                                                                                        <div
                                                                                            class="kt-timeline-v1__item-content"
                                                                                            style="max-width: 90%;">
                                                                                            <div class="kt-timeline-v1__item-title ">
                                                                                                <div style="float: right; ">
                                                                                                    <button
                                                                                                        class="editNoteButton btn btn-sm btn-clean btn-icon btn-icon-sm"
                                                                                                        data-note-id="<?php echo $clientNotes->id ?>"

                                                                                                        data-note-content="<?php echo $clientNotes->content ?>">
                                                                                                        <i class="flaticon2-note"
                                                                                                           data-toggle="kt-popover"
                                                                                                           data-content="Edit Note"
                                                                                                           data-placement='bottom'></i>
                                                                                                    </button>

                                                                                                    <?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm"><i class="flaticon2-delete"></i></span>', ['controller' => 'ClientNotes', 'action' => 'delete', $clientNotes->id], ['escape' => false, 'data-toggle' => "kt-popover", 'data-content' => "delete Note", 'data-placement' => 'bottom', 'confirm' => 'Are you sure you wish to delete this recipe?']) ?>

                                                                                                </div>

                                                                                            </div>

                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body "
                                                                                                style="word-wrap:break-word;">
                                                                                                <p>
                                                                                                    <?= h($clientNotes->content) ?>
                                                                                                </p>
                                                                                            </div>
                                                                                            <div style="float: right">
                                                                                                <div class="checkbox">
                                                                                                    <label>
                                                                                                        <style>
                                                                                                            .switch {
                                                                                                                position: relative;
                                                                                                                display: inline-block;
                                                                                                                width: 30px;
                                                                                                                height: 17px;
                                                                                                            }

                                                                                                            .switch input {
                                                                                                                opacity: 0;
                                                                                                                width: 0;
                                                                                                                height: 0;
                                                                                                            }

                                                                                                            .slider {
                                                                                                                position: absolute;
                                                                                                                cursor: pointer;
                                                                                                                top: 0;
                                                                                                                left: 0;
                                                                                                                right: 0;
                                                                                                                bottom: 0;
                                                                                                                background-color: #ccc;
                                                                                                                -webkit-transition: .4s;
                                                                                                                transition: .4s;
                                                                                                            }

                                                                                                            .slider:before {
                                                                                                                position: absolute;
                                                                                                                content: "";
                                                                                                                height: 13px;
                                                                                                                width: 13px;
                                                                                                                left: 2px;
                                                                                                                bottom: 2px;
                                                                                                                background-color: white;
                                                                                                                -webkit-transition: .4s;
                                                                                                                transition: .4s;
                                                                                                            }

                                                                                                            input:checked + .slider {
                                                                                                                background-color: #5c00e6;
                                                                                                            }

                                                                                                            input:focus + .slider {
                                                                                                                box-shadow: 0 0 1px #5c00e6;
                                                                                                            }

                                                                                                            input:checked + .slider:before {
                                                                                                                -webkit-transform: translateX(13px);
                                                                                                                -ms-transform: translateX(13px);
                                                                                                                transform: translateX(13px);
                                                                                                            }

                                                                                                            /* Rounded sliders */
                                                                                                            .slider.round {
                                                                                                                border-radius: 17px;
                                                                                                            }

                                                                                                            .slider.round:before {
                                                                                                                border-radius: 50%;
                                                                                                            }
                                                                                                        </style>

                                                                                                        <label class="switch">
                                                                                                            <?php if ( $clientNotes->client_note_flag==1):?>
                                                                                                                <input type="checkbox" onclick="notePass(<?php echo $clientNotes->id?>,<?php echo $clientNotes->client_note_flag?>)"
                                                                                                                       checked >
                                                                                                                <span class="slider round"
                                                                                                                      data-toggle = "kt-popover"
                                                                                                                      data-content = "Unflag Note"
                                                                                                                      data-placement = 'bottom'>
                                                                                                                </span>
                                                                                                            <?php else:?>
                                                                                                                <input type="checkbox"  onclick="notePass(<?php echo $clientNotes->id?>,<?php echo $clientNotes->client_note_flag?>)" >
                                                                                                                <span class="slider round"
                                                                                                                      data-toggle = "kt-popover"
                                                                                                                      data-content = "Flag Note"
                                                                                                                      data-placement = 'bottom'></span>
                                                                                                            <?php endif?>
                                                                                                        </label>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                            <?php endforeach; ?>

                                                                        <?php endif; ?>

                                                                    </div>


                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end: Form Wizard Step 1-->

                                                <!-- modal -->

                                                <!--begin: Form Wizard Step 2-->
                                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                                    <div class="col-xl-12 kt-scroll ps ps--active-y">
                                                        <div class="kt-portlet__body">

                                                            <div class="row">
                                                                <div class="col-xl-10"></div>
                                                                <div class="col-xl-6"
                                                                     style="margin-left: 50%; float:right;">
                                                                    <?php echo $this->Html->link('<span class="btn btn-primary" style="float:right"><i class="flaticon2-plus"></i>Add Activity</span>',
                                                                        array('type' => 'button'), ['escape' => false, 'data-target' => '#kt_modal_6', 'data-toggle' => 'modal'])
                                                                    ?>
                                                                    <!--?php echo $this->Html->link('<span class="btn btn-primary" style="float:right"><i class="flaticon2-plus"></i>Edit Activity</span>',
                                                                        array('type'=> 'button'),['escape'=>false, 'data-target'=>'#editactivity','data-toggle'=>'modal'])
                                                                    ?-->

                                                                </div>


                                                                <div data-scroll="true" data-height="500"
                                                                     style="height: 500px; overflow: hidden; width:600px;">

                                                                    <div class="kt-timeline-v1 kt-timeline-v1--justified" style="margin-left:5%;">
                                                                        <?php if (!empty($client->activities)): ?>
                                                                            <?php foreach (array_reverse($client->activities) as $activity): ?>
                                                                                <div class="kt-timeline-v1__items"
                                                                                     style="margin-bottom: -5%;">
                                                                                    <div
                                                                                        class="kt-timeline-v1__marker"></div>
                                                                                    <div
                                                                                        class="kt-timeline-v1__item kt-timeline-v1__item--first">
                                                                                        <div
                                                                                            class="kt-timeline-v1__item-circle">
                                                                                            <div
                                                                                                class="kt-bg-danger"></div>
                                                                                        </div>

                                                                                        <span class=" kt-font-brand">
															                                                                <b><?php echo date_format($activity->create_date,'d/m/Y H:m') ?></b></span>
                                                                                        <div
                                                                                            class="kt-timeline-v1__item-content"
                                                                                            style="max-width: 90%;">


                                                                                            <div class="kt-timeline-v1__item-title ">
                                                                                                <?php if ($activity->type == 'Phone Call'): ?>
                                                                                                    <i class="flaticon2-phone" style="font-size:30px;width: 3%;color:#00e6b8" ></i>
                                                                                                <?php endif; ?>
                                                                                                <?php if ($activity->type == 'Email'): ?>
                                                                                                    <i class="flaticon2-envelope" style="font-size:30px;width: 3%;color:#00e6b8" ></i>
                                                                                                <?php endif; ?>
                                                                                                <?php if ($activity->type == 'Virtual Meeting'): ?>
                                                                                                    <i class="flaticon-network" style="font-size:30px;width: 3%;color:#00e6b8" ></i>
                                                                                                <?php endif; ?>
                                                                                                <?php if ($activity->type == 'Meeting'): ?>
                                                                                                    <i class="flaticon2-envelope" style="font-size:30px;width: 3%;color:#00e6b8" ></i>
                                                                                                <?php endif; ?>
                                                                                                <?php if ($activity->type == 'Text Message'): ?>
                                                                                                    <i class="flaticon2-envelope" style="font-size:30px;width: 3%;color:#00e6b8" ></i>
                                                                                                <?php endif; ?>

                                                                                                <div style="float: right;">

                                                                                                    <button
                                                                                                        class="editActivity btn btn-sm btn-clean btn-icon btn-icon-sm"

                                                                                                        data-activity-id="<?php echo $activity->id ?>"
                                                                                                        data-activity-type="<?php echo $activity->type ?>"
                                                                                                        data-create-date="<?php echo $activity->create_date ?>"
                                                                                                        data-edit-date="<?php echo $activity->edit_date ?>"
                                                                                                        data-summary="<?php echo $activity->summary ?>"
                                                                                                        data-event-date="<?php echo $activity->date ?>"
                                                                                                        data-event-time="<?php echo $activity->time ?>">
                                                                                                        <i class="flaticon2-note"
                                                                                                           data-toggle="kt-popover"
                                                                                                           data-content="Edit Avtivity"
                                                                                                           data-placement='bottom'></i>
                                                                                                    </button>

                                                                                                    <?= $this->Html->link('<span class="btn btn-sm btn-clean btn-icon btn-icon-sm" ><i class="flaticon2-delete"></i></span>', ['controller' => 'Activities', 'action' => 'delete', $activity->id], ['escape' => false, 'data-toggle' => "kt-popover", 'data-content' => "delete activity", 'data-placement' => 'bottom', 'confirm' => 'Are you sure you wish to delete this activity?']) ?>
                                                                                                </div>


                                                                                            </div>

                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body"
                                                                                                style=" word-wrap:break-word;">

                                                                                                <p>
                                                                                                    <?= h($activity->summary) ?>
                                                                                                </p>
                                                                                            </div>
                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body">
                                                                                                <i class="flaticon-event-calendar-symbol" style="font-size:20px;width: 3%;color:#00e6b8" ></i>
                                                                                                <?= h($activity->date->i18nFormat('dd/MM/yyyy').' ') ?><?php echo $this->Time->format($activity->time, 'HH:mm a') ?>
                                                                                                <div style="float: right">
                                                                                                    <div class="checkbox">
                                                                                                        <label>
                                                                                                            <style>
                                                                                                                .switch {
                                                                                                                    position: relative;
                                                                                                                    display: inline-block;
                                                                                                                    width: 30px;
                                                                                                                    height: 17px;
                                                                                                                }

                                                                                                                .switch input {
                                                                                                                    opacity: 0;
                                                                                                                    width: 0;
                                                                                                                    height: 0;
                                                                                                                }

                                                                                                                .slider {
                                                                                                                    position: absolute;
                                                                                                                    cursor: pointer;
                                                                                                                    top: 0;
                                                                                                                    left: 0;
                                                                                                                    right: 0;
                                                                                                                    bottom: 0;
                                                                                                                    background-color: #ccc;
                                                                                                                    -webkit-transition: .4s;
                                                                                                                    transition: .4s;
                                                                                                                }

                                                                                                                .slider:before {
                                                                                                                    position: absolute;
                                                                                                                    content: "";
                                                                                                                    height: 13px;
                                                                                                                    width: 13px;
                                                                                                                    left: 2px;
                                                                                                                    bottom: 2px;
                                                                                                                    background-color: white;
                                                                                                                    -webkit-transition: .4s;
                                                                                                                    transition: .4s;
                                                                                                                }

                                                                                                                input:checked + .slider {
                                                                                                                    background-color: #5c00e6;
                                                                                                                }

                                                                                                                input:focus + .slider {
                                                                                                                    box-shadow: 0 0 1px #5c00e6;
                                                                                                                }

                                                                                                                input:checked + .slider:before {
                                                                                                                    -webkit-transform: translateX(13px);
                                                                                                                    -ms-transform: translateX(13px);
                                                                                                                    transform: translateX(13px);
                                                                                                                }

                                                                                                                /* Rounded sliders */
                                                                                                                .slider.round {
                                                                                                                    border-radius: 17px;
                                                                                                                }

                                                                                                                .slider.round:before {
                                                                                                                    border-radius: 50%;
                                                                                                                }
                                                                                                            </style>

                                                                                                            <label class="switch">
                                                                                                                <?php if ( $activity->activity_flag==1):?>
                                                                                                                    <input type="checkbox" onclick="pass(<?php echo $activity->id?>,<?php echo $activity->activity_flag?>)"
                                                                                                                           checked data-activity-flag-id="<?php $activity->id?>">
                                                                                                                    <span class="slider round"
                                                                                                                          data-toggle = "kt-popover"
                                                                                                                          data-content = "Unflag Activity"
                                                                                                                          data-placement = 'bottom'>
                                                                                                                    </span>
                                                                                                                <?php else:?>
                                                                                                                    <input type="checkbox" name="flag"
                                                                                                                           onclick="pass(<?php echo $activity->id?>,<?php echo $activity->activity_flag?>)"
                                                                                                                           data-activity-flag-id="<?php $activity->id?>">
                                                                                                                    <span class="slider round"
                                                                                                                          data-toggle = "kt-popover"
                                                                                                                          data-content = "Flag Activity"
                                                                                                                          data-placement = 'bottom'>

                                                                                                                    </span>
                                                                                                                <?php endif?>
                                                                                                            </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body">

                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                            <?php endforeach; ?>

                                                                        <?php endif; ?></div>


                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>


                                                    <!--Begin::Timeline 3 -->


                                                    <!--End::Timeline 3 -->
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                                        <div class="ps__thumb-x" tabindex="0"
                                                             style="left: 0px; width: 0px;"></div>
                                                    </div>
                                                    <div class="ps__rail-y"
                                                         style="top: 0px; height: 380px; right: 0px;">
                                                        <div class="ps__thumb-y" tabindex="0"
                                                             style="top: 0px; height: 300px;"></div>
                                                    </div>
                                                </div>


                                                <!--end: Form Wizard Step 2-->

                                                <!--begin: Form Wizard Step 3-->
                                                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                                    <!--<div class="kt-heading kt-heading--md">Select your Services</div>-->
                                                    <div class="col-xl-12 kt-scroll ps ps--active-y">
                                                        <div class="kt-portlet__body">

                                                            <div class="row">
                                                                <div class="col-xl-10"></div>
                                                                <div class="col-xl-6"
                                                                     style="margin-left: 50%; float:right;">

                                                                    <!--<span class="btn btn-primary" style="float:right"><i class="flaticon2-plus"></i>Add Project</span>-->
                                                                    <!--<?php echo $this->Html->link('<span class="btn btn-primary" style="float:right"><i class="flaticon2-plus"></i>Add Project</span>',
                                                                        array('type' => 'button'), ['escape' => false])
                                                                    ?> -->


                                                                </div>


                                                                <div data-scroll="true" data-height="500"
                                                                     style="height: 500px; overflow: hidden; width:600px;">

                                                                    <div class="kt-timeline-v1 kt-timeline-v1--justified" style="margin-left:5%;">
                                                                        <?php foreach($client_talent as $client_talents){ ?>

                                                                                <div class="kt-timeline-v1__items"
                                                                                     style="margin-bottom: -5%;">
                                                                                    <div
                                                                                        class="kt-timeline-v1__marker"></div>
                                                                                    <div
                                                                                        class="kt-timeline-v1__item kt-timeline-v1__item--first">
                                                                                        <div
                                                                                            class="kt-timeline-v1__item-circle">
                                                                                            <div
                                                                                                class="kt-bg-danger"></div>
                                                                                        </div>

                                                                                        <span class=" kt-font-brand">
                                                                                        <div
                                                                                            class="kt-timeline-v1__item-content"
                                                                                            style="max-width: 90%;">


                                                                                            <div class="kt-timeline-v1__item-title ">

                                                                                                <?php echo $client_talents['project_name']?>
                                                                                            </div>
                                                                                            <div
                                                                                                class="kt-timeline-v1__item-body"
                                                                                                style=" word-wrap:break-word;">
                                                                                                 <h6>Project Progress</h6>

                                                                                                <div class="progress" style="font-size: 15px ;height: 20px ; font-weight: 500">
                                                                                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                                                         role="progressbar"
                                                                                                         aria-valuenow="<?= $this->Number->format($client_talents['progress_num']) ?>"
                                                                                                         aria-valuemin="0" aria-valuemax="100"
                                                                                                         style="width: <?= $this->Number->format($client_talents['progress_num']) ?>% "><?= $this->Number->format($client_talents['progress_num']) ?>
                                                                                                        %
                                                                                                    </div>
                                                                                                </div>
                                                                                                <br>
                                                                                                <h6>Project Description</h6>

                                                                                                <p>
                                                                                                    <?php echo $client_talents['project_desc']?>
                                                                                                </p>

                                                                                                <p>

                                                                                                <i class="flaticon-event-calendar-symbol" style="font-size:20px;width: 3%;color:#00e6b8" ></i>
                                                                                                <?php echo date_format($client_talents['start_date'], "d/m/Y "); ?> -
                                                                                                    <?php echo date_format($client_talents['end_date'], "d/m/Y "); ?>
                                                                                                </p>


                                                                                                <h6>Allocated Talents</h6>

                                                                                    <?php for($i=0;$i<sizeOf($client_talents['talents']);$i++) { ?>
                                                                                        <span
                                                                                            class=" rotate-center kt-badge kt-badge--primary  kt-badge--inline kt-badge--pill kt-badge--md"
                                                                                            style="margin-bottom: 8px"><?php echo $client_talents['talents'][$i]['first_name'].' '.$client_talents['talents'][$i]['last_name']; ?></span>
                                                                                                    <?php } ?>







                                                                                            </div>

                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                        <?php } ?>
                                                                    </div>


                                                                </div>

                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end: Form Wizard Step 3-->


                                                <!--end: Form Wizard Step 5-->

                                                <!--begin: Form Actions -->
                                                <!--<div class="kt-form__actions" >
                                                    <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                                        Previous
                                                    </div>
                                                    <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                                        Submit
                                                    </div>
                                                    <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                                        Next Step
                                                    </div>
                                                </div>
                                                -->

                                                <!--end: Form Actions -->
                                            </form>

                                            <!--end: Form Wizard Form-->

                                            <!-- add activity modal-->
                                            <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="width:500%">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Add New
                                                                Activity</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                        <span>
                                                                            <?= $this->Form->create(null, ['type' => 'post',]) ?>
                                                                            <fieldset>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->control('type', ['class' => 'form-control','required' => true, 'empty' => '--select--', 'options' => array('' => '', 'Email' => 'Email', 'Phone Call' => 'Phone Call','Virtual Meeting' => 'Virtual Meeting', 'Meeting' => 'Meeting','Text Message' => 'Text Message')]); ?>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('summary', ['class' => 'form-control', 'id' => 'exampleSelect1', 'type' => 'textarea', 'placeholder' => 'Please enter a summary']); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-6">
                                                                                                <?php echo $this->Form->control('date', ['type' => 'date', 'label' => 'Event Date','class' => 'form-control', 'id' => 'exampleSelect1','required' => true,'value'=>Time::now()->i18nFormat('yyyy-MM-dd','GMT+10')]); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <?php echo $this->Form->control('time', ['type' => 'time', 'label' => 'Event Time', 'class' => 'form-control', 'id' => 'exampleSelect1','required' => true, 'value'=>Time::now()->i18nFormat('HH:mm','GMT+10')]); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <div
                                                                                                        class="kt-input-icon">
                                                                                                        <span
                                                                                                            class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>

                                                                                        </div>



                                                                            </fieldset>
                                                                            <div class="modal-footer">
                                                                                    <?= $this->Form->button('Submit', ['class' => 'btn btn-success']) ?>
                                                                                    <?= $this->Form->end() ?>
                                                                                    <?php echo $this->Html->link('Cancel',
                                                                                        array(
                                                                                            'type' => 'button'),
                                                                                        array('class' => 'btn btn-secondary', 'data-dismiss' => 'modal',))
                                                                                    ?>
                                                                                </div>

                                                                                                    </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--  end add activity modal-->


                                            <div class="modal fade" id="editactivity" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="width:500%">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit
                                                                Activity</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                        <span>
                                                                            <?php ?>
                                                                            <?= $this->Form->create(null, ['type' => 'post', 'patch', 'put', 'id' => 'editActivity', 'url' => [
                                                                                'controller' => 'Activities',
                                                                                'action' => 'edit/'
                                                                            ]]) ?>
                                                                            <fieldset>
                                                                                                                                                                        <div
                                                                                                                                                                            class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->hidden('id', ['value' => $activity->id, 'class' => 'form-control']); ?>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->control('type', ['class' => 'form-control', 'options' => array('' => '', 'Email' => 'Email', 'Phone Call' => 'Phone Call','Virtual Meeting' => 'Virtual Meeting', 'Meeting' => 'Meeting','Text Message' => 'Text Message')]); ?>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('summary', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => 'Please enter a summary']); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-6">
                                                                                                <?php echo $this->Form->control('date', ['value' => "", 'type' => 'date', 'label' => 'Event Date', 'class' => 'form-control']); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-lg-6">
                                                                                                <?php echo $this->Form->control('time', ['value' => '', 'type' => 'time', 'label' => 'Event Time', 'class' => 'form-control']); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <div
                                                                                                        class="kt-input-icon">
                                                                                                        <span
                                                                                                            class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>

                                                                                        </div>



                                                                            </fieldset>
                                                                            <div class="modal-footer">
                                                                                    <?= $this->Form->button('Submit', ['class' => 'btn btn-success']) ?>
                                                                                    <?= $this->Form->end() ?>
                                                                                    <?php echo $this->Html->link('Cancel',
                                                                                        array(
                                                                                            'type' => 'button'),
                                                                                        array('class' => 'btn btn-secondary', 'data-dismiss' => 'modal',))
                                                                                    ?>
                                                                                </div>

                                                                                                    </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="modal fade" id="editNoteModal" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="width:500%">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Edit
                                                                Note</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                        <span>
                                                                            <?php ?>
                                                                            <?= $this->Form->create(null, ['type' => 'post', 'patch', 'put', 'id' => 'editNoteForm', 'url' => [
                                                                                'controller' => 'ClientNotes',
                                                                                'action' => 'edit/'
                                                                            ]]) ?>
                                                                            <fieldset>
                                                                                            <div class="form-group row">
                                                                                            <div class="col-lg-4">
                                                                                                <?php echo $this->Form->hidden('id', ['value' => $clientNotes->id, 'class' => 'form-control']); ?>
                                                                                            </div>
                                                                                            </div>


                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('content', ['class' => 'form-control', 'type' => 'textarea', 'placeholder' => 'Please enter a note','label'=>false]); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                            </fieldset>
                                                                            <div class="modal-footer">
                                                                                    <?= $this->Form->button('Submit', ['class' => 'btn btn-success']) ?>
                                                                                    <?= $this->Form->end() ?>
                                                                                    <?php echo $this->Html->link('Cancel',
                                                                                        array(
                                                                                            'type' => 'button'),
                                                                                        array('class' => 'btn btn-secondary', 'data-dismiss' => 'modal',))
                                                                                    ?>
                                                                                </div>

                                                                                                    </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>


                                            <!-- add note modal-->
                                            <div class="modal fade" id="kt_modal_6note" tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content" style="width:500%">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Add New
                                                                Note</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                                        <span>
                                                                            <?= $this->Form->create(null, ['type' => 'post']) ?>
                                                                            <fieldset>

                                                                                        <div class="form-group row">
                                                                                            <div class="col-lg-12">
                                                                                                <?php echo $this->Form->control('content', ['class' => 'form-control', 'id' => 'exampleSelect1', 'type' => 'textarea', 'label'=>'Enter Note Here', 'placeholder' => 'Please enter a note', 'label'=>false]); ?>
                                                                                                <div
                                                                                                    class="kt-input-icon">
                                                                                                    <span
                                                                                                        class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                            </fieldset>
                                                                            <div class="modal-footer">
                                                                                    <?= $this->Form->button('Submit', ['class' => 'btn btn-success']) ?>
                                                                                    <?= $this->Form->end() ?>
                                                                                    <?php echo $this->Html->link('Cancel',
                                                                                        array(
                                                                                            'type' => 'button'),
                                                                                        array('class' => 'btn btn-secondary', 'data-dismiss' => 'modal',))
                                                                                    ?>
                                                                                </div>

                                                                                                    </span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end add note modal-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--end: Form Actions -->
                        <!--end: Form Wizard Form-->
                    </div>

                </div>
            </div>
        </div>
        <?= $this->Html->script('general/jquery/dist/jquery.js') ?>
        <?= $this->Html->script('app/custom/wizard/wizard-v3.js')?>
        <script>
            $(document).on("click", ".editNoteButton", function () {
                var noteId = $(this).attr("data-note-id");
                var noteContent = $(this).attr("data-note-content");

                $('#content').val(noteContent);
                $('#editNoteModal').modal('show');
                $('#editNoteForm').submit(function(e){
                    e.preventDefault();
                    var form = $(this);
                    $.ajax({
                        url: '<?php echo $this->Url->build([
                            'controller' => 'ClientNotes',
                            'action' => 'edit'
                        ])?>' + '/' + noteId,
                        type:'POST',
                        data:form.serialize(),
                        success: function(){
                            window.location.reload();
                        }


                    });

                })
            })
        </script>
        <script>
            function pass($something,$flag){
            var string =$something.toString();
            var test;
            if($flag==1){
                test=0;
            }
            else{
                test=1;
            }


            $.ajax({
                url: '<?php echo $this->Url->build([
                    'controller' => 'Activities',
                    'action' => 'edit'
                ])?>' + '/' + string,
                type:'POST',
                headers: {
                    'X-CSRF-Token': '<?= h($this->request->getParam('_csrfToken')); ?>'
                },
                data:{'activity_flag':test},
                success: function(){
                    window.location.reload();
                }


            });
        }
        </script>


        <script>
            function notePass($hello,$flag1){
                var string1 =$hello.toString();
                var test1;
                if($flag1==1){
                    test1=0;
                }
                else{
                    test1=1;
                }

                $.ajax({
                    url: '<?php echo $this->Url->build([
                        'controller' => 'ClientNotes',
                        'action' => 'getFlag'
                    ])?>' + '/' + string1,
                    type:'POST',
                    headers: {
                        'X-CSRF-Token': '<?= h($this->request->getParam('_csrfToken')); ?>'
                    },
                    data:{'id':string1},
                    dataType:'String',
                    success: function(data){
                        alert(data);
                    }


                });


                $.ajax({
                    url: '<?php echo $this->Url->build([
                        'controller' => 'ClientNotes',
                        'action' => 'edit'
                    ])?>' + '/' + string1,
                    type:'POST',
                    headers: {
                        'X-CSRF-Token': '<?= h($this->request->getParam('_csrfToken')); ?>'
                    },
                    data:{'client_note_flag':test1},
                    success: function(){
                        //window.location.reload();
                    }


                });
            }
        </script>
        <script>
            $(document).on("click", ".editActivity", function () {

                var activityId = $(this).attr("data-activity-id");
                var type = $(this).attr("data-activity-type");
                var summary = $(this).attr("data-summary");
                var date = $(this).attr("data-event-date");
                var time = $(this).attr("data-event-time");
                var actualDate = new Date(date);
                var actualTime = new Date(time)
                var year = actualDate.getFullYear();
                var month = actualDate.getMonth() + 1;
                var day = actualDate.getDate();
                var hour = actualTime.getHours();
                var minute = actualTime.getMinutes();
                if (hour < 10) hour = "0" + hour;
                if (minute < 10) minute = "0" + minute;
                if (month < 10) month = "0" + month;
                if (day < 10) day = "0" + day;
                var today = year + "-" + month + "-" + day;
                var timeline = hour + ":" + minute;

                $('#id').val(activityId);
                if (type == "Email") {
                    $('#type option[value=Email]').prop('selected', true);
                } else if (type == "Phone Call" || type == "PhoneCall")
                    $('#type option[value=PhoneCall]').prop('selected', true);
                $('#summary').val(summary);
                $('#date').attr('value', today);
                $('#time').attr('value', timeline);

                $('#editactivity').modal('show');
                $('#editActivity').submit(function(e){
                    e.preventDefault();
                    var form = $(this);
                    $.ajax({
                        url: '<?php echo $this->Url->build([
                            'controller' => 'Activities',
                            'action' => 'edit'
                        ])?>' + '/' + activityId,
                        type:'POST',
                        data:form.serialize(),
                        success: function(){
                            window.location.reload();
                        }
                    });
                })
            })
        </script>

