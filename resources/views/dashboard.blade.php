<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                @foreach($products as $product)
                <div class="card mb-3 p-4">
                    @if($product->user_id == Auth::user()->id)
                    <div class="container d-flex justify-content-end px-3 mt-4">
                        <div class="dropdown">

                            <i class="fas fa-ellipsis-h pt-2 " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <p class="dropdown-item" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#{{str_replace(" ", "",$product->name).$product->id}}">Edit</p>
                                </li>

                                <form action="/products/{{$product->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <li>
                                        <button class="dropdown-item">
                                            Delete
                                        </button>
                                    </li>
                                </form>
                            </ul>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="{{str_replace(" ", "",$product->name).$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/products/{{$product->id}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                                    <input type="text" class="form-control capitalized" name="name" required value="{{$product->name}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Description</label>
                                                    <textarea rows="6" class="form-control capitalized" name="description" required value=>{{$product->description}}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Released Date</label>
                                                    <input type="date" class="form-control capitalized" name="released_date" required value="{{$product->released_date}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                                                    <input type="file" accept="image/*" name="file" class="form-control edit-file" />
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Product</button>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset('images/products')}}/{{$product->image}}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8 d-flex flex-column justify-content-around">
                            <div class="card-body">
                                <div class="col-md-12 mb-2 d-flex justify-content-start">
                                    <div class="d-flex col-1 flex-column justify-content-start">
                                        <img src="{{asset('images/company')}}/{{$product->company->image}}" alt="{{$product->company->image}}" class=" border-0 rounded-circle col-10" alt="...">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center col-11">
                                        <a href="/companies/{{$product->company_id}}">
                                            <h6 class="card-title text-capitalize mt-2">{{$product->company->name}}</h6>
                                        </a>
                                    </div>
                                </div>
                                <h5 class="card-title ">{{$product->name}}</h5>


                                <small class="card-text"><b>Released: </b> {{\Carbon\Carbon::parse($product->released_date)->format('d/m/y')}}</small>
                                <div class="mt-1">
                                    <b>Description</b><br>
                                    <p class="card-text">{!!nl2br($product->description)!!}</p>
                                </div>
                                <p class="card-text"><small class="text-muted">{{$product->updated_at->diffForHumans()}}</small></p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div>
                                    @if($product->user_id == Auth::user()->id)
                                    <!-- 1 of inactive -->
                                    @if($product->status->id == 1)
                                    <small class="card-text bg-danger p-1 rounded" id="status" data-bs-toggle="dropdown" aria-expanded="false">
                                        <button>
                                            {{$product->status->name}}
                                        </button>
                                    </small>
                                    @else
                                    <small class="card-text bg-success p-1 rounded" id="status" data-bs-toggle="dropdown" aria-expanded="false">
                                        <button>
                                            {{$product->status->name}}
                                        </button>
                                    </small>
                                    @endif
                                    <ul class="dropdown-menu" aria-labelledby="status">
                                        @if($product->status->id == 1)
                                        <form action="/products/{{$product->id}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <li>
                                                <button class="dropdown-item">
                                                    Activate
                                                </button>
                                            </li>
                                        </form>
                                        @else
                                        <form action="/products/{{$product->id}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <li>
                                                <button class="dropdown-item">
                                                    Inactivate
                                                </button>
                                            </li>
                                        </form> @endif
                                    </ul>
                                    @endif
                                    <small class="card-text bg-light shadow p-1 rounded ml-1 mr-3">
                                        <a href="/products/{{$product->id}}" class="text-decoration-none text-dark bg-gray-150">
                                            Feedbacks
                                        </a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>