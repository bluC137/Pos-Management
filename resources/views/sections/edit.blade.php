<div class="modal fade closeModal" id="editSection" wire:ignore.self data-backdrop="static">
<div class="modal-dialog right-crud modal-xl">
    <div class="modal-content">
        <div class="modal-header">
                <h3 class="modal-title">Edit New Section</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        <div class="modal-body">
            <form wire:submit.prevent="update( {{  $section->id }} )" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                
                
                <div class="form-row">
                    <div class="col">
                        <label for=""> Section Name </label>
                        <input type="text" wire:model="section_name" class="form-control" autocomplete="off">
                        @error('section_name')
                            <span class="text=danger">{{ $message }} </span>
                        @enderror
                    </div>

                    <div class="col-sm-1" data-toggle="tooltip" data-placement="top" title="status">
                        <label class="switch" style="margin-top: 2.2em !important; " >
                        <input type="checkbox" wire:model="section_status">
                        <span class="slider"></span>
                        </label>
                    </div>

                </div>
           
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">
                        Update Section
                    </button>
                    <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<style>
.switch{
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
}


.switch input{
    opacity:0;
    width: 0;
    height: 0;

}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;

}

.switch::before{
    position:absolute;
    content: '';
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input:checked+.slider{
    background-color: green;
}

input:focus+.slider{
    box-shadow: 0 01px green;
}

input:checked+.slider:before{
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

.slider.round{
    border-radius: 34px;
}

.slider.round::before{
    border-radius: 50%;
}
</style>