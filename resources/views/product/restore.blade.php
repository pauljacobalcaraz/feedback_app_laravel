<x-app-layout>
    <style>
        .setting-icon-container {
            height: 25px;
            padding: 1px;
        }

        .setting-icon-container:hover>span {
            color: red;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style>

    <div class="py-12">
        <!-- Trashed Companies -->

        <div class=" container  py-1 d-flex bg-light justify-content-between ">
            <div class="fs-4 fw-bold">
                Trashed
            </div>
        </div>
        <div class="container p-2 rounded d-flex bg-white justify-content-around justify-content-md-start">
            <!-- Empty Trash -->
            @if($trashedProducts->count() == 0)
            <div class="alert alert-light" role="alert">
                <i class="fas fa-trash-alt"></i> Trash Empty!
            </div>
            @else
            <!-- Restored Success -->
            @if(session('message'))
            <div class="alert alert-secondary" role="alert">
                Product Restored - <a href="/{{session('message')}}">View Restored Product</a>
            </div>
            @endif
            <!-- Display All Products -->
            @foreach($trashedProducts as $trashedProduct)
            <div class="card bg-light text-white col-lg-2 col-md-4 col-6 p-2 m-1">
                <img src="{{asset('images/product')}}/{{$trashedProduct->image}}" alt="{{$trashedProduct->name}}" class="card-img" alt="...">
                <div class="card-img-overlay p-0 d-flex justify-content-end">
                    <div class="setting-icon-container">
                        <!-- <span class="material-icons">
                                settings
                            </span> -->

                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="material-icons">
                                settings
                            </span>

                        </a>

                        <ul class="dropdown-menu " aria-labelledby="dropdownMenuLink">
                            <li>
                                <form action="/product/restore/{{$trashedProduct->id}}" action="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="product_id" value="{{$trashedProduct->id}}">
                                    <button class="dropdown-item">Restore</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="text-center">
                    <h5 class="card-title text-dark bg-light">{{$trashedProduct->name}}</h5>
                    <p class=" card-text bg-danger">{{$trashedProduct->status->name}}</p>
                </div>
            </div>

            @endforeach
            @endif

        </div>

    </div>

</x-app-layout>