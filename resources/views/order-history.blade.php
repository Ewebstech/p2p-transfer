@extends('layout.app')

@section('title', 'Transaction History')

@push('styles')

<link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />

<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.bootstrap.min.css" />

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endpush

@include('includes.breadcrumb')
<div class="w3layouts-breadcrumbs text-center">
    <div class="container">
        <span class="agile-breadcrumbs"><a href="/dashboard"><i class="fa fa-home home_1"></i> Dashboard</a> / <span>Purchase History</span></span>
    </div>
</div>

@section('content')


<div id="content" style="margin-top: 30px; margin-bottom: 30px;">
  <div class="container">
    <div class="row">
    
      <div class="col-lg-12">
        <div class="bg-light shadow-md rounded p-4" style="padding: 30px !important;"> 
          <!-- Orders History
          ============================================= -->
          <h4 class="mb-3">Purchase History</h4>
          
          <div class="row">
            <div class="tab-content col-md-8 col-sm-12" style="float: left; margin-top: 20px; margin-bottom: 20px;">
                
              <form action="/history" method="post">
                {{csrf_field()}}
                <div class="col-md-6">
                  <label>Search Date Range</label>
                  <input type="text" name="daterange" class="form-control" />
                </div>
                <div>
                  <input type="submit" class="btn btn-primary" name="search" value="Search" style="margin-top: 25px;"/>
                </div>
              </form>

            </div>
          </div>
 
          <br clear="all">
          <div class="tab-content my-3" id="myTabContent">
            <div class="" id="first" >
              <div class="table-responsive-md">
                <table id="example" class="table table-hover table-responsive" style="width:100%;">
                  <thead class="thead-light">
                    <tr>
                      <th style="text-align: left !important;">Wallet ID</th>
                      <th style="text-align: left !important;">Service</th>
                      <th style="text-align: left !important;">Amount</th>
                      <th style="text-align: left !important;">Status</th>
                      <th style="text-align: left !important;">Transaction ID</th>
                      <th style="text-align: left !important;">Process Fee</th>
                      <th style="text-align: left !important;">Date</th>                      
                    </tr>
                  </thead>
                  <tbody>

                    @foreach ($transactions as $transaction)
                    <tr>
                      <td style="text-align: left !important;">{{ strtoupper($sessiondata['walletID']) }} </td>
                      <td style="text-align: left !important;">{{ strtoupper($transaction['service']) }} </td>
                      <td style="text-align: left !important;">	&#8358; {{ $transaction['amount'] }}</td>
                      <td style="text-align: left !important;">{{ strtoupper($transaction['status']) }}</td>
                      <td style="text-align: left !important;">{{ $transaction['reference'] }} </td>
                      <td style="text-align: left !important;">&#8358; {{ $transaction['fee'] ?? 0 }} </td>
                      <td style="text-align: left !important;">{{ $transaction['created_at'] }}</td>                     
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
              
            </div>
            
            
          </div>
          <!-- Orders History end --> 
        </div>
      </div>
    </div>
  </div>
  <!-- Content end --> 
  

  
</div>


@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
  $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
</script>

<script>
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    });
  });
  </script>

@endpush