<?php

include '../utilities/connection.php';

$q='';

if(@$_GET['users']=='many'){

  $filter_cdate=$_GET['date'];
  $from=$filter_cdate.' 00:00:00';
  $to=$filter_cdate.' 23:59:59';
  $q.='AND r1.reportdate between "'.$from.'" and "'.$to.'"';
  $filename = "employee_reports_" . date('Y-m-d') . ".csv";

}

else if(@$_GET['users']=='one'){

  if($_GET['name']!=""){

    $search_name=$_GET['name'];
    $q.='AND u1.name="'.$search_name.'"';
    $filename = $search_name."_report_" . date('Y-m-d') . ".csv";


  }

  if($_GET['date']!=""){

    $search_date=$_GET['date'];
    $from=$search_date.' 00:00:00';
    $to=$search_date.' 23:59:59';
    $q.='AND r1.reportdate between "'.$from.'" and "'.$to.'"';
    $search_date2=date('d-m-Y',strtotime($search_date));
    $filename = "Report_".$search_date2.".csv";

  }

}

$sql='SELECT u1.id,u1.name, r1.reporttitle, r1.description, r1.reportdate FROM report r1 INNER JOIN user u1 ON r1.userid=u1.id where 1=1 '.$q;
// echo $sql;
// exit;

// get records from database
$query = mysqli_query( $link,$sql);
$count= mysqli_num_rows($query);

if($count > 0){

  $delimiter = ",";

  // create a file pointer
  $f = fopen('php://memory', 'w');

  // set column headers
  $fields = array( 'Name', 'Report Title', 'Report Description','Submitted on');
  fputcsv($f, $fields, $delimiter);

  // output each row of the data, format line as csv and write to file pointer
  while($row=mysqli_fetch_array($query)){
    $rep_date=date('d-m-Y h:i:sa',strtotime($row['reportdate']));
    $lineData = array($row['name'],$row['reporttitle'],$row['description'],$rep_date);
    fputcsv($f, $lineData, $delimiter);
  }

  // move back to beginning of file
  fseek($f, 0);

  //set headers to download file rather than displayed
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $filename . '";');

  //output all remaining data on a file pointer
  fpassthru($f);
}

?>
