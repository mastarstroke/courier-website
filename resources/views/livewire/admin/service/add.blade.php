
<!-- ========================= Add services ========================= -->

<div>
    <div class="col-12">
        @include('admin.alert')<!-- Alert Here -->
    </div>

    <div class="card card-primary card-outline"><!-- Card start -->
        <div class="card-header"><!-- Card header start -->
            <div class="row">
                <div class="col-6">
                    <a href="{{route('admin.service.view')}} " class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
        </div><!-- Card header end -->

        <form wire:submit.prevent="store"><!-- form start -->
            <div class="card-body"><!-- card-body start -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <label for="name">Name</label>
                                <input type="text" id="branch_name" wire:model="service_name" class="form-control">
                                @error('name')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-6 mt-3">
                                <label for="price">Price</label>
                                <input type="text" id="price" wire:model="price" class="form-control"
                                    placeholder="Eg: 10,20 ...">
                                @error('price')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-6 mt-3">
                                <label for="per_kg_rate">Per Kg Rate</label>
                                <input type="text" id="per_kg_rate" wire:model="per_kg_rate" class="form-control"
                                    placeholder="Eg: less than 50kg">
                                @error('per_kg_rate')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                            <div class="col-sm-12 mt-3">
                                <label for="description">Description</label>
                                <textarea wire:model="description" id="address" rows="4"
                                    class="form-control"></textarea>
                                @error('description')
                                <small class="text-danger">
                                    {{$message}}
                                </small>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div><!-- row end -->
            </div><!-- card-body end -->

            <div class="card-footer"><!-- footer start -->
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary">Add Service</button>
                    </div>
                    <div class="col-6 text-right" wire:loading wire:target="store">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div><!-- footer end -->
        </form><!-- form end -->
    </div><!-- Card end -->

</div>