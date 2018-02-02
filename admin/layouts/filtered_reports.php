<?php

include '../utilities/connection.php';
include 'admin_dashboard_header.php';

$filter_name=$_POST['filter_user'];
$filter_date=$_POST['filter_date'];
$from=$filter_date.' 00:00:00';
$to=$filter_date.' 23:59:59';
?>

<script>
  $(function(){
    $('body').on('click','.pages1',function(){
      var date          = '<?php echo $filter_date; ?>';
      var value_pages   = $(this).attr('value');
      var no_of_records = $("#no_of_records").val();
      var strlimit;

      if(value_pages=="rightas"){
        var start=$('#strlimit').attr("start");
        var last=$('#strlimit').attr("last");
        strlimit=last;
        if(eval(strlimit)<eval(no_of_records)){
          $("#strlimit").attr("start",last);
          $("#strlimit").attr("last",eval(last)+5);
          var y=$("#strlimit").attr("start");
          var z=$("#strlimit").attr("last");
        }
        else{
          return false;
        }
      }
      else if(value_pages=="leftas"){
        var start=$('#strlimit').attr("start");
        strlimit=start-5;
        if(strlimit >=0){
          $("#strlimit").attr("last",start);
          $("#strlimit").attr("start",strlimit);
        }
        else{
          return false;
        }
      }
      else if(value_pages=="other"){
        other_start=$(this).attr("start");
        other_end=$(this).attr("end");
        strlimit=other_start;
        $("#strlimit").attr("last",other_end);
        $("#strlimit").attr("start",other_start);
      }
      var dataString = {strlimit:strlimit,date:date,page:"filtered_reports"};
      $.ajax({
        type:"POST",
        data:dataString,
        dataType:"json",
        url:"../controller/pagination.php",
        success:function(result){
          var table='<tr><th>Name</th><th>Report Title</th><th>Report Description</th><th>Date</th></tr>';
          for(i=0;i<result.length;i++){

            table +='<tr><td class="id'+result[i].id+'">'+result[i].name+'</td><td class="report_title'+result[i].id+'">'+result[i].reporttitle+'</td><td class="report_description'+result[i].id+'">'+result[i].description+'</td><td class="report_date'+result[i].id+'">'+result[i].reportdate+'</td></tr>';
          }
          $(".data_table tbody").html(table);
        }
      })
    })
  })

</script>

<table class="table table-bordered table-hover data_table">
  <tbody>
    <?php
    if($filter_name=="" && $filter_date==""){
      header("Location:admin_reports.php?fields=empty");
      exit;
    }
    else{
      $cond = '';
      $reportOf = '';
      if($filter_name!=''){
        $cond .= ' AND u1.name="'.$filter_name.'"';
        $reportOf .= ' '.$filter_name;
      }
      if($filter_date!=''){
        $cond .= ' AND r1.reportdate between "'.$from.'" AND "'.$to.'"';
        $reportOf .= ' '.$filter_date;
      }
      $sql = 'SELECT u1.id,u1.name, r1.reporttitle, r1.description, r1.reportdate FROM report r1 INNER JOIN user u1 ON r1.userid=u1.id where 1=1 '.$cond.' LIMIT 5';
      $result=mysqli_query($link,$sql);
      if($result=mysqli_query($link,$sql)){
        $data="";
        $data.='<h3>Reports of '.$reportOf.'</h3>';
        if(mysqli_num_rows($result)>0){
          $table='';
          $table='<tr><th scope="col">Name</th><th scope="col">Report Title</th><th scope="col">Report Description</th><th scope="col">Submitted on</th>';
          while($row=mysqli_fetch_array($result)){
            $table.='<tr>
            <td class="name'.$row['id'].'">'.$row['name'].'</td>
            <td class="report_title'.$row['id'].'">'.$row['reporttitle'].'</td>
            <td class="report_description'.$row['id'].'">'.$row['description'].'</td>
            <td class="report_date'.$row['id'].'">'.$row['reportdate'].'</td>
            </tr>';
          }
          $table.='</tbody></table>';
          ?>
          <a href="../controller/report_excel.php?users=one&name=<?php echo $filter_name; ?>&date=<?php echo $filter_date; ?>" class="excel_btn" style="padding:5px;text-align:center;">
           <button class="btn" style="background-color:green;float:right;border-radius:0px;color:white;">
            Download Reports
           </button>
          </a>
          <?php
          echo $data;
          echo $table;
          ?>
          <div style="text-align:center;">
            <input type="hidden" id="strlimit" value="5" start="0" last="5">
            <ul class="pager" id="pager">
              <li>
                <a class="pages1" value="leftas" style="width:40px;cursor:pointer"><</a>
              </li>
              <?php

              $from=$filter_date.' 00:00:00';
              $to=$filter_date.' 23:59:59';

              if($filter_date!=""){
                $sql='SELECT * FROM report WHERE reportdate BETWEEN "'.$from.'" and "'.$to.'"';
              }
              if($filter_name!=""){
                $sql='SELECT * FROM report r1 INNER JOIN user u1 on r1.userid=u1.id WHERE name="'.$filter_name.'"';
              }
              if($filter_date!="" && $filter_name!=""){
                $sql='SELECT * FROM report r1 INNER JOIN user u1 on r1.userid=u1.id WHERE name="'.$filter_name.'" AND reportdate BETWEEN "'.$from.'" and "'.$to.'"';
              }
              $query = mysqli_query($link,$sql);
              $count =mysqli_num_rows($query);
              echo "<li><input type='hidden' id='no_of_records' value='".$count."'/><li>";
              for($i=1;$i<(($count/5)+(1));$i++){
                $temp=$i*5;
                echo "<li><a class='pages1' value='other' start=".($temp-5)." end=".$temp." style='width:40px;cursor:pointer'>".$i."</a></li>";
              }
              ?>
              <li>
                <a class="pages1" value="rightas" style="width:40px;cursor:pointer;">></a>
              </li>
            </ul>
          </div>
          <?php
        }
        else{
          ?>
          <div style="color:red;weight:bold;width:100%;padding:20px;font-size:20px;text-align:center;background-color:#eee">No Data Found</div>
          <?php
        }
      }
    }
    ?>

<?php include 'admin_dashboard_footer.php' ?>
