<div class="row">
    @forelse ($user_details as $user_detail)

    <div class="col-md-12">
        <div class="form-group">
            <label for=""> Transaction by: </label>
            <input type="text" class="form-control" value="{{ $user_detail->name }}" readonly>
        </div>
    </div>

    @empty
    @endforelse
</div>


<style>
    input:read-only {
        background: #fff !important;

    }

    textarea:read-only {
        background: #fff !important;

    }
</style>