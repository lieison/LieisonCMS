
<div class="todo-sidebar">
<div class="portlet light">
<div class="portlet-title">
<div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
<?php 
/*
 * CONTROL DE TAREAS 
 * 
 * **/ ?>
 <select class="selectpicker" id="task_selected">
    <option data-content='Aplicaciones&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge">42</span>'></option>
</select>
</div>
<div class="actions">
										<div class="btn-group">
											<a class="btn green-haze btn-circle btn-sm todo-projects-config" href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
											<i class="icon-settings"></i> &nbsp; <i class="fa fa-angle-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li>
													<a href="#">
													<i class="i"></i> New Project </a>
												</li>
												<li class="divider">
												</li>
												<li>
													<a href="#">
													Pending <span class="badge badge-danger">
													4 </span>
													</a>
												</li>
												<li>
													<a href="#">
													Completed <span class="badge badge-success">
													12 </span>
													</a>
												</li>
												<li>
													<a href="#">
													Overdue <span class="badge badge-warning">
													9 </span>
													</a>
												</li>
												<li class="divider">
												</li>
												<li>
													<a href="#">
													<i class="i"></i> Archived Projects </a>
												</li>
											</ul>
										</div>
									</div>
								</div>

<div class="portlet-body ">
<div class="scroller" style="height:600px" data-always-visible="1" data-rail-visible="0">
<div class="row" id="sortable_portlets">
  <?php
        /**
         * ESPACIO PARA QUE CARGUEN LAS TAREAS
         *          
         * METODO DE CARGA : AJAX 
         * FUNCTION: TaskInit.init();
         * DIRECOTORIO: js/Function.js
         * 
        */
?>
</div>
</div>
</div>
</div>
</div>

