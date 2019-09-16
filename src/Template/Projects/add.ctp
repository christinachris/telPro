<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Project[]|\Cake\Collection\CollectionInterface $projects
 */

  use Cake\Datasource\ConnectionManager;
  use Cake\I18n\I18n;
  use Cake\I18n\Time;

  //I18n::Locale('es-au');
  // my_connection is defined in your database config
  $conn = ConnectionManager::get('default');

?>
<!-- begin:: Add.ctp -->
<link href="http://harvesthq.github.io/chosen/chosen.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="http://harvesthq.github.io/chosen/chosen.jquery.js"></script>
<!-- end:: Add.ctp -->


<div class="kt-header__bottom">
    <div class="kt-container">

        <!-- begin: Header Menu -->
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu">

                <ul class="kt-menu__nav ">
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true"><a href=" <?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>" class="kt-menu__link ">
                            <span class="kt-menu__link-text">Dashboard </span></a></li>
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
        <?= $this->Flash->render() ?>
        <a href="<?php echo $this->Url->build(["controller" => "dashboard", "action" => "index"]); ?>"
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
            <a href="<?php echo $this->Url->build(["controller" => "projects", "action" => "add"]); ?>"
               class="kt-subheader__breadcrumbs-link">
                Add A New Project </a>

            <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
        </div>
    </div>
</div>







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
                                                Let's Get Started !
                                            </h3>
                                        </div>
                                    </div>
				<div class="kt-portlet__body" style="margin-left:55px; margin-right:55px">
				<!--begin: Form Wizard Form-->
					<?= $this->Form->create($project,['autocomplete'=>'off','type'=>'post']) ?>
					<!--begin: Form Wizard -->

					    <!--details of the project-->

							<div class="kt-wizard-v2__form">

								<div class="form-group">
									<label>Project Name</label>
									<?php
                                        echo $this->Form->control('project_name',['required'=>true,'label'=>false,'class'=>'form-control','style'=>'background:white']);
                                     ?>
									<span class="form-text text-muted">Please enter the project name.</span>
								</div>

						        <div class="row">
								<div class="col-xl-6">
								<div class="form-group">
									<label>Start Date</label>

										<div class="input-group date">
										                <?php echo $this->Form->control('start_date', [
										                    'required'=>false,
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
										                    'required'=>false,
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
									<?php if(isset($errorDate))
                  							  { ?>
									<p style="color: red"><?php echo $errorDate; ?></p>
									<?php } ?>
										<span class="form-text text-muted">Please enter the end date of the project.</span>

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
											<?php echo $this->Form->select('client_name',$clientNames,[
											'required'=>true,'label'=>false,'class'=>'chosen-select-width']); ?>
                            				<span class="form-text text-muted">Please enter the full name of the client.</span>


                            			</div>
                            		</div>

                            		<div class="col-xl-6">
                            			<div class="form-group">
                            				<label>Talent</label>
											<br>

											<?php echo $this->Form->select('talent_name',$talentNames,[ 'multiple' => 'multiple'
											,'label'=>false,'class'=>'chosen-select-width']); ?>
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
                            <div style="width: 100%;display: flex; align-items: center; justify-content: center;">
					         <?= $this->Form->button('Submit',['class'=>'btn btn-success']) ?>
                             <?= $this->Form->end() ?>
                                    <?php echo $this->Html->link('Cancel',
                                        array('controller' => 'Projects',
                                            'action' => 'index',
                                            'type' => 'button'),
                                        array('class' => 'btn btn-secondary'))
                                    ?>							 
                            </div>

				<!--end: Form Wizard Form-->
                </div>


</div>
</div>
</div>





<script>
    $(document).ready(function() {
        $(".chosen-select-width").chosen({
            width: "75%"
        });


    });
</script>





