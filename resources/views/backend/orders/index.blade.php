{{-- @extends('backendtemplate')

@section('content')
<div class="container-fluid mt-4">

  <h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-list-alt pr-3"></i> 
    Orders List
  </h1>

  <div class=" mb-4">
    <div class="card-header py-3">
      <div class="row">
        <div class="col-10">
          <h4 class="m-0 font-weight-bold text-primary"> 

          </h4>
        </div>

        
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class=" text-center table table-bordered table-striped " id="dataTable" width="100%" cellspacing="0">
          <thead class="table-dark">
            <tr>
              <th width="200px">No</th>
              <th>User Name</th>
              <th>Voucher No</th>
              <th>Total</th>
              <th width="200px">Action</th>

            </tr>
          </thead>
          <tbody class="">
            @php $i=1; @endphp
            @foreach($orders as $row)
            <tr>
              <td>{{($i++)}}</td>
              <td>{{($row->user->name)}}</td>
              <td>{{$row->voucherno}}</td>
              <td>{{$row->total}}</td>
              <td>
                
                  <a href="{{route('orders.show',$row->id)}}" class="btn btn-success">
                    <i class="fas fa-info"></i>
                  </a>

                  
                  
              </td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>
</div>
@endsection

 --}}

 @extends('backendtemplate')
@section('content')
<div class="container-fluid">
  
  <!-- Page Heading -->
    <div class="row">
     <div class="col-md-12 mb-3">
        <h1 class="h3 mb-0 text-gray-800 d-inline-block">Order List</h1>

        <form method="get" action="{{route('orders.index')}}" class="mt-2">
          <div class="form-row">
            <div class="col">
              <input type="date" class="form-control" placeholder="Start Date" name="sdate">
            </div>
            <div class="col">
              <input type="date" class="form-control" placeholder="End Date" name="edate">
            </div>
            <div class="col">
              <input type="submit" class="btn btn-success" value="Search">
            </div>
          </div>
        </form>
      </div>
    </div>
  
  
  
  
    <div class="row">
      <div class="col-md-12 ">

          
          <table class="table table-bordered ">
            <thead class="table-dark">
              <tr>
                <th scope="col">No</th>
                
                <th scope="col">Voucher No</th>
                
                <th scope="col">User</th>
                <th scope="col">Total</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              @php 
              $i=1;
              @endphp
              @foreach ($orders as $order)
              <tr>
                <td>{{$i++}}</td>
                <td>{{$order->voucherno}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{$order->total}} MMK</td>
                <td><a href="{{route('orders.show',$order->id)}}" class="btn btn-info">Detail</a>
                
                
              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        
      </div>
    </div>


</div>
@endsection