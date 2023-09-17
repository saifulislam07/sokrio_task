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
                    <h3 class="card-title">Add Stock</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('saveStock') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="form-control" name="department_id" required>
                                        <option value="" selected disabled> Select</option>
                                        @foreach ($department as $each)
                                            <option value="{{ $each->id }}">
                                                {{ $each->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Challan No</label>
                                    <input type="text" name="challan_no" class="form-control"
                                        placeholder="challan no ..">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-row col-md-12">


                                {{-- html load by js --}}


                                <table class="table table-bordered table-hover " id="show_item">
                                    <thead>
                                        <tr>
                                            <th colspan="8">Select Product Item</th>
                                        </tr>
                                        <tr>

                                            <td class="text-center"><strong>Product</strong></td>
                                            <td class="text-center"><strong>SKU</strong></td>
                                            <td class="text-center"><strong>QTY</strong></td>
                                            <td class="text-center"><strong>Action</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                <select class="form-control proName reset" id="productID"
                                                    data-placeholder="Search Product" onchange="getSKU(this.value)">
                                                    <option disabled selected>---Select Product---</option>
                                                    @foreach ($products as $each)
                                                        <option proName="{{ $each->name }}" value="{{ $each->id }}">
                                                            {{ $each->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" readonly step="any" id="skucode"
                                                    class="form-control text-right skucode reset_skucode"
                                                    placeholder="sku code">
                                            </td>
                                            <td>
                                                <input type="number" step="any"
                                                    class="form-control text-right qty reset_qty" id="qty"
                                                    placeholder="Quantity">
                                            </td>
                                            <td>
                                                <a id="add_item" class="btn btn-info" style="white-space: nowrap"
                                                    href="javascript:;" title="Add Item">
                                                    <i class="fa fa-plus"></i>
                                                    Add Item
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>

                                </table>
                            </div>

                        </div>




                        <button class="btn btn-primary">ADD STOCK</button>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function getSKU(productId) {

            if (productId == '' || productId == null || productId == 0) {
                return false;
            }

            $.ajax({
                "url": "{{ route('skucode') }}",
                "type": "GET",
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    productId: productId
                },
                success: function(data) {

                    $("#skucode").val(data);
                }
            });
        };
    </script>

    <script type="text/javascript">
        $(document).on('click', '#add_item', function() {


            var parent = $(this).parents('tr');

            var skucode = $('.skucode').val();
            var qty = $('.qty').val();


            var proId = $('.proName').val();
            var proName = $(".proName").find('option:selected').attr('proName');

            // var qty = number_format(parent.find('.qty').val());


            console.log(proName);




            if (proId == '' || proId == null) {
                alertMessage.error("Product can't be empty.");
                return false;
            }

            // start check duplicate product
            let seaschproduct = $('#productID option:selected')[0].getAttribute("value");
            let tbody = $('tbody').find(".new_item" + seaschproduct).length;

            if (tbody > 0) {
                alertMessage.error('This product already exist');
                return;
            }
            // end check duplicate product

            if (qty == '' || qty == null || qty == 0) {
                alertMessage.error('Quantity cannot be empty');
                return false;
            } else {


                const row = `
                    <tr class="new_item${proId}">

                        <td class="text-right">${proName}<input type="hidden" class=" " product-id="${proId}" name="proName[]" value="${proId}"></td>

                        <td class="text-right">${skucode}<input type="hidden" class="ttlqty" name="skucode[]" value="${skucode}"></td>
                        <td class="text-right">${qty}<input type="hidden" class="ttlqty" name="qty[]" value="${qty}"></td>


                        <td>
                            <a del_id="${proId}" class="delete_item btn form-control btn-danger" href="javascript:;" title="">
                                <i class="fa fa-times"></i>&nbsp;Remove
                            </a>
                        </td>
                    </tr>
                `;
                $("#show_item tbody").append(row);
            }

            $('.reset_skucode').val('');
            $('.reset_qty').val('');
            $(".reset").val(null).trigger("change");
        });




        $(document).on('click', '.delete_item', function() {

            let deleteitem = () => {
                $(this).parents('tr').remove();
            }
            //  toastr.error('{{ Session::get('error', 'Item removed!!') }}');
            alertMessage.confirm('You want to remove this', deleteitem);

        });
    </script>

@endsection
