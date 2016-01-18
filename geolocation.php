<?php
function getaddress($lat,$lng)
{
$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
$json = @file_get_contents($url);
$data=json_decode($json);
$status = $data->status;
if($status=="OK")
return $data->results[0]->formatted_address;
else
return false;
}
$lat= $_POST['lat']; //latitude
$lng= $_POST['lon'];

$address= getaddress($lat,$lng);
if($address)
{
echo $address;
}
else
{
echo "Not found";
}
?>

<form role="form" action="geolocation.php" method="post">
				<div class="form-group">
					 <label for="exampleInputEmail1">Lat</label><input type="text" name="lat"/>
					 <label for="exampleInputEmail1">Lon</label><input type="text" name="lon"  />
				</div>
				</div> <button type="submit" class="btn btn-default btn-block">Submit</button>
			</form>