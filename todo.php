<?php
//just a todo list that wasn't update much on what needed to be done
session_start();
include "header.php";
include "session.php";
$token = $_SESSION["token"];
?>
<div class="panel-group" id="panel-921148">
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-921148" href="#panel-element-262272">Feed Page</a>
					</div>
					<div id="panel-element-262272" class="panel-collapse collapse">
						<div class="panel-body">
							<ol>
							<li><strike>Feed Preferences: Make selection functional.</strike></li>
							<li><strike>Post Status: Add status</strike>, anon, picture posting ability. </li>
							<li><strike>User Details: Add user location and age</strike></li>
							<li>Likes: Make possible to like posts with Jquery(?).</li>
							<li><strike>Delete Regular Posts: Add delete option on own posts.</strike></li>
							<li>Block Anon: Add option to block anon post</li>
							<li>Delete Anon: Add option to delete your own anon posts.</li>
							<li><strike>Follow/Unfollow: Add button for following/unfollowing user.</strike></li>
							<li><strike>Block: Add button for blocking user.</strike></li>
							<li><strike>Announcement: Add removal button, remove like and comment links.</strike></li>
							<li>Back: Add back button on subsequent pages so you can navigate back also.</li>
							<li><strike>Report: Add report option for post.</strike></li>
							<li><strike>YouTube: Add YouTube embeded item.</strike></li>
							</ol>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-921148" href="#panel-element-681214">Comment Page</a>
					</div>
					<div id="panel-element-681214" class="panel-collapse collapse">
						<div class="panel-body">
							<ol>
							<li><strike>Comment Order: Reverse order of comments so top->bottom, not bottom->top.</strike></li>
							<li><strike>User Details: Add user location and age.</strike></li>
							<li><strike>Like: Ability to like comments.</strike></li>
							<li>Notification: Add option to disable/enable notifications.</li>
							<li><strike>Report: Add report option for post/comment.</strike></li>
							<li><strike>Block: Add button to block user from comment.</strike>.</li>
							<li><strike>Like List: Add link to view like list for post and comments.</strike></li>
							<li><strike>Follow/Unfollow: Add option to follow/unfollow user from comment.</strike></li>
							</ol>
						</div>
					</div>
					</div>
					<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-921d148" href="#panel-element-681214d">Profile Page</a>
					</div>
					<div id="panel-element-681214d" class="panel-collapse collapse">
						<div class="panel-body">
							<ol>
							<li><strike>Anon Fan Post: Add ability to optionally post anonymous to user's fan page.</strike></li>
							<li><strike>User Details: Add user location and age.</strike></li>
							<li><strike>Follower: Add link to follower list for user.</strike></li>
							<li><strike>Following: Add link to following list for user.</strike></li>
							<li><strike>Added basic ability to search posts for text for last 500 posts.</strike></li>
							<li>Points: Add link to user's point page.</li>
							<li>Like: Add function to like posts.</li>
							<li><strike>Follow: Add ability to follow user.</strike>.</li>
							<li><strike>Block: Add ability to block user.</strike></li>
							<li><strike>Report: Add ability to report user.</strike></li>
							<li><strike>YouTube: Add YouTube embeded item.</strike></li>
							</ol>
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-9211481" href="#panel-element-6812141">Search Page</a>
					</div>
					<div id="panel-element-6812141" class="panel-collapse collapse">
						<div class="panel-body">
							<ol>
							<li>Search Types: Add hashtag and keyword searchs.</li>
							<li><strike>User Details: Add user location and age.</strike></li>
							<li>Back: Add back button from search results to go back to search results.</li>
							</ol>
						</div>
					</div>
					</div>
					<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-92114281" href="#panel-element-68121241">Following/Followers Page</a>
					</div>
					<div id="panel-element-68121241" class="panel-collapse collapse">
						<div class="panel-body">
							<ol>
							<li><strike>Build: Start creating pages.</strike></li>
							<li><strike>User Details: Add user location and age.</strike></li>
							<li>Compare: Add followers vs following results to follow/unfollow users.</li>
							</ol>
						</div>
					</div>
					</div>
					<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-922114281" href="#panel-element-682121241">Notification Page</a>
					</div>
					<div id="panel-element-682121241" class="panel-collapse collapse">
						<div class="panel-body">
							<ol>
							<li><strike>Build It: Add to list once deficiencies realized.</strike></li>
							<li>User Details: Add user location and age</li>
							<li>Acknowledge Notifications: Add option to acknowledge notifications received.</li>
							<li>Notification Bar: Add notification notice to menu.</li>
							</ol>
						</div>
					</div>
					</div>
			</div>
			
			
			
			
			
			
<?php include "footer.php"; ?>