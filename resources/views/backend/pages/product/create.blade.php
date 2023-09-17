@extends('backend.layouts.master')

@section('title')
    Dashboard Page - Admin Panel
@endsection


@section('navbar-content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Dashboard</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('admin-content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Base Product</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('saveProduct') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" required class="form-control"
                                        placeholder="Enter Product Name ...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" name="SKU" required class="form-control"
                                        placeholder="e.g. iPhone 14 pro max">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Product Brand</label>
                                    <select class="form-control" name="brand_id" required>
                                        <option value="" selected disabled> Select</option>
                                        @foreach ($brand as $each)
                                            <option value="{{ $each->id }}">{{ $each->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Product Category</label>
                                    <select class="form-control" name="category_id" required>
                                        <option value="" selected disabled> Select</option>
                                        @foreach ($category as $eachc)
                                            <option value="{{ $eachc->id }}">{{ $eachc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>Description (Optional)</label>
                                    <textarea class="form-control" name="description" rows="3" placeholder="Enter product description ..."></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- textarea -->
                                <div class="form-group">
                                    <label>USP (optional)</label>
                                    <textarea class="form-control" rows="3" name="USP" placeholder="Enter Product USP..."></textarea>
                                </div>
                            </div>

                        </div>




                        <button class="btn btn-primary">SAVE PRODUCT</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
