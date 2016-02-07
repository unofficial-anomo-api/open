These are some simple examples in html that will show you how to interact with the api and what information is actually returned.

Using these examples you'd be able to form some very simple tasks simply by saving these files to your computer and editing them as indicated by the example notes.

If you wanted to change your avatar you'd use the following files in their orders.

* login.html
* revealUpload.html
* updateAvatar.html

If you wanted to give yourself more invite points to get a Fan Page you could use 

* login.html
* invite.html

If you wanted to change your location you'd use

* login.html
* updateLocation.html

Remember that this is only for username/password type accounts. This will not work for FB login accounts.

Some other flow of logic examples you could make are:


 * **Auto-Ban**
 * using login.html grab token
 * using token search for username using /user/search_user/ end point to get their userid
 * using the /user/get_user_post/ end point get the activityid from one or all of their posts
 * using the /flag/ end point submit flagged reports for their posts
 
 
 * **Map users travels**
 * using login.html grab token
 * using /user/search_user/ get userid
 * using /user/get_user_post/ get the lat and lon for each post
 * using google maps api plot on map
 * only works if they aren't set to Earth
 
 
 * **Follow all your followers**
 * using login.html grab token
 * using /user/get_list_follower/ get list of your followers
 * using /user/get_list_following/ get list of who you follow
 * compare and use /user/follow/ to follow people on follower list that aren't on following list
 * alternatively, user /user/follow/ to unfollow anyone on your following list that isn't on your follower list
 * or alternatively, use /user/block/ twice to block and then unblock to on your follower list that you don't want following you
 
 
 * **Check if a friend is registered to Anomo**
 * use /user/check_username_or_email_is_existed/ and compare against email list you have
 
 
 * **Compare age of two accounts**
 * using login.html grab token
 * using /user/search_user/ find userid for user 1
 * using /user/search_user/ find userid for user 2
 * compare user 1 userid with user 2 userid, smaller value is older
 
 
 * **find out when someone joined**
 * using login.html grab token
 * using /user/search_user/ find userid
 * using /user/get_user_post/ get last activityid for page
 * add activityid to /user/get_user_post/ until last page
 * look for Type 28 post, this is the "_____ has joined" post.
 
 