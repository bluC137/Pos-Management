@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">
                        <h4 style="float: left"> Suppliers </h4>
                        <a href="http://"  style="float:right; background-color: white; color:black; outline-color: #66fcf1; outline-width: 100px" class="btn btn-info" data-toggle="modal" data-target="#addSupplier">
                            <i class="fa fa-plus"></i> Add New Suppliers</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Brand</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $key => $supplier)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $supplier->supplier_name }}</td>
                                    <td>{{ $supplier->address }}</td>
                                    <td>{{ $supplier->phone }}</td>
                                    <td>{{ $supplier->email }}</td>
                                    <td>{{ $supplier->brand }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editSupplier{{ $supplier->id }}"> <i class=" fa fa-edit">
                                                </i> Edit</a>
                                            <a href="" data-toggle="modal" data-target="#deleteSupplier{{ $supplier->id }}" class="btn btn-sm btn-danger"><i class=" fa fa-trash">
                                                </i> Delete</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal section Editing supplier details -->
                                <!-- Modal -->
                                <div class="modal right fade" id="editSupplier{{ $supplier->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit Supplier</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('suppliers.update', $supplier->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" name="supplier_name" id="" value="{{ $supplier->supplier_name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <input type="address" name="address" id="" value="{{ $supplier->address }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <input type="text" name="phone" id="" value="{{ $supplier->phone }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" id="" value="{{ $supplier->email }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Brand</label>
                                                        <input type="text" name="brand" id="" value="{{ $supplier->brand }}" class="form-control">
                                                    </div>
                                                    
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info btn-block">Update Supplier</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal section Deleting supplier -->
                                <!-- Modal -->
                                <div class="modal right fade" id="deleteSupplier{{ $supplier->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete Supplier</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete {{ $supplier->supplier_name }} ?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                                {{ $suppliers->links() }}
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal section adding new supplier -->
<!-- Modal -->
<div class="modal right fade" id="addSupplier" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                <h4 class="modal-title" id="staticBackdropLabel">Add Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('suppliers.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="supplier_name" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="address" name="address" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brand" id="" class="form-control">
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-info btn-block">Save Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<style>
    
</style>


@endsection