<x-app-layout>

    <div class="container bg-gray-50 p-4 text-center">
        <div class="container shadow overflow-hidden btn position-relative" style="max-height: 400px;" data-bs-toggle="modal" data-bs-target="#exampleModal">

            <img src="{{asset('images/products')}}/{{$product->image}}" class="img-fluid rounded-start" alt="{{$product->image}}">
        </div>
    </div>
    <div class="container d-md-flex justify-content-between bg-light p-4 mt-4">
        <div class="col-md-4 mb-2">
            <div class="bg-gray-100 col-md-11 p-2 shadow">
                <div class="fs-4 fw-bold mb-2">
                    Company
                </div>
                <div class="d-flex">
                    <span class="align-top ml-2 col-2">
                        <img src="{{asset('images/company')}}/{{$company->image}}" class="img-fluid rounded-start" alt="{{$company->image}}">
                    </span>
                    <span class="ml-2 align-bottom d-flex flex-column justify-content-center text-capitalize">
                        <b>
                            <a href="/companies/{{$company->id}}" class="text-decoration-none">
                                {{$company->name}}
                            </a>
                        </b>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-8 container bg-gray-100 m-0 p-2 shadow">
            <div class="fs-4 fw-bold mb-2">
                Details
            </div>

            <div>
                <small class="align-top text-justify">
                    <b>
                        name:
                    </b>
                    {{$product->name}}
                </small>
            </div>
            <div>
                <small class="align-top text-justify">
                    <b>
                        Released Date:
                    </b>
                    {{$product->released_date}}
                </small>
            </div>
            <div>
                <small class="align-top text-justify">
                    <b>
                        Description:
                    </b><br>
                    {{$product->description}}
                </small>
            </div>
        </div>
    </div>


    <!-- Modal  fullscre img-->
    <div class="modal fade bg-dark" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-transparent">
                <img src="{{asset('images/products')}}/{{$product->image}}" class="img-fluid rounded-start" alt="{{$product->image}}">
            </div>
        </div>
    </div>
    <!--End of modal  fullscre img-->

    <!-- Feedbacks layout -->
    <div class="container bg-light p-4 mt-4">
        <div class="d-flex">
            <div class="fs-4 fw-bold mb-2 mr-2">
                Feedbacks
            </div>
            <p>
                <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filter
                </button>
                <small>By Label: </small>
                <span class="badge bg-info p-1 m-0 text-dark">
                    {{$filtered_label}}
                </span>
            </p>
        </div>
        <div class="collapse" id="collapseExample">
            <div class=" card-body">
                <div>
                    <div class="form-check form-check-inline">
                        <form action="/filtered_feedback" method="POST">
                            @csrf
                            <button class="btn shadow-sm" name="all_label" value="All">
                                All
                            </button>
                            @foreach($labels as $label)

                            <button class="btn shadow-sm" name="label_id" value="{{$label->id}}">
                                {{$label->name}}
                            </button>
                            <!-- Sesssion -->
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @foreach($feedbacks as $feedback)
        <div class=" shadow mb-3 col-12 mx-auto p-3">
            <div class="row g-0 border-bottom pb-4">

                <div class="col-md-2 d-flex flex-column justify-content-center">
                    <div class="col-9 bg-gray-200 mx-auto mb-2">
                        <p class="fs-2 text-center p-4">{{$feedback->votes->count()}}</p>
                    </div>

                    @if($feedback->votes->pluck('email')->first() == Auth::user()->email)
                    <div class=" col-9 text-center mx-auto mb-2">
                        <div class=" col-12 bg-info shadow p-2 fw-bold">
                            VOTED!
                        </div>
                    </div>
                    @else
                    <div class="col-9 text-center mx-auto">
                        <form action="/votes" method="POST">
                            @csrf
                            <input type="hidden" name="feedback_id" value="{{$feedback->id}}">
                            <button class="btn btn-light shadow col-12 fw-bold">
                                VOTE
                            </button>
                        </form>
                    </div>
                    @endif

                    <div class="col-11 px-3 text-center mx-auto fw-bold  mt-2">
                        @if($feedback->action->name === 'Proposed')
                        <p class="bg-info">
                            {{$feedback->action->name}}
                        </p>
                        @elseif($feedback->action->name === 'On Development')
                        <p class="bg-primary">
                            {{$feedback->action->name}}
                        </p>
                        @elseif($feedback->action->name === 'Updated')
                        <p class="bg-success">
                            {{$feedback->action->name}}
                        </p>
                        @endif
                    </div>

                </div>
                <div class="col-md-10">
                    @if($feedback->user_id == Auth::user()->id or Auth::user()->id == $feedback->product->user_id or $feedback->product->user_id == Auth::user()->id)
                    <div class="container d-flex justify-content-end px-3 p-0">
                        <div class="dropdown">
                            <i class="fas fa-ellipsis-h pt-2 " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                @if($feedback->user_id == Auth::user()->id)
                                <li>
                                    <p class="dropdown-item" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#{{str_replace(" ", "",$feedback->title).$feedback->id}}">Edit</p>
                                </li>
                                @endif
                                @if($feedback->product->user_id == Auth::user()->id)
                                @foreach($actions as $action)
                                <li>
                                    <form action="/feedbacks/{{$feedback->id}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <button class="dropdown-item" name="action_id" value="{{$action->id}}">{{$action->name}}</button>
                                    </form>
                                </li>
                                @endforeach
                                @endif
                                <li>
                                    <button class="dropdown-item" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#{{"delete".str_replace(" ", "",$feedback->title).$feedback->id}}">
                                        Delete
                                    </button>
                                </li>
                            </ul>
                            <!-- Delete Modal -->
                            <div class="modal fade" id="{{"delete".str_replace(" ", "",$feedback->title).$feedback->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="card-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel">Delete Feedback?</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <p class="m-0">
                                                    <b class="card-title fs-5">
                                                        {{$feedback->title}}
                                                    </b>
                                                    <small class=""> {{'@'.$feedback->user->name}}</small>
                                                    <br>

                                                    <small class="text-muted">{{$feedback->updated_at->diffForHumans()}}</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-footer">

                                            <form action="/feedbacks/{{$feedback->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class=" btn-danger btn float-end">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="{{str_replace(" ", "",$feedback->title).$feedback->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="/feedbacks/{{$feedback->id}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                                                    <input type="text" class="form-control capitalized" id="exampleFormControlInput1" placeholder="Title" name="title" required value="{{$feedback->title}}">
                                                </div>
                                                @foreach($labels as $label)
                                                <div class="form-check form-check-inline">
                                                    @if($feedback->label_id == $label->id)
                                                    <input class="form-check-input" type="radio" name="label_id" id="inlineRadio1" value="{{$label->id}}" required checked>
                                                    <label class="form-check-label" for="inlineRadio1">{{$label->name}}</label>
                                                    @else
                                                    <input class="form-check-input" type="radio" name="label_id" id="inlineRadio1" value="{{$label->id}}" required>
                                                    <label class="form-check-label" for="inlineRadio1">{{$label->name}}</label>
                                                    @endif
                                                </div>
                                                @endforeach
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="feedback" required>{{$feedback->feedback}}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button class="btn shadow-sm btn-primary">Submit</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <span class="badge bg-info p-1 m-0 text-dark shadow">
                        {{$feedback->label->name}}
                    </span>
                    <div class="card-body">
                        <p class="m-0">
                            <b class="card-title fs-5">
                                {{$feedback->title}}
                            </b>
                            <small class=""> {{'@'.$feedback->user->name}}</small>
                            <br>

                            <small class="text-muted">{{$feedback->updated_at->diffForHumans()}}</small>
                        </p>
                        <p class="card-text py-3">{{$feedback->feedback}}</p>
                    </div>
                </div>
            </div>


            <form action="/comments" method="POST"><br>
                <div class="container">
                    <small class="ml-3 fw-bold">Add Comment</small>
                </div>
                <div class="container col-12 d-md-flex mt-2">
                    @csrf
                    <div class="form-floating col-md-7 ml-2">
                        <input type="hidden" value="{{$feedback->id}}" name="feedback_id">
                        <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea" rows="1" required></textarea>
                        <label for="floatingTextarea">Comment</label>
                    </div>
                    <div class="col-10 pt-3">
                        <button class="btn btn-info ml-3">Submit</button>
                    </div>
                </div>
            </form>

            @php
            $filtered_comments = $comments->where('feedback_id', $feedback->id)
            @endphp
            <div class="container">
                <div class="card col-12 border-0 mx-auto p-2 bg-transparent">
                    @foreach($filtered_comments as $comment)
                    <div class="card mb-3 border-0 bg-white shadow">
                        <div class="row g-0">
                            <div class="card-body">
                                @include('comment.comment')
                                <h5 class="card-title m-0">{{$comment->user->name}}</h5>
                                <p class="card-text p-0 m-0"><small class="text-muted">{{$comment->updated_at->diffForHumans()}}</small></p>
                                <p class="card-text">{{$comment->comment}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- end feedback layout -->
    <div class="bg-light p-4 container bg-white">
        <span class="p-4">
            {{$feedbacks->links()}}
        </span>
    </div>

    @if($product->status_id ==1)
    <!-- inactive -->
    <div class="container-fluid bg-light p-3 mt-4">
        <div class="container shadow py-3">
            <div class="alert alert-light fs-3" role="alert">
                Product owner disbled to accept feedback!
            </div>
        </div>
    </div>
    @else
    <!-- active -->
    @include('feedback.add-feedback')
    @endif
</x-app-layout>