<?php

//$id     =   Session::GetSession("login" , "id");
$adm = new AdminController();
$search  = $adm->GetuserByParent(session::GetSession("login" , "id"));


echo '<input type="hidden" id="id_asing_to"' . "value='" 
,  json_encode($search) ,  "'" , '/>';

?>
<input type="hidden" id="text_area_data" value="" />
<div class="row inbox">
				<div class="col-md-2">
					<ul class="inbox-nav margin-bottom-10">
                                            <li id="cmd_compose" class="compose-btn">
                                                <a  id="load_compose" href="javascript:load_compose();" data-title="Compose" class="btn green">
                                                       <i class="fa fa-edit"></i> Redactar 
                                                </a>
						</li>
                                                <li onclick="event_(1);" id="tray_1" class="inbox active">
                                                    <a id="count_tray_1" href="javascript:;" class="btn" data-title="Inbox">
							Entrada (?) </a>
							<b></b>
						</li>
                                                <li onclick="event_(2);" id="tray_2" onclick="" class="sent">
							<a id="count_tray_2" class="btn" href="javascript:;" data-title="Sent">
							Leidos (?) </a>
							<b></b>
						</li>
                                                <li onclick="event_(3);" id="tray_3" class="trash">
							<a id="count_tray_3" class="btn" href="javascript:;" data-title="Trash">
							Enviados (?) </a>
							<b></b>
						</li>
                                                <li onclick="event_(4);" id="tray_4" class="trash">
							<a id="count_tray_4" class="btn" href="javascript:;" data-title="Trash">
							Papelera (?) </a>
                                                <b>
					</ul>
				</div>
				<div class="col-md-10">
					<div class="inbox-header">
						
					</div>
					<div class="inbox-loading" style="display: block;">
						<div class="portlet box ">
                                                     
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover" id="messages_table">
                                                         <thead>
                                                         <tr id="messages_head">
								<th class="table-checkbox">
                                       
								</th>
								<th>
									
								</th>
								<th>
									
								</th>
								<th>
									 
								</th>
								<th>
									 
								</th>
								<th>
									 
								</th>
							</tr>
                                                       
							</thead>
                                                         <tbody id="messages_body">
                                                                        
                                                        </tbody>
							</table>
						</div>
					</div>
					</div>
                                        <div class="inbox-content">
                                                
                                        </div>
				</div>
</div>

