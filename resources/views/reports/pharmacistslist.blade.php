@extends('reports/layout.app')
@section('title', 'Edurxcare - Pharmacists List')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
      <div class="container-fluid">
            <!-- Header Starts -->
            <div class="row">
               <div class="col-sm-12 p-0">
                  <div class="main-header">
                     <h4>Pharmacists</h4>
                  </div>
               </div>
            </div>
            <!-- Header end -->
            <!-- Tables start -->
            <!-- Row start -->
            <div class="row">
               <div class="col-sm-12">
                  <!-- Basic Table starts -->
                  <div class="card">
                     <div class="card-block">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table class="list_table">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Pharmacist Name</th>
                                       <th>Mobile</th>
                                       <th>Email</th>
                                       <th>License Number</th>
                                       <th>Pharma Council</th>
                                       <th>Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $key=1;
                                    ?>
                                    @foreach($users_count as $category)
                                       <tr>
                                          <td>{{ $key }}</td>
                                          <td>{{ $category->name }}</td>
                                          <td>{{ $category->mobile }}</td>
                                          <td>{{ $category->email }}</td>
                                          <td>{{ $category->license_number!=''?$category->license_number:'--' }}</td>
                                          <td>{{ $category->pharma_council_name!=''?$category->pharma_council_name:'--' }}</td>
                                          <td>{{ ucwords(strtolower($category->status)) }}</td>
                                          @if($category->status=='pending')
                                             <td> 
                                                <a href="javascript:void(0)" onclick="update_status('{{$category->user_id}}','approved')">
                                                   <button class="btn btn-success">Approve</button>
                                                </a>
                                                &nbsp;
                                                <a href="javascript:void(0)" onclick="update_status('{{$category->user_id}}','rejected')">
                                                   <button class="btn btn-danger">Reject</button>
                                                </a>
                                             </td>
                                          @elseif($category->status=='rejected')
                                             <td> 
                                                <a href="javascript:void(0)" onclick="update_status('{{$category->user_id}}','approved')">
                                                   <button class="btn btn-success">Activate</button>
                                                </a>
                                             </td>
                                          @else
                                             <td> 
                                                <a href="javascript:void(0)" onclick="update_status('{{$category->user_id}}','approved')">
                                                   <button class="btn btn-danger">Inactivate</button>
                                                </a>
                                             </td>
                                          @endif
                                       </tr>
                                       <?php $key++; ?>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Row end -->
            <!-- Tables end -->
         </div>

         <!-- Container-fluid ends -->
      </div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script type="text/javascript">
$('.list_table').DataTable({
      dom: 'lBfrtip',
      buttons: [
         {
               extend: 'excelHtml5',
               exportOptions: {
                  columns: ':visible'
               }
         },
         {
               extend: 'pdfHtml5',
               exportOptions: {
                  columns: [ 0, 1, 2, 5 ]
               }
         }
      ],
      oLanguage: {sLengthMenu: "Show Entries: <select>"+
            "<option value='10' selected='selected'>10</option>"+
            "<option value='25'>25</option>"+
            "<option value='50'>50</option>"+
            "<option value='100'>100</option>"+
            "</select>&nbsp;&nbsp;"},
            "iDisplayLength": 10,
   });

   function update_status(user_id,status){
      if(status=='approved'){
         var message = 'Are you sure you want to Approve this Pharmacist?';
         var alert_msg = "Pharmacist approved successfully";
      } else if(status=='rejected'){
         var message = 'Are you sure you want to Reject this Pharmacist?';
         var alert_msg = "Pharmacist rejected successfully";
      } else {
         var message = 'Are you sure you want to Inactivate this Pharmacist?';
         var alert_msg = "Pharmacist Inactivated successfully";
      }
      var post_url = "{{URL::to('/updateUserStatus')}}?user_id="+user_id+"&status="+status;
      if (confirm(message)) {
         $.ajax({
            url : post_url,
            success : function(result){	
               alert(alert_msg);
               location.reload();
            }
         });
      } else {
         return false;
      }
   }
</script>
@endsection