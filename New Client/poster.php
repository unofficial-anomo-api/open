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
						<a href="#panel-866023" data-toggle="tab">Post</a>
					</li>
					<li>
						<a href="#panel-218352" data-toggle="tab">Pic</a>
					</li>
					<li>
						<a href="#panel-2183" data-toggle="tab">Poll</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="panel-866023">
						<p>
						<form role="form" action="posting.php" method="post">
					<div class="form-group">
					<label for="exampleInputpwd1">Post</label>
					<textarea name="post" class="form-control counted" placeholder="Add to the conversation" rows="5" style="margin-bottom:10px;"/></textarea>
					<label><input type="checkbox" name="anon" value="1"/>Make Anonymous</label>
					 <input type="hidden" name="messaged" value="1">
					 
				</div>
			 <button type="submit" class="btn btn-info">Submit</button>
			</form>
			
						</p>
					</div>
					<div class="tab-pane" id="panel-218352">
						<p>
						<center>	<form action="upload.php" method="post" enctype="multipart/form-data">
							<textarea name="status" class="form-control counted" placeholder="Add to the conversation" rows="5" style="margin-bottom:10px;"/></textarea><br>
			 <input type='file' onchange="readURL(this);" name="myFile" id="fileToUpload"/>
    <img id="blah" src="#" alt="your image" />
		<input type="submit" value="Upload">
							<script>
							function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }</script>
		</center>
 </form>
						</p>
					</div>
					<div class="tab-pane" id="panel-2183">
						<p>
							Howdy, I'm in Section 2.
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