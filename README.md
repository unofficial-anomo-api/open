# open
This is a completely unofficial client for Anomo.com. It includes a half-assed client to their mobile app as well as some addons like an avatar changer and some simple bots. The folder xyz also has a half built api proxy that should list most of the functions for interacting with the system.

I've sanatized some of the details and too lazy to add the db details and most of it isn't commented. 

If you really have questions about any of it you can email me at nason000 at gmail.com but I can't promise that I'll respond.

Ok I'm adding some api endpoints in a really sloppy notation that i worked off in an email when i first started working on this. most of the queries are post requests. some are gets. you can figure it out probably. ifyou cant search the repositories for how i implemented it. 

*note: version number is based on the build. v208 is the last to currently still function.

http://ws.anomo.com/v208/index.php/webservice/activity/close_announcement/7YEVOARGMEKWND5B4F3W/40
Close Announcements
Code=Ok

http://ws.anomo.com/v208/index.php/webservice/activity/comment/BYD2K3KM4PFB4CEU2HXY/1266/27
Comment
Name="Content" -> Value="test"
Avatar, BirthDate, CheckinStatus, Content, CreatedDate, FacebookID, ID, NeighbourhoodID, NeighbourhoodName, PlaceID, PlaceName, UserID, Username

http://ws.anomo.com/v208/index.php/webservice/activity/detail/BYD2K3KM4PFB4CEU2HXY/1266/27
Activity Details - Picture
ActivityType, ActivityID, Avatar, BirthDate, CheckinPlaceID, CheckinPlaceName, CheckinStatus, Comment, CreatedDate, FacebookID, FromUserID, FromUserName, Gender, GiftFReceiverID, GiftReceiverName, Image, IsComment, IsFavorite, IsInvalid, IsLike, IsReported, IsStopReceiveNotify, LastUpdate, Lat, Like, List, Location, Lon, Message, NeibourhoodID, NeighbourhoodName, OriginalDate, OwnerAvatar, OwnerID, OwnerName, PlaceAddress, PlaceIcon, PlaceID, PlaceName, RefID, Share, Type

http://ws.anomo.com/v208/index.php/webservice/activity/detail/BYD2K3KM4PFB4CEU2HXY/2386/1
Activity Details - Status
ActivityType, ActivityID, Avatar, BirthDate, CheckinPlaceID, CheckinPlaceName, CheckinStatus, Comment, CreatedDate, FacebookID, FromUserID, FromUserName, Gender, GiftFReceiverID, GiftReceiverName, Image, IsComment, IsFavorite, IsInvalid, IsLike, IsReported, IsStopReceiveNotify, LastUpdate, Lat, Like, List, Location, Lon, Message, NeibourhoodID, NeighbourhoodName, OriginalDate, OwnerAvatar, OwnerID, OwnerName, PlaceAddress, PlaceIcon, PlaceID, PlaceName, RefID, Share, Type

http://ws.anomo.com/v208/index.php/webservice/activity/get_activities/7YEVOARGMEKWND5B4F3W/1/0/-1/0/0/0/0/0
Get User Activities

http://ws.anomo.com/v208/index.php/webservice/activity/like/BYD2K3KM4PFB4CEU2HXY/1266/27
Like
Code, ContentID, LatestLikeUserID, LatestLikeUserName, NumberOfLike

http://ws.anomo.com/v208/index.php/webservice/anomotion/random_anomo/BYD2K3KM4PFB4CEU2HXY
Random Game

http://ws.anomo.com/v208/index.php/webservice/anomotion/request_single_game/BYD2K3KM4PFB4CEU2HXY/1500/-1
Single User Game
AnomotionID, Avatar, BirthDate, Code, CoverPicture, Credits, FacebookID, NeighbourhoodID, NeighbourhoodName, TargetUserID, TargetUserName

http://ws.anomo.com/v208/index.php/webservice/flag/add/XE9STLY6UTRWEENWLYO1/1500
Flag Post

http://ws.anomo.com/v208/index.php/webservice/push_notification/get_notification_history/7YEVOARGMEKWND5B4F3W/1/1
Notification Numbers

http://ws.anomo.com/v208/index.php/webservice/user/block_user/YW5AFCQOTRYSGK3BOBZN/34240
Block User

http://ws.anomo.com/v208/index.php/webservice/user/check_app_version/2.0/android
Check Version

http://ws.anomo.com/v208/index.php/webservice/user/check_username_or_email_is_existed
Check If Email Exists
Username="username"
Email="email@email.com"

http://ws.anomo.com/v208/index.php/webservice/user/follow/YW5AFCQOTRYSGK3BOBZN/1500
Follow User

http://ws.anomo.com/v208/index.php/webservice/user/get_blocked_users/YW5AFCQOTRYSGK3BOBZN/34285
Get Blocked User List

http://ws.anomo.com/v208/index.php/webservice/user/get_list_follower//BYD2K3KM4PFB4CEU2HXY/14/1
Get Followers List

http://ws.anomo.com/v208/index.php/webservice/user/get_list_following//BYD2K3KM4PFB4CEU2HXY/14/1
GEt Following List

http://ws.anomo.com/v208/index.php/webservice/user/get_user_info/BYD2K3KM4PFB4CEU2HXY/14
Get User Info
AboutMe, Avatar, BirthDate, CoverPhoto, Credits, Email, FacebookID, FbEmail, FullPhoto, Gender, IsFavorite, IsReported, ListIntent, NeighborhoodID, NeighborhoodName, NumberOfFollowers, NumberOfFollowing, ProfileStatus, Tags, UserID, UserName

http://ws.anomo.com/v208/index.php/webservice/user/get_user_post/BYD2K3KM4PFB4CEU2HXY/14/1
Get User Posts
ActivityType, ActivityID, Avatar, BirthDate, CheckinPlaceID, CheckinPlaceName, CheckinStatus, Comment, CreatedDate, FacebookID, FromUserID, FromUserName, Gender, GiftReceiverID, GiftReceiverName, Image, IsBlock, IsBlockTarget, IsComment, IsValid, IsLike, IsReported, IsStopReceiveNotify, LastUpdate, Lat, Like, Lon, Message, NeighborhoodID, NeighborhoodName, OriginalDate, OwnerID, OwnerName, PlaceAddress, PlaceIcon, PlaceID, PlaceName, RefID, Type

http://ws.anomo.com/v208/index.php/webservice/user/list_avatar/1
List Male Avatars

http://ws.anomo.com/v208/index.php/webservice/user/list_avatar/2
List Female Avatars

http://ws.anomo.com/v208/index.php/webservice/user/list_intent
List Intent

http://ws.anomo.com/v208/index.php/webservice/user/list_interests
List Interests

http://ws.anomo.com/v208/index.php/webservice/user/login/
User Login
Username="username", Password="md5_password"
About, AllowAnomotionNotice, AllowChatNotice, AllowFollowNotice, AllowLikeActivityNotice, AllowRevealNotice, AllowSendGiftNotice, Avatar, BirthDate, Code, CoverPicture, Credits, Email, FacebookID, FbEmail, FullPhoto, Gender, ListIntent, ProfileStatus, Tags, Token, UserID, UserName

http://ws.anomo.com/v208/index.php/webservice/user/login_with_fb/
Login With FB
FacebookID="FbID", FbAccessToken="CA_Token", Email="email@email.com"
About, AllowAnomotionNotice, AllowChatNotice, AllowFollowNotice, AllowLikeActivityNotice, AllowRevealNotice, AllowSendGiftNotice, Avatar, BirthDate, Code, CoverPicture, Credits, Email, FacebookID, FbEmail, FullPhoto, Gender, ListIntent, ProfileStatus, Tags, Token, UserID, UserName

http://ws.anomo.com/v208/index.php/webservice/user/logout/7YEVOARGMEKWND5B4F3W/34285
Logout User

http://ws.anomo.com/v208/index.php/webservice/user/register
Register User
Email="email@email.com", Password="md5_password", UserName="user_name", BirthDate="1986-01-07", Gender="1", Tags="stuff", IntentIDs="1,5", Photo="crop_cau_male_5.png"
Avatar, BirthDate, code, Credits, Email, FacebookID, FbEmail, FullPhoto, Gender, IntentIDs, Photo, Token, UserID, UserName
Registering with Username requires Username value, Registering with FB requires FacebookID

http://ws.anomo.com/v208/index.php/webservice/user/register_device/YW5AFCQOTRYSGK3BOBZN
Device Registration
DeviceID="ID", Platform="android"

http://ws.anomo.com/v208/index.php/webservice/user/search_user/BYD2K3KM4PFB4CEU2HXY/34283/53.4630275/-113.4410933/1/0/0/0
Search User
Keyword="", IsSearchTag="0", City="Edmonton", State="AB", Country="Canada"
Avatar, BirthDate, Distance, Email, FacebookID, Gender, IsBlock, IsBlockTarget, IsFavorite, IsOnline, Lat, Lon, NeighborhoodID, NeighborhoodName, PlaceID, PlaceName, ProfileStatus, Status, Tags, UserID, UserName

http://ws.anomo.com/v208/index.php/webservice/user/update/BYD2K3KM4PFB4CEU2HXY
Update Profile
BirthDate="1981-01-07", Gender="1", Tags="Random,more,", Photo="http://anomo-sandbox.s3.amazonaws.com/Upload/crop_cau_male_5.png", CoverPhoto="http://anomo-sandbox.s3.amazonaws.com/Upload/conver_picture_bg.png", IntentIDs="1", Photo="crop_cau_male_5.png", AboutMe="something"
Avatar, BirthDate, Distance, Email, FacebookID, Gender, IsBlock, IsBlockTarget, IsFavorite, IsOnline, Lat, Lon, NeighborhoodID, NeighborhoodName, PlaceID, PlaceName, ProfileStatus, Status, Tags, UserID, UserName

http://ws.anomo.com/v208/index.php/webservice/user/update_privacy/BYD2K3KM4PFB4CEU2HXY/34283
Update Privacy Settings
AllowSendGiftNotice="0", AllowRevealNotice="0", AllowChatNotice="0", AllowAnomotionNotice="0", AllowCommentActivityNotice="0", AllowLikeActivityNotice="0", AllowFollowNotice="0"

http://ws.anomo.com/v208/index.php/webservice/user/update_user_location/7YEVOARGMEKWND5B4F3W/34285/53.4630336/-113.4410239
Update Location
Cit="Edmonton", State="AB", Country="Canada"
