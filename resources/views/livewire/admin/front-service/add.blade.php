
<!-- ========================= Add Welcome Page service section ========================= -->

<div>
    <div class="col-12">
        @include('admin.alert')<!-- Alert Here -->
    </div>

    <div class="col-md-12"><!-- col-md-12 start-->
        <div class="card card-primary card-outline"><!-- Card start -->
            <div class="card-header"><!-- Card header start -->
                <h5 class="m-0" id="heading">
                    Add new Services
                </h5>
            </div><!-- Card header end -->

            <form wire:submit.prevent="store"><!-- form start -->
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
                            @if($image)
                            Photo Preview::
                            <img height="100" width="100" class="mt-3" src="{{$image->temporaryUrl() }}" alt="">
                            @endif
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-12 mt-3">
                            <label for="description">Description</label>
                            <textarea type="text" wire:model="description" id="description" rows="4"
                                class=""></textarea>
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
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
    </div><!-- col-md-12 end -->

    <div class="row my-5">
        <div class="col-md-12">

            <table class="table-bordered">
                <tr>
                    <th style="padding: 30px;">Name</th>
                    <th style="padding: 30px;">Description</th>
                    <th style="padding: 30px;">Image</th>
                    <th style="padding: 30px;">Modify</th>
                    <th style="padding: 30px;">Remove</th>
                </tr>

                @foreach($services as $service)
                <tr align="center">
                    <td>{{$service->name}}</td>
                    <td>{{$service->description}}</td>
                    <td><img height="80" width="100" src="{{ Storage::url($service->image) }}"></td>

                    <td>
                        <a href="{{route('admin.services.edit', $service->id)}}"
                            class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a></a>
                    </td>

                    <td>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById
                            ('delete-form-{{$service->id}}').submit();" class="btn btn-outline-danger btn-sm"><i
                                class="fas fa-trash"></i></a></a>
                        <form action="{{route('admin.services.delete', $service->id)}}" syle="display: none;"
                            method="post" id="delete-form-{{$service->id}}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </table><!-- table end-->

        </div><!-- col-md-12 end-->
    </div><!-- row end-->

</div>