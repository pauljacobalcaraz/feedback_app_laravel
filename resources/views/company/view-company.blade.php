<x-app-layout>
    <!-- <style>
        .setting-icon-container {
            /* height: 25px; */
            height: 100%;
            width: 100%;
            /* display: flex;
            justify-content: flex-end; */
            padding: 1px;
        }

        .hide {
            visibility: hidden;
        }

        .setting-icon-container:hover {
            color: black;
        }

        .setting-icon-container:hover {
            background-color: rgba(84, 108, 108, 0.19);
        }

        .setting-icon-container:hover .hide {
            visibility: visible;
        }

        a {
            text-decoration: none;
            color: black;
        }
    </style> -->
    <div class="container d-flex justify-content-end bg-light px-3 mt-4">
        <i class="fas fa-ellipsis-h pt-2" data-bs-toggle="modal" data-bs-target="#{{str_replace(" ", "",$company->name).$company->id}}" l></i>
    </div>
    <div class="modal fade" id="{{str_replace(" ", "",$company->name).$company->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/companies/{{$company->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                            <input type="text" class="form-control capitalized" id="exampleFormControlInput1" placeholder="Company Name" name="name" required value="{{$company->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">About</label>
                            <textarea rows="6" class="form-control capitalized" id="exampleFormControlInput1" name="about" required value=>{{$company->about}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Company Type</label>
                            <input type="text" class="form-control capitalized" id="exampleFormControlInput1" name="company_type" placeholder="Company Type" required value="{{$company->company_type}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Company Logo</label>
                            <input type="file" accept="image/*" name="file" class="form-control edit-file" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Company</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class=" container d-md-flex justify-content-between bg-light p-4">
        <div class="d-flex p-2">
            <div class="col-4 col-md-2 d-flex flex-column justify-content-center ">
                <img src="{{asset('images/company')}}/{{$company->image}}" alt="{{$company->name}}" class="card-img rounded-circle" alt="...">
            </div>
            <div class="align-middle d-flex flex-column justify-content-end p-2">
                <span class="fs-3">
                    {{$company->name}}
                </span>
                <small>
                    {{'@'.$company->user->name}}
                    - {{$company->company_type}}
                </small>
            </div>
        </div>
        <div class="d-flex flex-column justify-content-end">

            <p class="bg-info px-2 py-1 rounded text-white">{{$company->products->count()}} Products</p>
        </div>
    </div>

    <div class="container d-md-flex justify-content-between bg-light p-4 mt-4">
        <div class="col-md-4 mb-2">
            <div class="bg-gray-100 col-md-11 p-2 shadow">
                <div class="fs-4 fw-bold mb-2">
                    Details
                </div>
                <div>
                    <i class="fas fa-user text-info fs-5"></i>
                    <span class="align-top ml-2">
                        {{$company->user->name}}
                    </span>
                </div>
                <div>
                    <i class="far fa-envelope text-info fs-5"></i>
                    <span class="align-top ml-2">
                        {{$company->user->email}}
                    </span>
                </div>
                <div>
                    <i class="far fa-building text-info fs-5"></i>
                    <span class="align-top ml-2">
                        {{$company->company_type}}
                    </span>
                </div>

            </div>
        </div>

        <div class="col-md-8 container bg-gray-100 m-0 p-2 shadow">
            <div class="fs-4 fw-bold mb-2">
                About
            </div>

            <div>
                <small class="align-top text-justify">
                    {{$company->about}}
                </small>
            </div>
        </div>
    </div>

    @if($company->status_id == 1)
    <!-- inactive -->

    <div class="container shadow py-3">
        <div class="alert alert-light" role="alert">
            <p class="fs-2" role="alert">
                Your Company was inactive.
            </p>
            <p>
                To add product, ask the admin to make it active!
            </p>
        </div>

    </div>

    @else
    <!-- active -->
    @include('product.product')
    @endif

</x-app-layout>