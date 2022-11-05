@extends('reports/layout.app')
@section('title', 'Edurxcare - Dashboard')
@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="main-header">
         <h4>Dashboard</h4>
      </div>
   </div>
   <!-- 4-blocks row start -->
   <div class="row dashboard-header">
      <div class="col-lg-4 col-md-6">
         <a href="{{ URL::to('/typeslist') }}">
            <div class="card dashboard-product">
               <span>Patients</span>
               <h2 class="dashboard-total-products">{{ $users_count[0]->patient_count }}</h2>
               <div class="side-box">
                  <i class="ti-signal text-warning-color"></i>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-4 col-md-6">
         <a href="{{ URL::to('/categoriesList') }}">
            <div class="card dashboard-product">
               <span>Pharmacists</span>
               <h2 class="dashboard-total-products">{{ $users_count[0]->pharmacist_count }}</h2>
               <div class="side-box ">
                  <i class="ti-gift text-primary-color"></i>
               </div>
            </div>
         </a>
      </div>
      <div class="col-lg-4 col-md-6">
         <a href="{{ URL::to('/servicesList') }}">
            <div class="card dashboard-product">
               <span>Requests </span>
               <h2 class="dashboard-total-products"><span>65</span></h2>
               <div class="side-box">
                  <i class="ti-direction-alt text-success-color"></i>
               </div>
            </div>
         </a>
      </div>
   </div>            

   <!-- 1-3-block row start -->
   <div class="row">
   <div class="col-lg-6">
         <div class="card">
            <div id="requests_chart"></div>
         </div>
      </div>
      <div class="col-lg-6">
         <div class="card">
            <div id="users_chart"></div>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/highcharts/highcharts.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/highcharts/data.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/highcharts/drilldown.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/highcharts/exporting.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/highcharts/export-data.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('public/assets/js/highcharts/accessibility.js') }}"></script>
<script type="text/javascript">

</script>
@endsection