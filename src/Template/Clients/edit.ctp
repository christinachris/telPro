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
<!-- begin:: Header Topbar -->
<?= $this->Flash->render() ?>

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
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="<?php echo $this->Url->build(['controller' => 'Clients', 'action' => 'index']) ?>"
                           class="kt-subheader__breadcrumbs-link">
                            Clients List
                        </a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>

                        <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Client Details</span>
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

                    <!--begin::Portlet-->
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon kt-hidden">
											<i class="la la-gear"></i>
										</span>
                                <h3 class="kt-portlet__head-title">
                                    Edit Client
                                </h3>
                            </div>
                        </div>
                        <?= $this->Form->create($client) ?>
                        <fieldset>


                            <form class="kt-form kt-form--label-right" style="position:center">
                                <div class="kt-portlet__body" style="margin-left:55px">
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('first_name', ['class' => 'form-control', 'placeholder' => 'Enter first name']); ?>
                                        </div>
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('last_name', ['class' => 'form-control', 'placeholder' => 'Enter last name']); ?>
                                        </div>
                                        <div class="col-lg-4">
                                            <?php echo $this->Form->control('preferred_name', ['class' => 'form-control', 'placeholder' => 'Enter preferred name']); ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('company_name', ['class' => 'form-control', 'id' => 'exampleSelect1', 'placeholder' => 'Enter company name']); ?>
                                            <div class="kt-input-icon">
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('address_url', ['class' => 'form-control', 'id' => 'exampleSelect1', 'placeholder' => 'Enter url address']); ?>
                                            <div class="kt-input-icon">
                                                <div class="kt-input-icon">
                                        <span
                                            class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <?php echo $this->Form->control('credential', ['class' => 'form-control', 'id' => 'exampleTextarea', 'rows' => '3']); ?>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <?php echo $this->Form->control('lifecycle_stage',
                                                    ['options' => array('' => '', 'Offer Sended' => 'Offer Sended', 'Awaiting Payment' => 'Awaiting Payment', 'Potential Lead' => 'Potential Lead', 'Contacted' => 'Contacted'),
                                                        'class' => 'form-control', 'id' => 'exampleSelect1']); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div>
                                                <?php
                                                echo $this->Form->control('contact_owner_id', ['options' => $talents, 'empty' => true, 'class' => 'form-control']); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                           <!-- <?php
                                            if ($client->flag == 1):
                                                echo $this->Form->control('flag', ['type' => 'checkbox', 'checked', 'id' => 'flag', 'value' => 'true']);
                                            else:
                                                echo $this->Form->control('flag', ['type' => 'checkbox', 'id' => 'flag', 'value' => 'true']);
                                            endif;
                                            ?>
                                            <span class="form-text text-muted">emergency</span> -->
                                        </div>
                                    </div>


                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>
                                    <div class="form-group row">

                                        <div>
                                            <label>Contact Phone Numbers:</label><br>
                                            <table id="dynamic_field">


                                                <?php foreach ($phones as $key => $phone) { ?>
                                                    <tr id="row<?php echo $key ?>">
                                                        <!--<?php var_dump($phone) ?>-->

                                                        <?php $row = -1;
                                                        if ($phone->is_primary == '1') {
                                                            $row = $key;
                                                        } ?>
                                                        <div class="col-lg-6">
                                                            <td><?php echo $this->Form->control('Phones.' . $key . '.title', ['value' => $phone->title, 'class' => 'form-control']) ?></td>
                                                        </div>
                                                        <td><?php echo $this->Form->control('Phones.' . $key . '.phone_no', ['value' => $phone->phone_no, 'class' => 'form-control', 'type' => 'text', 'style' => 'margin-left:20%;', 'label' => ['style' => 'margin-left:20%;']]) ?></td>
                                                        <td>
                                                            <br><?php echo $this->Form->radio('phone_primary[]', [['value' => $key, 'text' => '<span style="padding:0 5px 0 5px;">Primary</span>']], ['value' => $row, 'hiddenField' => false, 'style' => 'margin-left:50px;margin-top:15px', 'escape' => false]) ?>
                                                        </td>
                                                        <td><br>
                                                            <button style="margin-left:50%;" type="button" name="remove"
                                                                    id=<?php echo $key ?> class=" btn_remove btn btn-danger
                                                                    btn-elevate btn-pill btn-sm
                                                            ">Delete</button></td>

                                                    </tr>
                                                <?php } ?>


                                            </table>
                                        </div>
                                    </div>


                                    <div>
                                        <br>
                                        <button style="margin-left:-5px;" type="button" name="add" id="add"
                                                class="btn-sm btn-brand ">Add More
                                        </button>
                                    </div>


                                    <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg"></div>

                                    <div class="form-group row">
                                        <div>
                                            <label>Contact Email Address:</label><br>
                                            <table id="dynamic_field2">
                                                <div class="col-lg-12">

                                                    <?php foreach ($emails as $key => $email) { ?>
                                                        <tr id="row<?php echo $key ?>">
                                                            <!--<?php var_dump($email) ?>-->

                                                            <?php $row = -1;
                                                            if ($email->is_primary == '1') {
                                                                $row = $key;
                                                            } ?>

                                                            <td><?php echo $this->Form->control('Emails.' . $key . '.title', ['value' => $email->title, 'class' => 'form-control']) ?></td>
                                                            <td> <?php echo $this->Form->control('Emails.' . $key . '.email_address', ['value' => $email->email_address, 'class' => 'form-control', 'type' => 'email', 'style' => 'margin-left:20%;', 'label' => ['style' => 'margin-left:20%;']]) ?></td>
                                                            <td>
                                                                <br><?php echo $this->Form->radio('email_primary[]', [['value' => $key, 'text' => '<span style="padding:0 5px 0 5px;">Primary</span>']], ['value' => $row, 'hiddenField' => false, 'style' => 'margin-left:50px;margin-top:15px', 'escape' => false]) ?>
                                                            </td>
                                                            <td><br>
                                                                <button style="margin-left:50%;" type="button" name="remove"
                                                                        id=<?php echo $key ?> class=" btn_remove btn btn-danger
                                                                        btn-elevate btn-pill btn-sm
                                                                ">Delete</button></td>
                                                        </tr>

                                                    <?php } ?>

                                                </div>
                                            </table>
                                        </div>

                                    </div>
                                    <div>
                                        <br>
                                        <button style="margin-left:-5px;" type="button" name="add1" id="add1"
                                                class="btn-sm btn-brand btn-pill">Add More
                                        </button>
                                    </div>
                        </fieldset>
                    </div>

                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div style="width: 100%;display: flex; align-items: center; justify-content: center;">
                                    <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
                                    <?= $this->Form->end() ?>
                                    <?php echo $this->Html->link('Cancel',
                                        array('controller' => 'Clients',
                                            'action' => 'index',
                                            'type' => 'button'),
                                        array('class' => 'btn btn-secondary'))
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->Html->script('assets/app/custom/general/crud/forms/widgets/form-repeater.js') ?>
            <?= $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js') ?>


            <script>
                $(document).ready(function () {
                    var i = 10;
                    $('#add').click(function () {
                        i++;
                        $('#dynamic_field').append('<tr id="row' + i + '">' +
                            '<td><br><input type="text" placeholder="Enter title" name="Phones[' + (i - 1) + '][title]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:20%;" type="tel" placeholder="Enter Phone No" name="Phones[' + (i - 1) + '][phone_no]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:50px; margin-top:15px;" type="radio" name="phone_primary[]" value="' + (i - 1) + '" ><span style="padding:0 5px 0 5px;">Primary</span></td>' +
                            '<td><br><button style="margin-left:50%;" type="button" name="remove" id="' + i + '" class=" btn_remove btn btn-danger btn-elevate btn-pill btn-sm">Delete</button></td></tr>');
                    });
                    $(document).on('click', '.btn_remove', function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    });

                });
                $(document).ready(function () {
                    $('#remove').click(function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    })
                })

            </script>

            <script>
                $(document).ready(function () {
                    var i = 10;
                    $('#add1').click(function () {
                        i++;
                        $('#dynamic_field2').append('<tr id="row' + i + '">' +
                            '<td><br><input type="text" placeholder="Enter title" name="Emails[' + (i - 1) + '][title]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:20%;" type="tel"  placeholder="Enter Email Address" name="Emails[' + (i - 1) + '][email_address]" class="form-control name_list" /></td>' +
                            '<td><br><input style="margin-left:50px; margin-top:15px;" type="radio" name="email_primary[]" value="' + (i - 1) + '" ><span style="padding:0 5px 0 5px;">Primary</span></td>' +
                            '<td><br><button style="margin-left:50%;" type="button" name="remove" id="' + i + '" class=" btnremove btn btn-danger btn-elevate btn-pill btn-sm">Delete</button></td></tr>');
                    });
                    $(document).on('click', '.btnremove', function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    });

                });
                $(document).ready(function () {
                    $('#remove').click(function () {
                        var button_id = $(this).attr("id");
                        $('#row' + button_id + '').remove();
                    })
                })

            </script>
            <!--
            <script>
                $(document).ready(function(){
                    var i=1;
                    $('#add2').click(function(){
                        i++;
                        $('#dynamic_field2').append('<tr id="row'+i+'">' +
                            '<td><label><input type="text" placeholder="Enter title" name="Emails['+(i-1)+'][title]" class="form-control name_list" /></label></td>' +
                            '<td><input type="text" name="Emails['+(i-1)+'][email_address]" class="form-control name_list" /></td>' +
                            '<td><input type="checkbox" name="Emails['+(i-1)+'][is_primary]" >Primary</td>' +
                            '<td><button type="button" name="remove" id="'+i+'" class=" btnremove btn btn-danger btn-elevate btn-pill btn-sm">Delete</button></td></tr>');
                    });
                    $(document).on('click', '.btnremove', function(){
                        var button_id = $(this).attr("id");
                        $('#row'+button_id+'').remove();
                    });
            //        $('#submit').click(function(){
            //            $.ajax({
            //               url:"name.php",
            //                method:"POST",
            //                data:$('#add_name').serialize(),
            //                success:function(data)
            //                {
            //                    alert(data);
            //                    $('#add_name')[0].reset();
            //                }
            //            });
            //        });
                });
            </script>


            <div class="clients form large-9 medium-8 columns content">
                <?= $this->Form->create($client) ?>
                <fieldset>
                    <legend><?= __('Edit Client') ?></legend>
                    <?php
            echo $this->Form->control('first_name');
            echo $this->Form->control('last_name');
            echo $this->Form->control('preferred_name');
            echo $this->Form->control('credential');
            echo $this->Form->control('last_contactdate', ['empty' => true]);
            echo $this->Form->control('company_name');
            echo $this->Form->control('address_url');
            echo $this->Form->control('lifecycle_stage');
            echo $this->Form->control('contact_owner_id', ['options' => $talents, 'empty' => true]);
            echo $this->Form->control('phone_no');
            ?>
                </fieldset>
                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
