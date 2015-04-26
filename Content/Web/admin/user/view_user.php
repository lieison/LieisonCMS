<?php



?>

	<div class="todo-sidebar">
							<div class="portlet light">
								<div class="portlet-title">
									<div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
                                                                            <select class="selectpicker">
                                                                              <option data-content="<span class='label label-success'>Aplicaciones</span>"></option>
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

<!--<div class="scroller" style="height:800px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">-->
	<div id="sortable_portlets" class="tiles">
				<div onclick="window.location.href='../task/';"  class="tile double-down bg-blue-hoki">
					<div class="tile-body">
						<i class="fa fa-calendar"></i>
					</div>
					<div class="tile-object">
                                            
						<div class="name">
							 Tareas Pendientes
						</div>
						<div class="number">
							 7
						</div>
					</div>
				</div>
                               
            <div class="tile bg-red-sunglo">
					<div class="tile-body">
						<i class="fa fa-calendar"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Meetings
						</div>
						<div class="number">
							 12
						</div>
					</div>
				</div>
				<div class="tile double selected bg-green-turquoise">
					<div class="corner">
					</div>
					<div class="check">
					</div>
					<div class="tile-body">
						<h4>support@metronic.com</h4>
						<p>
							 Re: Metronic v1.2 - Project Update!
						</p>
						<p>
							 24 March 2013 12.30PM confirmed for the project plan update meeting...
						</p>
					</div>
					<div class="tile-object">
						<div class="name">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="number">
							 14
						</div>
					</div>
				</div>
				<div class="tile selected bg-yellow-saffron">
					<div class="corner">
					</div>
					<div class="tile-body">
						<i class="fa fa-user"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Members
						</div>
						<div class="number">
							 452
						</div>
					</div>
				</div>
				<div class="tile double bg-blue-madison">
					<div class="tile-body">
						<img src="../../assets/admin/pages/media/profile/photo1.jpg" alt="">
						<h4>Announcements</h4>
						<p>
							 Easily style icon color, size, shadow, and anything that's possible with CSS.
						</p>
					</div>
					<div class="tile-object">
						<div class="name">
							 Bob Nilson
						</div>
						<div class="number">
							 24 Jan 2013
						</div>
					</div>
				</div>
				<div class="tile bg-purple-studio">
					<div class="tile-body">
						<i class="fa fa-shopping-cart"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Orders
						</div>
						<div class="number">
							 121
						</div>
					</div>
				</div>
				<div class="tile image selected">
					<div class="tile-body">
						<img src="../../assets/admin/pages/media/gallery/image2.jpg" alt="">
					</div>
					<div class="tile-object">
						<div class="name">
							 Media
						</div>
					</div>
				</div>
				<div class="tile bg-green-meadow">
					<div class="tile-body">
						<i class="fa fa-comments"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Feedback
						</div>
						<div class="number">
							 12
						</div>
					</div>
				</div>
				<div class="tile double bg-grey-cascade">
					<div class="tile-body">
						<img src="../../assets/admin/pages/media/profile/photo2.jpg" alt="" class="pull-right">
						<h3>@lisa_wong</h3>
						<p>
							 I really love this theme. I look forward to check the next release!
						</p>
					</div>
					<div class="tile-object">
						<div class="name">
							<i class="fa fa-twitter"></i>
						</div>
						<div class="number">
							 10:45PM, 23 Jan
						</div>
					</div>
				</div>
				<div class="tile bg-red-intense">
					<div class="tile-body">
						<i class="fa fa-coffee"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Meetups
						</div>
						<div class="number">
							 12 Jan
						</div>
					</div>
				</div>
				<div class="tile bg-green">
					<div class="tile-body">
						<i class="fa fa-bar-chart-o"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Reports
						</div>
						<div class="number">
						</div>
					</div>
				</div>
				<div class="tile bg-blue-steel">
					<div class="tile-body">
						<i class="fa fa-briefcase"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Documents
						</div>
						<div class="number">
							 124
						</div>
					</div>
				</div>
				<div class="tile image double selected">
					<div class="tile-body">
						<img src="../../assets/admin/pages/media/gallery/image4.jpg" alt="">
					</div>
					<div class="tile-object">
						<div class="name">
							 Gallery
						</div>
						<div class="number">
							 124
						</div>
					</div>
				</div>
				<div class="tile bg-yellow-lemon selected">
					<div class="corner">
					</div>
					<div class="check">
					</div>
					<div class="tile-body">
						<i class="fa fa-cogs"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Settings
						</div>
					</div>
				</div>
				<div class="tile bg-red-sunglo">
					<div class="tile-body">
						<i class="fa fa-plane"></i>
					</div>
					<div class="tile-object">
						<div class="name">
							 Projects
						</div>
						<div class="number">
							 34
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>

<!--</div>-->                                                           
                                                            
</div>
</div>
</div>
</div>