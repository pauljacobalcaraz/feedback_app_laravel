@if($comment->user_id == Auth::user()->id)
<div class="dropdown bg-danger col-12">
    <i class="fas fa-ellipsis-h pt-2 float-end" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>

    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

        <li>
            <p class="dropdown-item" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#{{str_replace(" ", "",$comment->user->name).$comment->id}}">Edit</p>
        </li>

        <li>
            <button class="dropdown-item" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#{{"delete".str_replace(" ", "",$comment->user->name).$comment->id}}">
                Delete
            </button>
        </li>
    </ul>
    <!-- Delete Modal -->
    <div class="modal fade" id="{{"delete".str_replace(" ", "",$comment->user->name).$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="card-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Delete Comment?</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <p class="m-0">
                            <small class=""> {{$comment->comment}}</small>
                        </p>
                    </div>
                </div>
                <div class="card-footer">

                    <form action="/comments/{{$comment->id}}" method="POST">
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
    <div class="modal fade" id="{{str_replace(" ", "",$comment->user->name).$comment->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/comments/{{$comment->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-floating col-md-12 ml-2">
                            <input type="hidden" value="{{$feedback->id}}" name="feedback_id">
                            <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea" rows="1" required>{{$comment->comment}}</textarea>
                            <label for="floatingTextarea">Comment</label>
                        </div>
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
@endif