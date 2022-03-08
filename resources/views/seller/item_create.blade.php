@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Kitchen Panel</h1>
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
            <h3 class="card-title">Insert a new item</h3>
            <a href="/item" class="btn btn-default" style="float:right">Back</a>
        </div>

        <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
              </div>
            @endif
         <form action="/item" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="form-group">
                 <label for="">Name</label>
                 <input type="text" class="form-control" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
                 <label for="">Quantity</label>
                 <input type="text" class="form-control" name="quantity" value="{{old('quantity')}}">
            </div>
            <div class="form-group">
                 <label for="">Original_price</label>
                 <input type="text" class="form-control" name="original_price" value="{{old('original_price')}}">
            </div>
            <div class="form-group">
                 <label for="">Selling_price</label>
                 <input type="text" class="form-control" name="selling_price" value="{{old('selling_price')}}">
            </div>

            <div class="form-group">
                 <label for="">Category</label>
                 <select name="category" class="form-control">
                 <option value="">Select Category</option>
                 @foreach($categories as $cat)
                    <option value="{{$cat->id}}"> {{ $cat->name }}</option>
                 @endforeach
                 </select>
            </div>


            <div class="form-group">
                 <label for="">Image</label><br>
                 <input type="file"  name="item_image" >
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
      </div>
      </div>


          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script>
$(function () {
    $("#dishes").DataTable({
      "paging": true,
      "pageLength": 2,
      "lengthChange": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
     // "responsive": true,
    });
});
</script>

