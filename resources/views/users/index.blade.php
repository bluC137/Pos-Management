@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background: #1f2833; color: #edf6ff">
                        <h4 style="float: left"> Users</h4>
                        <a href="http://" style="float:right; background-color: white; color:black; outline-color: #66fcf1; outline-width: 100px" class="btn btn-info" data-toggle="modal" data-target="#addUser">
                            <i class="fa fa-plus"></i> Add New Users</a>
                        
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-left">
                            <thead>
                                
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <!-- <th>Phone</th> -->
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td hidden="true">{{ $key+1 }}</td>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>@if ( $user->is_admin == 1)
                                        Admin
                                        @elseif ( $user->is_admin == 0)
                                        Super Admin
                                        @else
                                        Cashier
                                        @endif</td>
                                    <td>
                                        <div class="btn-group">
                                         
                                            <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editUser{{ $user->id }}"> <i class=" fa fa-edit">
                                                </i> Edit</a>
 
                                            <a href="" data-toggle="modal" data-target="#deleteUser{{ $user->id }}" class="btn btn-sm btn-danger"><i class=" fa fa-trash">
                                                </i> Delete</a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal section Editing user details -->
                                <!-- Modal -->
                                <div class="modal right fade" id="editUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.update', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" id="" value="{{ $user->name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" id="" value="{{ $user->email }}" class="form-control">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <input type="text" name="phone" id="" value="{{ $user->phone }}" class="form-control">
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" readonly value="{{ $user->password }}" id="" class="form-control">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="">Comfrim Password</label>
                                                        <input type="password" name="confirm_password   " id="" class="form-control">
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="">Role</label>
                                                        @if ($user->is_admin==0)
                                                        <select name="is_admin" id="" class="form-control">
                                                            <option value="1" @if ($user->is_admin==0 or $user->is_admin==0)
                                                                selected
                                                                @endif> Admin</option>
                                                        </select>
                                                        @else
                                                        <select name="is_admin" id="" class="form-control">
                                                            <option value="1" @if ($user->is_admin==0 or $user->is_admin==0)
                                                                selected
                                                                @endif> Admin</option>
                                                            <option value="2" @if ($user->is_admin == 2)
                                                                selected
                                                                @endif>Cashier</option>
                                                        </select>
                                                        @endif
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info btn-block">Update User</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal right fade" id="notS{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                                                <h4 class="modal-title" id="staticBackdropLabel">Edit User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.update', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" id="" value="{{ $user->name }}" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" id="" value="{{ $user->email }}" class="form-control">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <input type="text" name="phone" id="" value="{{ $user->phone }}" class="form-control">
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" readonly value="{{ $user->password }}" id="" class="form-control">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label for="">Comfrim Password</label>
                                                        <input type="password" name="confirm_password   " id="" class="form-control">
                                                    </div> -->
                                                    <div class="form-group">
                                                        <label for="">Role</label>
                                                        @if ($user->is_admin==0)
                                                        <select name="is_admin" id="" class="form-control">
                                                            <option value="1" @if ($user->is_admin==0 or $user->is_admin==0)
                                                                selected
                                                                @endif> Admin</option>
                                                        </select>
                                                        @elseif ($user->is_admin==1)
                                                        <select name="is_admin" id="" class="form-control">
                                                            <option value="1" @if ($user->is_admin==0 or $user->is_admin==0)
                                                                selected
                                                                @endif> Admin</option>
                                                        </select>
                                                        @else
                                                        <select name="is_admin" id="" class="form-control">
                                                            <option value="2" @if ($user->is_admin == 2)
                                                                selected
                                                                @endif>Cashier</option>
                                                        </select>
                                                        @endif
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-info btn-block">Update User</button>
                                                    </div>
                                                </form>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal section Deleting user -->
                                <!-- Modal -->
                                <div class="modal right fade" id="deleteUser{{ $user->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #1f2833; color: #edf6ff">
                                                <h4 class="modal-title" id="staticBackdropLabel">Delete User</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <p>Are you sure you want to delete {{ $user->name }} ?</p>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal section adding new user -->
                                    <!-- Modal -->
                                    <div class="modal right fade" id="addUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"style="background: #1f2833; color: #edf6ff" >
                                                    <h4 class="modal-title" id="staticBackdropLabel">Add User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <form action="{{route('users.store')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="">Name</label>
                                                        <input type="text" name="name" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="email" name="email" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Comfrim Password</label>
                                                        <input type="password" name="confirm_password   " id="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Role</label>
                                                        <select name="is_admin" id="" class="form-control">
                                                            <option value="1">Admin</option>
                                                            <option value="2">Cashier</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary btn-block">Save User</button>
                                                    </div>
                                                </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                @endforeach
                                {{ $users->links() }}
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
           
                </div>
            </div>
        </div>
    </div>
</div>





<style>
    
</style>


@endsection

@section('script')
<script>
    $(document).ready(function(){
        $(document).on('change','input[name="searchUser"]',function(){

        });
    });
</script>
@endsection