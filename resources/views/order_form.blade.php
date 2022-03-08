<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
      <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body>
<div class="card">

    <div class="card-body">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <h3>Order Form</h3>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">New Order</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Order List</a>
                    </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <form action="{{route('order.submit')}}" method="post">
                            @csrf
                                <div class="row">
                                @foreach($items as $item)
                                    <div class="col-sm-3">
                                        <div class="card">
                                        <div class="card-body">
                                        <img src="{{url('/images/'.$item->image)}}" width=100 height=100><br>
                                        <label for="">{{$item->name}}</label><br>
                                        <div class="form-group">
                                            <label for="" style="color: red; ">In_stock_Quantity</label>
                                            <input type="text" name="In_stock_quantity" value="{{ old('quantity',$item->quantity) }}"  size="5" style="color: red;" readonly="readonly" disabled>
                                        </div>
                                        <label for="">Quantity</label>
                                        <input type="number" name="{{$item->id}}" min="0" max="{{ old('quantity',$item->quantity) }}"><br>
                                        </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="" >Customer Name </label>
                                    <input type="text" class="form-control" name="c_name" >

                                        <label for="" >Customer Phone </label>
                                        <input type="text" class="form-control" name="c_phone" >

                                        <label for="" >Customer Address </label>
                                        <input type="text" class="form-control" name="c_address" >
                                 </div>
                                <input type="submit" class="btn btn-success" value="Submit">

                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
                        </div>
                    </div>
                </div>

                </div>
                </div>
    
            </div>

        </div>
    </div>
    </div>
</div>
    
</div>
</body>
<!-- jQuery -->
<script src="/plugins/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<!-- Bootstrap 4 -->
<script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
</html>