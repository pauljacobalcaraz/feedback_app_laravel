<div class="container-fluid bg-light p-3 mt-4">
    <div class="container shadow py-3">
        <h4>Add Feedback</h4>
        <div class="mb-3">
            <form action="/feedbacks" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value={{$product->id}}>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control capitalized" id="exampleFormControlInput1" placeholder="Title" name="title" required>
                </div>
                @foreach($labels as $label)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="label_id" id="inlineRadio1" value="{{$label->id}}" required>
                    <label class="form-check-label" for="inlineRadio1">{{$label->name}}</label>
                </div>
                @endforeach
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="10" name="feedback" required></textarea>
                <div class="d-flex justify-content-end mt-2">
                    <button class="btn shadow-sm btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

</div>