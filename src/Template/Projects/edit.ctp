<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project $project
 */

  use Cake\Datasource\ConnectionManager;

  // my_connection is defined in your database config
  $conn = ConnectionManager::get('default');

?>

<?php use Cake\Routing\Router; ?>
<?php use Cake\I18n\Time; ?>
<?= $this->Html->script('general\bootstrap-datetimepicker\js\bootstrap-datetimepicker.js') ?>


<!-- begin:: Add.ctp -->
<link href="http://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- end:: Add.ctp -->

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="./assets/js/demo8/pages/crud/forms/widgets/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!-- begin:: Header Topbar -->

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

<?= $this->Flash->render() ?>
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

            <!--begin: header navigation bar -->
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
            <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "index"]); ?>"
               class="kt-subheader__breadcrumbs-link">
                Project List </a>

            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
        <div class="kt-subheader__breadcrumbs">

            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "edit/$project->id"]); ?>"
               class="kt-subheader__breadcrumbs-link">
                Edit The Project </a>

            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
    </div>
</div>



<!--end: header -->



<div class="kt-content kt-grid__item kt-grid__item--fluid">
    <!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
<div class="kt-portlet">
						            <div class="kt-portlet__head">
                                        <div class="kt-portlet__head-label">
                        										<span class="kt-portlet__head-icon kt-hidden">
                        											<i class="la la-gear"></i>
                        										</span>
                                            <h3 class="kt-portlet__head-title">
                                                Project Name: <?php echo $project['project_name'];?>
                                            </h3>
                                        </div>
                                    </div>
		<div class="kt-portlet__body" style="margin-left:55px; margin-right:55px">

            <?= $this->Form->create($project) ?>
            <div class="kt-wizard-v2__form">
								<div class="form-group">
									<label>Project Name</label>
									<?php
                                        echo $this->Form->control('project_name',['required'=>true,'label'=>false,'class'=>'form-control','style'=>'background:white']);
                                     ?>
									<span class="form-text text-muted">Please enter the project name.</span>
								</div>
								<?php echo $this->Form->hidden('progress_num', ['value' => $project->progress_num]); ?>

						        <div class="row">
								    <div class="col-xl-6">
								    <div class="form-group">
									    <label>Start Date</label>

										<div class="input-group date">
										                <?php echo $this->Form->control('start_date', [
										                    'value'=>$project->start_date->i18nFormat('yyyy/MM/dd HH:mm'),
										                    'required'=>true,
                                                            'templates' => ['inputContainer' => '{{content}}'],
                                                            'class' => 'input-group date form-control col-lg-4 col-md-6 col-sm-12 ',
                                                            'type' => 'text',
                                                            'id' => 'kt_datetimepicker_2', // this ID is fixed, using for Helper Datepicker !
                                                            'label' => false

                                                        ]); ?>

											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar"></i>
												</span>
											</div>
										</div>
										<span class="form-text text-muted">Please enter the start date of the project.</span>

								    </div>
								    </div>

								    <div class="col-xl-6">
								    <div class="form-group">
									    <label>End Date</label>

										<div class="input-group date">
										                <?php echo $this->Form->control('end_date', [
										                    'value' => $project->end_date->i18nFormat('yyyy/MM/dd HH:mm'),
										                    'required'=>true,
                                                            'templates' => ['inputContainer' => '{{content}}'],
                                                            'class' => 'input-group date form-control col-lg-4 col-md-6 col-sm-12 ',
                                                            'type' => 'text',
                                                            'id' => 'kt_datetimepicker_2', // this ID is fixed, using for Helper Datepicker !
                                                            'label' => false,

                                                        ]); ?>

											<div class="input-group-append">
												<span class="input-group-text">
													<i class="la la-calendar"></i>
												</span>
											</div>
										</div>
										<span class="form-text text-muted">Please enter the end date of the project.</span>
									    <?php if(isset($errorDate))
                  							  { ?>
									    <p style="color: red"><?php echo $errorDate; ?></p>
									    <?php } ?>
								    </div>
								    </div>
								</div>

								<div class="form-group">
									<label>Project Description</label>
                                    <?php
                                        echo $this->Form->control('project_desc',['required'=>true,'label'=>false,'class'=>'form-control', 'type' => 'textarea']);
                                     ?>
									<span class="form-text text-muted">Please enter the description of the project.</span>
								</div>
			</div>
			<!--end: details of project-->

			<!--begin: association-->
			<div class="kt-heading kt-heading--md">Association</div>

             <div class="kt-wizard-v2__form">
                        	    <div class="row">
                            		<div class="col-xl-6">
                            			<div class="form-group">
                            				<label>Client</label>
											<br>
											<?php echo $this->Form->select('client_id',$clientNames,[
											'required'=>true,'label'=>false,'class'=>'chosen-select-width','select'=>true]); ?>
                            				<span class="form-text text-muted">Please enter the full name of the client.</span>

                            			</div>
                            		</div>

                            		<div class="col-xl-6">
                            			<div class="form-group">
                            				<label>Talent</label>
											<br>
											<?php echo $this->Form->select('talent_name',$talentNames,[ 'multiple' => 'multiple'
											,'label'=>false,'class'=>'chosen-select-width','value'=>$selectedTalent]); ?>
											<span class="form-text text-muted">Please enter the full name of the talents.</span>
											<?php if(isset($errors))
                  							  { ?>
											<p style="color: red"><?php echo $errors; ?></p>
											<?php } ?>
                            			</div>

                            		</div>
                            	</div>
             </div>
					    <!--end: association-->


         <?= $this->Form->button('Submit',['class'=>'btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u']) ?>
         <?= $this->Form->end() ?>
        </div>
     <!--end: body -->

</div>
</div>
</div>

<script>
    $(document).ready(function() {
        $(".chosen-select-width").chosen({
            width: "75%"
        });

    });
	var demo = $(".chosen-select-width").chosen();

</script>


