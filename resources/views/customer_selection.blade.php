<!DOCTYPE html>
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
    <div class="card-header">
        <h3 class="card-title">Order details</h3>
    </div>
    <div class="form-group">
        <table id="items" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Customer Name</th>
                <th>Customer phone</th>
                <th>Customer address</th>
                <th>Order No</th>
                <th>Item_name</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach($customer_detail as $cs)
                <tr>
                    <td>{{$cs->c_name}}</td>
                    <td>{{$cs->c_phone}}</td>
                    <td>{{$cs->c_address}}</td>
                    @foreach($all_order as $order)
                        <td>{{$order->order_id}}</td>
                        <td>{{\Illuminate\Support\Facades\DB::table('items')->where('id',$order->item_id)->value('name')}}</td>
                        <td>{{\Illuminate\Support\Facades\DB::table('items')->where('id',$order->item_id)->value('selling_price')}}</td>
                        <td>{{$status[$order->status]}}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
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

