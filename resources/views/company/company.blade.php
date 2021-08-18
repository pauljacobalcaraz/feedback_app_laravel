<x-app-layout>
    <style>
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
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" container  py-1 d-flex bg-light justify-content-between ">
                <div class="fs-4 fw-bold">
                    Companies
                </div>
                <div class="pt-1">
                    <!-- Button trigger modal for add Company -->
                    <button class="shadow ml-1 px-2 rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span>
                            Add
                        </span>
                    </button>
                    <!-- Go to restore company -->
                    <button class="bg-info shadow ml-1 px-2 rounded">
                        <a href="/company/restore" class="text-decoration-none text-dark">
                            Restore
                        </a>
                    </button>
                </div>
                <!-- Modal for Add Company -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/companies" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Company Name</label>
                                        <input type="text" class="form-control capitalized" id="exampleFormControlInput1" placeholder="Company Name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">About</label>
                                        <textarea rows="6" class="form-control capitalized" id="exampleFormControlInput1" name="about" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Company Type</label>
                                        <input type="text" class="form-control capitalized" id="exampleFormControlInput1" name="company_type" placeholder="Company Type" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Company Logo</label>
                                        <input type="file" accept="image/*" name="file" class="form-control edit-file" required />
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
            </div>
            <div class="container p-2 rounded d-flex bg-white justify-content-around justify-content-md-start">
                @foreach($companies as $company)
                <div class="card bg-light text-white col-lg-2 col-md-4 col-6 p-2 m-1">
                    <img src="{{asset('images/company')}}/{{$company->image}}" alt="{{$company->name}}" class="card-img" alt="...">
                    <div class="card-img-overlay p-0 d-flex justify-content-end">
                        <div class="setting-icon-container">
                            <!-- <span class="material-icons">
                                settings
                            </span> -->

                            <a href="#" class="position-absolute top-0 end-0" role=" button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="material-icons">
                                    settings
                                </span>

                            </a>

                            <div class="p-4">
                                <div class="col-12 mt-4 py-4 text-center fs-4">
                                    <a href="/companies/{{$company->id}}" class="hide bg-light p-1 rounded text-decoration-none">View</a>
                                </div>
                            </div>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <!-- For Admin buttons -->
                                @if(Auth::user()->id === 1)
                                <!-- If Inactive -->
                                @if($company->status->id == 1)
                                <form action="/companies/{{$company->id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <li>
                                        <button class="dropdown-item">
                                            Activate
                                        </button>
                                    </li>
                                </form>
                                <!-- if Active -->
                                @else
                                <form action="/companies/{{$company->id}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <li>
                                        <button class="dropdown-item">
                                            Inactivate
                                        </button>
                                    </li>
                                </form>
                                @endif

                                <!-- for User -->
                                @else
                                <li>
                                    <!-- Button trigger to Edit modal -->
                                    <p class="dropdown-item" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#{{str_replace(" ", "",$company->name).$company->id}}">Edit</p>
                                </li>
                                <form action="/companies/{{$company->id}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <li>
                                        <button class="dropdown-item">
                                            Delete
                                        </button>
                                    </li>
                                </form>
                                @endif
                            </ul>
                            <!-- Edit Modal -->
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
                                                    <input type="text" class="form-control capitalized" id="exampleFormControlInput1" name="company_type" placeholder="Company Type" required value={{$company->company_type}}>
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
                        </div>
                    </div>
                    <div class="text-center">
                        <h5 class="card-title text-dark bg-light">{{$company->name}}</h5>
                        @if($company->status->id == 1)
                        <p class="card-text bg-danger">{{$company->status->name}}</p>
                        @else
                        <p class="card-text bg-success">{{$company->status->name}}</p>
                        @endif

                    </div>
                </div>

                @endforeach

            </div>
        </div>

    </div>



</x-app-layout>