						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						        <h4 class="modal-title" id="myModalLabel">Post</h4>
						      </div>
						      <div class="modal-body">
						       <div class="tabbable" id="tabs-258557">
												<ul class="nav nav-tabs">
					<li class="active">
						<a href="#panel-866023" data-toggle="tab">Comment</a>
					</li>
					
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-866023">
						<p>
						<form role="form" action="commenting.php" method="post">
					<div class="form-group">
					
					<textarea name="post" class="form-control counted" placeholder="Add to the conversation" rows="5" style="margin-bottom:10px;"/></textarea>
					 <input type="hidden" name="messaged" value="1">
					 <input type="hidden" name="refid" value="<?php echo $id; ?>">
					 
				</div>
			 <button type="submit" class="btn btn-info">Submit</button>
			</form>
			
						</p>
					</div>
					
				</div>
			</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>  