<?php



use Carbon\Carbon;

use Spatie\GoogleCalendar\Event;



$type = $_POST['type'];

if($type == 'new')
{
	$startdate = $_POST['startdate'].'+'.$_POST['zone'];
	$title = $_POST['title'];
	$insert = mysqli_query($con,"INSERT INTO calendar(`title`, `startdate`, `enddate`, `allDay`) VALUES('$title','$startdate','$startdate','false')");
	$lastid = mysqli_insert_id($con);
	echo json_encode(array('status'=>'success','eventid'=>$lastid));
}

if($type == 'changetitle')
{
	$eventid = $_POST['eventid'];
	$title = $_POST['title'];
	$update = mysqli_query($con,"UPDATE calendar SET title='$title' where id='$eventid'");
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'resetdate')
{
	$title = $_POST['title'];
	$startdate = $_POST['start'];
	$enddate = $_POST['end'];
	$eventid = $_POST['eventid'];
	echo $eventid;
	$event = Event::find($eventiid);
	$event->startDate = $startdate;
	$event->endDate = $enddate;
	$event->update();


	$update=$event ;
	if($update)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'remove')
{
	$eventid = $_POST['eventid'];
	$delete = mysqli_query($con,"DELETE FROM calendar where id='$eventid'");
	if($delete)
		echo json_encode(array('status'=>'success'));
	else
		echo json_encode(array('status'=>'failed'));
}

if($type == 'fetch')
{
	$events = array();
	$query =  Event::get();
;
	foreach($query as $fetch)
	{
	$e = array();
    $e['id'] = $fetch['id'];
    $e['title'] = $fetch['name'];
    $e['start'] = $fetch['startDateTime'];
    $e['end'] = $fetch['endDateTime'];

    $allday =  true;
    $e['allDay'] = $allday;

    array_push($events, $e);
	}
	echo json_encode($events);
}


