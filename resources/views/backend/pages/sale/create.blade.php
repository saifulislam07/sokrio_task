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
                    <h3 class="card-title">New Sale</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('saveSale') }}" method="post">
                        @csrf


                        <div class="row">
                            <div class="form-row col-md-12">

                                <table class="table table-bordered table-hover " id="show_item">
                                    <thead>
                                        <tr class="text-center">
                                            <th colspan="8">Sale Generate</th>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><strong>Product</strong></td>
                                            <td class="text-center"><strong>Quantity</strong></td>
                                            <td class="text-center"><strong>Unit</strong></td>
                                            <td class="text-center"><strong>Sales Price</strong></td>
                                            <td class="text-center"><strong>Payable</strong></td>
                                            <td class="text-center"><strong>Action</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                <select class="form-control proName reset" id="productID"
                                                    data-placeholder="Search Product">
                                                    <option disabled selected>-Select Product-</option>
                                                    @foreach ($products as $each)
                                                        <option proName="{{ $each->name }}" value="{{ $each->id }}">
                                                            {{ $each->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>


                                            <td>
                                                <input type="number" step="any"
                                                    class="form-control text-right qty reset_qty" id="qty"
                                                    placeholder="Quantity">
                                            </td>
                                            <td>
                                                <select class="form-control uniName uniid reset" id="unitID"
                                                    data-placeholder="Search Product">
                                                    <option disabled selected>-Select Unit-</option>
                                                    @foreach ($unit as $eachu)
                                                        <option uniName="{{ $eachu->name }}" value="{{ $eachu->id }}">
                                                            {{ $eachu->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" step="any" min="0" id="unitprice"
                                                    class="form-control text-right unitprice reset_unitprice"
                                                    placeholder="Sales Price">
                                            </td>
                                            <td>
                                                <input type="number" step="any" readonly
                                                    class="form-control text-right total reset_total" id="total"
                                                    placeholder="Total">
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
                            <div class="form-row col-md-12">

                                <table class="table table-bordered table-hover" id="cart_output">
                                    <tr>
                                        <th class="text-right"><span>Grand Total</span></th>
                                        <th width="300px" class="text-right"><span class="grandtotal"></span>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="text-right"><span>Pay (-) </span></th>
                                        <th class="text-right">
                                            <input type="number" step="any"
                                                class="form-control  paid_amount input-checker" name="paid_amount"
                                                placeholder="Ex:5">
                                            <div class="payment_amount_error"></div>
                                            @error('paid_amount')
                                                <span class=" error text-red text-bold">{{ $message }}</span>
                                            @enderror
                                        </th>

                                    </tr>
                                    <tr id="duevalid">
                                        <th class="text-right"><span> Due</span></th>
                                        <th class="text-right"><span class="cart_due"></span>
                                        </th>

                                    </tr>
                                </table>
                                <!-- /.card -->
                            </div>
                            <div class="form-row col-md-12">
                                <table class="table table-bordered table-hover" id="cart_output" witdth="100%">

                                    <tr>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <textarea cols="110" rows="3" class="form-control" name="narration" placeholder="Remarks" type="text"></textarea>
                                            </div>
                                        </div>
                                    </tr>
                                </table>
                                <!-- /.card -->
                            </div>
                        </div>

                        <button class="btn btn-primary float-right">SALE CREATE</button>
                    </form>

                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript">
        $(document).ready(function() {

            var findqtyamoun = function() {

                var ttlqty = 0;
                $.each($('.ttlqty'), function() {
                    qty = number_format($(this).val());
                    ttlqty += qty;
                });
                $('.ttlqty').text(number_format(ttlqty));

            };



            var findunitamount = function() {
                var ttlunitprice = 0;
                $.each($('.ttlunitprice'), function() {
                    unitprice = number_format($(this).val());
                    ttlunitprice += unitprice;
                });
                $('.ttlunitprice').text(number_format(ttlunitprice));
            };

            var findgrandtottal = function() {
                var grandtotal = 0;

                $.each($('.total'), function(index, item) {
                    total = number_format($(item).val());
                    grandtotal += total;
                });

                // let vatE = $('.vat');

                let paidAmountE = $('.paid_amount');


                let paidAmount = number_format(paidAmountE.val());

                //calculate discount


                let cal_grandtotal = grandTotalCalculate(grandtotal);
                let cal_due = dueCalculate(cal_grandtotal, paidAmount);

                let cart_net_total = $('.cart_net_total');
                let cart_due = $('.cart_due');
                let paid_amount = $('.paid_amount');

                $('.grandtotal').text(number_format(grandtotal));
                cart_net_total.text(cal_grandtotal);
                cart_due.text(cal_due);
                $('.input_net_total').val(cal_grandtotal);
                $('.input_due').val(cal_due);

            };


            $(document).on('click', '#add_item', function() {
                var parent = $(this).parents('tr');
                var uniName = $(".uniName").find('option:selected').attr('uniName');
                var uniId = $('.uniName').val();
                var uniid = $('.uniid').val();
                var proId = $('.proName').val();
                var proName = $(".proName").find('option:selected').attr('proName');
                var qty = number_format(parent.find('.qty').val());
                var unitprice = number_format(parent.find('.unitprice').val());




                if (proId == '' || proId == null) {
                    alertMessage.error("Product can't be empty.");
                    return false;
                }

                // start check duplicate product
                let seaschproduct = $('#productID option:selected')[0].getAttribute("value");
                let tbody = $('tbody').find(".new_item" + seaschproduct).length;
                let tbody2 = $('tbody').find("new_item" + seaschproduct);
                console.log(tbody);

                if (tbody > 0) {
                    alertMessage.error('This product already exist');
                    return;
                }
                // end check duplicate product

                if (qty == '' || qty == null || qty == 0) {
                    alertMessage.error('Quantity cannot be empty');
                    return false;
                } else {
                    var total = qty * unitprice;

                    var grandtotal = 0;

                    $.each($('.checktotal'), function(index, item) {
                        totaltt = number_format($(item).val());
                        grandtotal += totaltt;
                    });

                    let accountAmountCheck = total + grandtotal;

                    const row = `
                    <tr class="new_item${proId}">

                        <td class="text-right">${proName}<input type="hidden" class="add_quantity " product-id="${proId}" name="proName[]" value="${proId}"></td>
                        <td class="text-right">${qty}<input type="hidden" class="ttlqty" name="qty[]" value="${qty}"></td>

                        <td class="text-right">${uniName}<input type="hidden" class="uniName" name="uniName[]" value="${uniName}"></td>
                        <input type="hidden" class="uniName" name="uniid[]" value="${uniid}">

                        <td class="text-right">${unitprice}<input type="hidden" class="ttlunitprice" name="unitprice[]" value="${unitprice}">
                        </td>
                        <td class="text-right">${total}
                            <input type="hidden" class="total checktotal" name="total[]" value="${total}">
                        </td>
                        <td>
                            <a del_id="${proId}" class="delete_item btn form-control btn-danger" href="javascript:;" title="">
                                <i class="fa fa-times"></i>&nbsp;Remove
                            </a>
                        </td>
                    </tr>
                `;
                    $("#show_item tbody").append(row);
                }

                $('.reset_unitprice').val('');
                $('.reset_qty').val('');
                $('.reset_total').val('');
                $(".reset").val(null).trigger("change");

                findqtyamoun();
                findunitamount();
                findgrandtottal();
            });

            $(document).on('click', '.delete_item', function() {

                let deleteitem = () => {
                    $(this).parents('tr').remove();
                    findqtyamoun();
                    findunitamount();
                    findgrandtottal();
                }

                alertMessage.confirm('You want to remove this', deleteitem);

            });





            // Quantity price calculate
            $(document).on('input', '.qty', function() {
                let self = $(this);
                let parent = self.parents('tr');
                let qty = number_format(self.val());

                if (qty == '' || qty == null) {
                    $(this).val(1);
                    qty = 1;
                }

                let unitPrice = number_format(parent.find('.unitprice').val());

                let total = number_format(unitPrice * qty);

                parent.find('.total').val(number_format(total));

            });

            // unit price to Quantity calculate
            $(document).on('input', '.unitprice', function() {

                let self = $(this);
                let parent = self.parents('tr');
                let unitprice = number_format(self.val());

                if (unitprice == '' || unitprice == null) {
                    $(this).val(1);
                    unitprice = 1;
                }

                let qty = number_format(parent.find('.qty').val());

                let total = number_format(unitprice * qty);

                parent.find('.total').val(number_format(total));

            });

            $(document).on('input', '.input-checker', function() {
                var grandtotal = $('.grandtotal').text();
                grandtotal = Number(grandtotal);

                if (isNaN(grandtotal) || grandtotal < 1) {
                    alertMessage.error('Please Add some item first.');
                    return false;
                }
                findgrandtottal();

            });





            $(document).on('keyup', '.paid_amount', function() {
                // alert('hello');

                let paidAmount = number_format($(this).val());
                let balance = number_format($('.balance').val());

            });

        });

        function dueCalculate(amount, paid_amount) {
            return number_format(number_format(amount) - number_format(paid_amount));
        }

        function grandTotalCalculate(total, result = 0) {
            result = total;
            return number_format(result);

        }

        function percentageCalculate(amount) {
            return number_format(amount);
        }

        function number_format(number, decimal = 2) {
            number = Number(number);
            return Number(parseFloat(number).toFixed(decimal));
        }
    </script>

@endsection
