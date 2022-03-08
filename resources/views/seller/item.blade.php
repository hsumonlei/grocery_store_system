@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Seller Panel</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Items</h3>
                <a href="/item/create" class="btn btn-success" style="float:right">Create</a>
              </div>

              <div class="card-body">
              @if (session('message'))
                <div class="alert alert-success">
                  {{ session('message') }}
                </div>
              @endif

              <table id="items" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Item Name</th>
                    <th>Category</br>Name</th>
                    <th>Quantity</th>
                    <th>Orignal_Price</br>[kyat]</th>
                    <th>Selling_Price</br>[Baht]</th>
                    <th>Created</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                  <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->original_price}}</td>
                    <td>{{$item->selling_price}}</td>
                    <td>{{$item->created_at}} </td>
                    <td>
                      <div class="form-row"> 
                      <a style="height: 40px; margin-right: 10px; " href="/item/{{$item->id}}/edit" class="btn btn-warning">Edit</a>
                        <form action="/item/{{$item->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</button>
                          </form>
                      </div>                       
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div> 
            </div>
          </div>

          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script> 
<!-- <script src="/plugins/jquery/jquery.min.js"></script> -->
<script>
  $(function () {
  $("#items").DataTable({
      "paging": true,
      "pageLength" : 10 ,
      "lengthChange": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>


