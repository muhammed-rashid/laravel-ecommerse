@extends('layouts.admin_layout')
@section('content')


  
<div class="container-fluid">
  <div class="row " style="padding-top: 70px">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3 class="clr">{{$total_order}}</h3>

          <p class="clr">All Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
       
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3 class="clr">{{$new_order}}</h3>

          <p class="clr">New Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
   
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3 class="clr">{{$total_users}}</h3>

          <p class="clr">User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-white">
        <div class="inner">
          <h3 class="clr">{{$cancelled}}</h3>

          <p class="clr">Cancelled Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
     
      </div>
    </div>
    <!-- ./col -->
  </div>
</div>

    <div class="container-fluid ">
      <div class="row">
        
        <div class="col-md-12 mt-5">
         
          <div class="card card-info">
            
            {{-- <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div> --}}
            
          </div>
      
        </div>
       
      </div>
     
    </div>




@endsection
@section('scripts')
    
<script>

$(function () {


  // Get context with jQuery - using jQuery's .get() method.
  var areaChartCanvas = $('#lineChart').get(0).getContext('2d')

  var areaChartData = {
    labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90]
      },
      {
        label               : 'Electronics',
        backgroundColor     : 'rgba(210, 214, 222, 1)',
        borderColor         : 'rgba(210, 214, 222, 1)',
        pointRadius         : false,
        pointColor          : 'rgba(210, 214, 222, 1)',
        pointStrokeColor    : '#c1c7d1',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data                : [65, 59, 80, 81, 56, 55, 40]
      },
    ]
  }

  var areaChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var areaChart       = new Chart(areaChartCanvas, { 
    type: 'line',
    data: areaChartData, 
    options: areaChartOptions
  })

  //-------------
  //- LINE CHART -
  //--------------
  var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
  var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
  var lineChartData = jQuery.extend(true, {}, areaChartData)
  lineChartData.datasets[0].fill = false;
  lineChartData.datasets[1].fill = false;
  lineChartOptions.datasetFill = false

  var lineChart = new Chart(lineChartCanvas, { 
    type: 'line',
    data: lineChartData, 
    options: lineChartOptions
  })

  
  
 
})
</script>
@endsection