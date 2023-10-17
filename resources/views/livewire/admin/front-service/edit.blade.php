
<!-- ========================= Edit Welcome Page service section ========================= -->

<div>
    <div class="col-12">
        @include('admin.alert')<!-- Alert Here -->
    </div>

    <div class="col-md-12"><!-- col-md-12 start-->
        <div class="card card-primary card-outline"><!-- Card start -->
            <div class="card-header"><!-- Card header start -->
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('admin.service.index')}}" class="btn btn-secondary btn-sm">Back</a>
                    </div>
                </div>
            </div><!-- Card header end -->

            <form wire:submit.prevent="update"><!-- form start -->
                <div class="card-body"><!-- card-body start -->
                    <div class="row">
                        <div class="col-6">
                            <label for="name">Services Name</label>
                            <input type="text" wire:model="name" id="name" class="form-control">
                            @error('company_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="image">Image</label>
                            <input type="file" wire:model="image" id="image" class="form-control">
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="mt-3">
                                <label for="image">Old Image</label>
                                <img height="80" width="100" src="{{ Storage::url($services->image) }}" alt="Old Image">
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="description">Description</label>
                            <textarea wire:model="description" id="description" rows="4"
                                class="form-control"></textarea>
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                    </div><!-- row end -->
                </div><!-- card-body end -->

                <div class="card-footer"><!-- footer start -->
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">Update Service</button>
                        </div>
                        <div class="col-6 text-right" wire:loading wire:target="update">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div><!-- footer end -->

            </form><!-- form end -->
        </div><!-- Card end -->
    </div><!-- col-md-12 end-->

</div>