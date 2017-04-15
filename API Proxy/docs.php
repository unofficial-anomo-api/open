<?php
include "header.php";
//include "pretty.php";
?>
			<div class="alert alert-dismissable alert-danger">
				<h4>
					Alert!
				</h4> <strong>Warning!</strong> Currently in development so requires additional beta key for each request. Keys will be given for testing upon request.
			</div>
			
			<div class="page-header">
				<h1>
					Authentication
				</h1>
						
			<div class="panel-group" id="panel-264118">
				<div class="panel panel-default">
					<div class="panel-heading">
					<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264118" href="#login">Login</a>
					</div>
					<div id="login" class="panel-collapse collapse">
						<div class="panel-body">
							<?php
							include "./docs/login.html";
							?>
							
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
					<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264118" href="#fblogin">Facebook Login</a>
					</div>
					<div id="fblogin" class="panel-collapse collapse">
						<div class="panel-body">
							<?php
							include "./docs/fblogin.html";
							?>
						</div>
					</div>
				</div>

				
				</div>
				</div>
				
				<div class="page-header">
				<h1>
					Feed
				</h1>
				<div class="panel panel-default">
					<div class="panel-heading">
					<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264118" href="#status">Post Status</a>
					</div>
					<div id="status" class="panel-collapse collapse">
						<div class="panel-body">
							<?php
							include "./docs/status.html";
							?>
						</div>
					</div>
				
				</div>
				
				<div class="page-header">
				<h1>
					User
				</h1>
				<div class="panel panel-default">
					<div class="panel-heading">
					<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264118" href="#user_search">User Search</a>
					</div>
					<div id="user_search" class="panel-collapse collapse">
						<div class="panel-body">
							<?php
							include "./docs/user_search.html";
							?>
						</div>
					</div>
				</div>
				
				
<?php
include "footer.php";
?>