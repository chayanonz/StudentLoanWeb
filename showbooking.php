<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Loan@SUT</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <style>
    @font-face {
      font-family: ff;
      /*a name to be used later*/
      src: url(font/Kanit-Light.ttf);
      /*URL to font*/
    }

    body,
    h1,
    h2,
    h3,
    h4,
    h5 {
      font-family: "ff"
    }

    body {
      font-size: 16px;
    }

    .w3-half img {
      margin-bottom: -6px;
      margin-top: 16px;
      opacity: 0.8;
      cursor: pointer
    }

    .w3-half img:hover {
      opacity: 1
    }
  </style>
</head>

<body style="background-color:#fff2a9;">

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;background-color:#ffb347;" id="mySidebar">
    <br>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
    <div class="w3-container">
      <center>
        <img src="./img/slfLogo.png" height="100" width="100" style="border-radius: 10px;margin-top:20px;margin-bottom:-40px;">
        <h5 class="w3-padding-64"><b>ระบบกองทุนกู้ยืมเพื่อการศึกษา<br>(Student Loan@SUT)</b></h4>
      </center>

    </div>
    <div class="w3-bar-block" style="margin-top:-40px;margin-left:-15px;">

      <a href="searchdocument.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-clipboard-check'></i>
        <font size="3">&nbsp;ตรวจสอบเอกสารการขอกู้ยืม</font>
      </a>
      <a href="showbooking.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white" style="background-color:#ffffff;">
        <i class='fas fa-clock'></i>
        <font size="3">&nbsp;วัน-เวลาจองคิวยื่นเอกสารคำขอกู้</font>
      </a>
      <a href="showuploaddate.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-clock'></i>
        <font size="3">&nbsp;วันเปิด-ปิดระบบอัพโหลดเอกสาร</font>
      </a>
      <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">
        <i class='fas fa-sign-out-alt'></i>
        <font size="3">&nbsp;ออกจากระบบ</font>
      </a>
      <!-- <a href="#services" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Services</a> 
    <a href="#designers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Designers</a> 
    <a href="#packages" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Packages</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact</a> -->
    </div>
  </nav>

  <!-- Top menu on small screens -->
  <header class="w3-container w3-top w3-hide-large w3-xlarge w3-padding" style="background-color:#ffb347;">
    <a href="javascript:void(0)" class="w3-button w3-margin-right" style="background-color:#ffb347;" onclick="w3_open()">☰</a>
    <!-- <span>Company Name</span> -->
  </header>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:340px;margin-right:40px">
    <?php
    if (!$conn) {
      echo $conn->connect_error;
      exit();
    }
    $strSQL = "SELECT * FROM `tb_define_booking`";
    $objQuery = mysqli_query($conn, $strSQL);
    ?>
    <!-- Header -->
    <div class="w3-container" style="margin-top:80px;" id="showcase">
      <h3><b>กำหนดวัน-เวลาจองคิวยื่นเอกสารคำขอกู้</b></h3>
      <div class="form-group row">
        <div class="col-md-11">
          <button type="button" class="btn btn-success" style="margin-left:100%;" data-toggle="modal" data-target="#myModal">เพิ่มข้อมูล</button>
        </div>
      </div>
      <table id="example" class="table table-striped " style="width:100%;background-color:#fff;">
        <thead>
          <tr>
            <th>
              <div align="center">วันจองคิว</div>
            </th>
            <th>
              <div align="center">เวลาเริ่มต้น</div>
            </th>
            <th>
              <div align="center">เวลาสิ้นสุด</div>
            </th>
            <th>
              <div align="center">จำนวนคิวที่รับ</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($result = mysqli_fetch_array($objQuery, MYSQLI_ASSOC)) {
          ?>
            <tr>
              <td>
                <div align="center"><?php echo date_format(date_create($result["define_booking_date_start"]), "d/M/Y"); ?></div>
              </td>
              <td>
                <div align="center"><?php echo $result["define_booking_time_start"]; ?></div>
              </td>
              <td>
                <div align="center"><?php echo $result["define_booking_time_end"]; ?></div>
              </td>
              <td>
                <div align="center"><?php echo $result["maximum_queue"]; ?></div>
              </td>
              <td><?php echo "<button type=\"button\" class=\"btn btn-primary\" style=\"margin-top:-5px;\" onclick=\"edit(" . $result['define_booking_id'] . ")\">แก้ไข</button>" ?></td>
              <td><?php echo "<button type=\"submit\" class=\"btn btn-danger\" style=\"margin-top:-5px;\" onclick=\"del(" . $result['define_booking_id'] . ")\">ลบข้อมูล</button>" ?></td>
            </tr>

          <?php
          }
          ?>
        </tbody>
        <!-- <tfoot>
          <tr>
            <th>
              <div align="center">วันจองคิว</div>
            </th>
            <th>
              <div align="center">เวลาเริ่มต้น</div>
            </th>
            <th>
              <div align="center">เวลาสิ้นสุด</div>
            </th>
            <th>
              <div align="center">จำนวนคิวที่รับ</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
            <th>
              <div align="center">#</div>
            </th>
          </tr>
        </tfoot> -->
      </table>

      <!-- The Modal -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"><b>เพิ่มวัน-เวลาจองคิว</b></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form method="post" id="user_form">
                <label for="open" style="margin-top:5px;margin-left:60px;">
                  <font style="font-family: ff;"><b>วันจองคิว</b></font>
                </label>
                <center>
                  <input id="open-queue-date" name="open-queue-date" width="345" onchange="SetDateOpenFormat()" required />
                  <script>
                    $('#open-queue-date').datepicker({
                      uiLibrary: 'bootstrap4'
                    });
                  </script>
                </center>
                <label for="open" style="margin-top:15px;margin-left:60px;">
                  <font style="font-family: ff;"><b>เวลาเริ่มต้น</b></font>
                </label>
                <center>
                  <input id="start_time" name="start_time" width="345" />
                  <script>
                    $('#start_time').timepicker({
                      uiLibrary: 'bootstrap4',
                      use24hours: true
                    });
                  </script>
                </center>
                <label for="open" style="margin-top:15px;margin-left:60px;">
                  <font style="font-family: ff;"><b>เวลาสิ้นสุด</b></font>
                </label>
                <center>
                  <input id="end_time" name="end_time" width="345" />
                  <script>
                    $('#end_time').timepicker({
                      uiLibrary: 'bootstrap4',
                      use24hours: true
                    });
                  </script>
                </center>
                <label for="name" style="margin-top:15px;margin-left:60px;">
                  <font style="font-family: ff;"><b>จำนวนคิวที่รับ</b></font>
                </label>
                <div class="form-group row">
                  <div class="col-md-9">
                    <input id="count" name="count" width="200" class="form-control" style="margin-left:60px;" required />
                  </div>
                </div>
                <center>
                  <input type="submit" name="insert" id="insert" class="btn btn-success" value="บันทึก" style="margin-bottom:15px;margin-top:15px;width:90px;" />
                </center>
                <input id="open-date" name="open-date" style="display:none;"></input>
              </form>
            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" >Close</button>
            </div> -->

          </div>
        </div>
      </div>
      <div class="modal fade" id="editModal">
        <div class="modal-dialog">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title"><b>แก้ไขวัน-เวลาจองคิว</b></h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
              <form method="post" id="user_form2">
                <label for="open" style="margin-top:5px;margin-left:60px;">
                  <font style="font-family: ff;"><b>วันจองคิว</b></font>
                </label>
                <center>
                  <input id="edit-id" name="edit-id" width="250" class="form-control" style="display:none;" required />
                  <input id="edit-open-queue-date" name="edit-open-queue-date" width="345" onchange="SetDateOpenFormat()" required />
                  <script>
                    $('#edit-open-queue-date').datepicker({
                      uiLibrary: 'bootstrap4'
                    });
                  </script>
                </center>
                <label for="open" style="margin-top:15px;margin-left:60px;">
                  <font style="font-family: ff;"><b>เวลาเริ่มต้น</b></font>
                </label>
                <center>
                  <input id="edit-start_time" name="edit-start_time" width="345" />
                  <script>
                    $('#edit-start_time').timepicker({
                      uiLibrary: 'bootstrap4',
                      use24hours: true
                    });
                  </script>
                </center>
                <label for="open" style="margin-top:15px;margin-left:60px;">
                  <font style="font-family: ff;"><b>เวลาสิ้นสุด</b></font>
                </label>
                <center>
                  <input id="edit-end_time" name="edit-end_time" width="345" />
                  <script>
                    $('#edit-end_time').timepicker({
                      uiLibrary: 'bootstrap4',
                      use24hours: true
                    });
                  </script>
                </center>
                <label for="name" style="margin-top:15px;margin-left:60px;">
                  <font style="font-family: ff;"><b>จำนวนคิวที่รับ</b></font>
                </label>
                <div class="form-group row">
                  <div class="col-md-9">
                    <input id="edit-count" name="edit-count" width="200" class="form-control" style="margin-left:60px;" required />
                  </div>
                </div>
                <center>
                  <input type="submit" name="insert" id="insert" class="btn btn-success" value="บันทึก" style="margin-bottom:15px;margin-top:15px;width:90px;" />
                </center>
                <input id="edit-open-date" name="edit-open-date" style="display:none;"></input>
              </form>
            </div>

            <!-- Modal footer -->
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-danger" >Close</button>
            </div> -->

          </div>
        </div>
      </div>

    </div>


  </div>

  <!-- W3.CSS Container -->

  <script>
    // Script to open and close sidebar
    function edit(define_booking_id) {
      $.ajax({
        url: "fetchbooking.php?define_booking_id=" + define_booking_id,
        method: "GET",
        data: {
          define_booking_id: define_booking_id
        },
        dataType: "json",
        success: function(data) {
          var opendate = data.define_booking_date_start.split('-')
          $('#edit-id').val(data.define_booking_id);
          $('#edit-start_time').val(data.define_booking_time_start);
          $('#edit-end_time').val(data.define_booking_time_end);
          $('#edit-count').val(data.maximum_queue);
          $('#edit-open-queue-date').val(opendate[1] + '/' + opendate[2] + '/' + opendate[0]);
          $('#edit-open-date').val(data.define_booking_date_start);
          $('#editModal').modal('show');
        },
        error: function() {
          swal({
            title: "ไม่สำเร็จ!",
            text: "เกิดข้อผิดพลาดขณะทำการลบข้อมูล",
            icon: "error"
          });
        }
      })
    }

    function del(define_booking_id) {
      swal({
          title: "ต้องการลบข้อมูลนี้ใช่หรือไม่ ?",
          text: "หากทำการลบข้อมูลแล้ว จะไม่สามารถเรียกคืนข้อมูลได้อีกครั้ง",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              url: "deletebooking.php?define_booking_id=" + define_booking_id,
              method: "GET",
              success: function() {
                location.reload();
              },
              error: function() {
                swal({
                  title: "ลบข้อมูลไม่สำเร็จ!",
                  text: "เกิดข้อผิดพลาดขณะทำการลบข้อมูล",
                  icon: "error"
                });
              }
            })
          }
        });
    }

    function SetDateOpenFormat() {
      var open_date = $('#open-queue-date').val().split('/');
      $("#open-date").val(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
      $("#open-date").html(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
    }
    function SetDateOpenFormat() {
      var open_date = $('#edit-open-queue-date').val().split('/');
      $("#edit-open-date").val(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
      $("#edit-open-date").html(open_date[2] + "-" + open_date[0] + "-" + open_date[1]);
    }
    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
      document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
      document.getElementById("myOverlay").style.display = "none";
    }
    $(document).ready(function() {
      $('#example').DataTable();
    });

    $(document).ready(function() {
      $('#user_form').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        swal({
            title: "ต้องการบันทึกข้อมูลนี้ใช่หรือไม่ ?",
            text: "กรุณากดปุ่ม OK เพื่อทำการบันทึกข้อมูล",
            icon: "info",
            buttons: true,
          })
          .then((willSave) => {
            if (willSave) {
              $.ajax({
                url: "insertbooking.php",
                method: "POST",
                data: form_data,
                success: function() {
                  location.reload();
                },
                error: function() {
                  swal({
                    title: "บันทึกไม่สำเร็จ!",
                    text: "ข้อมูลผิดพลาดกรุณาตรวจสอบข้อมูลอีกครั้ง",
                    icon: "error"
                  });
                }
              })
            }
          });
      });
    });
    $(document).ready(function() {
      $('#user_form2').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        swal({
            title: "ต้องการบันทึกข้อมูลนี้ใช่หรือไม่ ?",
            text: "กรุณากดปุ่ม OK เพื่อทำการบันทึกข้อมูล",
            icon: "info",
            buttons: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: "editbooking.php",
                method: "POST",
                data: form_data,
                success: function() {
                  location.reload()
                },
                error: function() {
                  swal({
                    title: "บันทึกไม่สำเร็จ!",
                    text: "ข้อมูลผิดพลาดกรุณาตรวจสอบข้อมูลอีกครั้ง",
                    icon: "error"
                  });
                }
              })
            }
          });
      });
    });
  </script>

</body>

</html>