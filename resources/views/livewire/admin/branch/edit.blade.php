
<!-- ========================= Edit Brand Page ========================= -->

<div>
    <div class="col-12">
        @include('admin.alert')<!-- Alert Here -->
    </div>

    <div class="card card-primary card-outline"><!-- Card start -->
        <div class="card-header"><!-- Card header start -->
            <div class="row">
                <div class="col-6">
                    <a href="{{route('admin.branch.view')}}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
        </div><!-- Card header end -->

        <form wire:submit.prevent="update"><!-- form start -->
            <div class="card-body"><!-- card-body start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-4 mt-3">
                                <label for="branch_name">Branch Name</label>
                                <input type="text" id="branch_name" wire:model="branch_name" class="form-control">
                                @error('branch_name')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="branch_email">Branch Email</label>
                                <input type="email" id="branch_email" wire:model="branch_email" class="form-control">
                                @error('branch_email')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-4 mt-3">
                                <label for="branch_phone">Branch Phone</label>
                                <input type="text" id="branch_phone" wire:model="branch_phone" class="form-control">
                                @error('branch_phone')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-12 mt-3">
                                <label for="branch_address">Branch Address</label>
                                <textarea type="text" wire:model="branch_address" id="branch_address" rows="4"
                                    class="form-control"></textarea>
                                @error('branch_phone')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="branch_city">Branch City</label>
                                <input type="text" id="branch_city" wire:model="branch_city" class="form-control">
                                @error('branch_city')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="branch_state">Branch State</label>
                                <input type="text" id="branch_state" wire:model="branch_state" class="form-control">
                                @error('branch_state')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="branch_pin">Branch Pincode</label>
                                <input type="text" id="branch_pin" wire:model="branch_pin" class="form-control">
                                @error('branch_pin')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-3 mt-3">
                                <label for="branch_country">Branch Country</label>
                                <input type="text" id="branch_country" wire:model="branch_country" class="form-control">
                                @error('branch_country')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>
                        </div><!-- row end -->
                    </div><!-- col-lg-12" -->
                </div><!-- row end -->
            </div><!-- card-body end -->

            <div class="card-footer"><!-- footer start -->
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Update Branch</button>
                    </div>
                    <div class="col-6 text-right" wire:loading wire:target="update">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div><!-- end -->
            
        </form><!-- form end -->
    </div><!-- Card end -->
</div>