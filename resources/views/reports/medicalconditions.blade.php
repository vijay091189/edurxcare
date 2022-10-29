@extends('reports/layout.app')
@section('title', 'Edurxcare - Medical Conditions')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<div class="container-fluid">

            <!-- Header Starts -->
            <div class="row">
               <div class="col-sm-12 p-0">
                  <div class="main-header">
                     <h4>Medical Conditions</h4>
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
                     <div class="col-sm-12">
                        <a class="btn btn-primary add_new_btn" onclick="modalpopup();">Add Medical Condition</a>
                     </div>
                     <div class="card-block">
                        <div class="row">
                           <div class="col-sm-12 table-responsive">
                              <table class="list_table">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Medical Condition</th>
                                       <th>Edit</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $key=1;
                                    ?>
                                    @foreach($categories as $category)
                                       <tr>
                                          <td>{{ $key }}</td>
                                          <td>{{ $category->medical_condition }}</td>
                                          <td>
                                             <a href="#!" onclick="edit_category('{{ $category->id }}','{{ $category->medical_condition }}'');">
                                                <i class="icon-pencil"></i>
                                             </a>
                                             &nbsp;&nbsp;<a href="#!" onclick="delete_item('{{ $category->id }}','{{ $category->medical_condition }}');">
                                                <i class="icon-trash"></i>
                                             </a>
                                          </td>
                                          <td>
                                             @if($category->status==1)
                                                <a id="{{ $category->id }}_active" href="javascript:void(0)" onclick="deleteCategory('{{$category->id}}','0')">
                                                   <button class="btn btn-danger">CHANGE TO Inactive</button>
                                                </a>
                                                <a style="display:none;" id="{{ $category->id }}_inactive" href="javascript:void(0)" onclick="deleteCategory('{{$category->id}}','1')">
                                                   <button class="btn btn-success">CHANGE TO Active</button>
                                                </a>
                                             @else
                                                <a style="display:none;" id="{{ $category->id }}_active" href="javascript:void(0)" onclick="deleteCategory('{{$category->id}}','0')">
                                                   <button class="btn btn-danger">CHANGE TO Inactive</button>
                                                </a>
                                                <a id="{{ $category->id }}_inactive" href="javascript:void(0)" onclick="deleteCategory('{{$category->id}}','1')">
                                                   <button class="btn btn-success">CHANGE TO Active</button>
                                                </a>
                                             @endif
                                          </td>
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
<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
   <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Add Medical Condition</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <i aria-hidden="true" class="ki ki-close"></i>
      </button>
   </div>
   <div class="modal-body">
      <form action="#" method="post" name="categoryform" id="categoryform">
         <input type="hidden" value="" name="category_id" id="category_id">
         <div class="form-group row">
            <div class="col-sm-3">
               <label>Category <span class="text-danger">*</span></label>
            </div>
            <div class="col-sm-6">
               <input type="text" name="category_name" id="category_name" class="form-control">   
            </div>
         </div>
         <div class="form-group row">
            <div class="col-sm-3">
               <label>Image <span class="text-danger">*</span></label>
            </div>
            <div class="col-sm-6">
               <input type="file" name="image" id="image" class="form-control">   
            </div>
         </div>
         <div class="form-group row">
            <div class="col-sm-12" style="float: left; width: 100%; text-align: center" >
               <button type="button" class="btn btn-primary" id="saveMeds" onclick="savecategory();">Submit</button>
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
         </div>
         
      </form>
   </div>
   
</div>
</div>
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
function modalpopup(){ 
   $('#category_id').val('');
   $('#category_name').val('');
   $('#type_id').val('');
   $('#exampleModalLabel').html('Add Category');
   $('#exampleModalSizeLg').modal();
}
function edit_category(category_id,category_name,type_id){
   $('#category_id').val(category_id);
   $('#category_name').val(category_name);
   $('#type_id').val(type_id);
   $('#exampleModalLabel').html('Edit Category');
   $('#exampleModalSizeLg').modal();
}
function savecategory(){
   var formData = new FormData();
   formData = new FormData($('#categoryform')[0]);
   formData.append( "_token", '{{csrf_token()}}' ); 
   var post_url = "{{URL::to('/saveCategory')}}";
   var category_name = $('#category_name').val();
   var type_id = $('#type_id').val();
   var category_id = $('#category_id').val();
   var image = $('#image').val();
   if(category_name==''){
      alert("Please enter category");
      return false;
   }
   if(type_id==''){
      alert("Please select type");
      return false;
   }
   if(category_id==''){
      if(image==''){
         alert("Please upload category image");
         return false;
      }
   }
   $.ajax({
      type : "POST",
      url : post_url,
      data : formData,
      contentType: false,
      processData: false,
      success : function(result){
         if(result=='exist'){
            alert("Record already exists with the category name '"+category_name+"'");
            return false;
         }	
         if(category_id==''){
            alert("Category saved successfully");
         } else {
            alert("Category updated successfully");
         }
         location.reload();
      }
   });
}

function deleteCategory(category_id,status,unique_id, name){
   var post_url = "{{URL::to('/deleteCategory')}}?category_id="+category_id+"&status="+status;
   // if (confirm('Are you sure you want to delete this category?')) {
   //    $.ajax({
   //       url : post_url,
   //       success : function(result){	
   //          alert("Category deleted successfully");
   //          location.reload();
   //       }
   //    });
   // } else {
   //    return false;
   // }

   if(status=='0'){
      var message = 'Are you sure you want to make the category "'+name+'" Inactive?';
      var status_text = 'Inactive';
   } else {
      var message = 'Are you sure you want to make the category "'+name+'" Active?';
      var status_text = 'Active';
   }
   if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Category made "+status_text+" successfully");
            //location.reload();
            if(status=='0'){
               $('#'+unique_id+'_active').hide();
               $('#'+unique_id+'_inactive').show();
            } else {
               $('#'+unique_id+'_active').show();
               $('#'+unique_id+'_inactive').hide();
            }
         }
      });
   } else {
      return false;
   }
}
function delete_item(id,name){
   var post_url = "{{URL::to('/delete_item')}}?id="+id+"&table=categories&primary_key=category_id";
   var message = 'Are you sure you want to delete the category "'+name+'"?';
   if (confirm(message)) {
      $.ajax({
         url : post_url,
         success : function(result){	
            alert("Category deleted successfully");
            location.reload();
         }
      });
   } else {
      return false;
   }
}
</script>
@endsection