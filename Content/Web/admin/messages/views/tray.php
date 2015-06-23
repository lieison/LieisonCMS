<?php

$id     =   Session::GetSession("login" , "id");
$message = new MessageController();

?>

<div class="row inbox">
				<div class="col-md-2">
					<ul class="inbox-nav margin-bottom-10">
						<li class="compose-btn">
							<a href="javascript:;" data-title="Compose" class="btn green">
							<i class="fa fa-edit"></i> Redactar </a>
						</li>
                                                <li onclick="event_(1);" id="tray_1" class="inbox active">
                                                    <a id="count_tray_1" href="javascript:;" class="btn" data-title="Inbox">
							Inbox () </a>
							<b></b>
						</li>
                                                <li onclick="event_(2);" id="tray_2" onclick="" class="sent">
							<a id="count_tray_2" class="btn" href="javascript:;" data-title="Sent">
							Enviados () </a>
							<b></b>
						</li>
                                                <li onclick="event_(3);" id="tray_3" class="trash">
							<a id="count_tray_3" class="btn" href="javascript:;" data-title="Trash">
							Papelera () </a>
							<b></b>
						</li>
					</ul>
				</div>
				<div class="col-md-10">
					<div class="inbox-header">
						
					</div>
					<div class="inbox-loading" style="display: block;">
						
					</div>
					<div class="inbox-content"></div>
				</div>
</div>

