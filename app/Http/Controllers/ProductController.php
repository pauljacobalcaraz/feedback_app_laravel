<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\Label;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dashboard
        $products = Product::all();
        return view('dashboard', ['products' => $products,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->company_id);
        $image = $request->file('file');
        $imageName =  $request->name . time()   . '.' . $image->extension();
        $image->move(public_path('images/products'), $imageName);

        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->company_id = $request->company_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $imageName;
        $product->status_id = 1; //inactive
        $product->released_date = $request->released;
        $product->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */



    public function show(Product $product, Request $request)
    {
        $company = Company::all()->where('id', '=', $product->company_id)->first();
        $labels = Label::all();

        $actions = Action::all();

        $feedbacks = Feedback::orderBy('label_id', 'DESC')->where('product_id', '=', $product->id)->paginate(20);
        $filtered_label = 'All';
        if (session('label_id')) {
            $feedbacks = Feedback::where('product_id', '=', $product->id)->where('label_id', '=', session('label_id'))->paginate(20);
            $filtered_label = Label::all()->where('id', '=', session('label_id'))->pluck('name')->first();
        }

        $comments = Comment::all();
        // dd($comments);

        return view('feedback.feedback', ['product' => $product, 'company' => $company, 'labels' => $labels,  'feedbacks' => $feedbacks, 'comments' => $comments, 'filtered_label' => $filtered_label, 'actions' => $actions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->name) //{update data by user
        {
            if ($request->file) {
                $image = $request->file('file');
                $imageName =  $request->name . time()   . '.' . $image->extension();
                $image->move(public_path('images/prodycts'), $imageName);
                $product->image = $imageName;
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->released_date = $request->released_date;
        } else { //update the status by admin

            if ($product->status->id == 1) //inactvie
            {

                $product->status_id = 2; //2 is to active
            } else {

                $product->status_id = 1; //1 is to inactive
            }
        }
        $product->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

    public function productTrashed()
    {
        $trashedProducts = Product::onlyTrashed()->get();
        return view('product.restore', ['trashedProducts' => $trashedProducts]);

        // pano kunin yung id ng company para mai display ang mga product related sa company
    }
    public function productRestoreTrashed(Request $request)
    {

        $companyId = Product::onlyTrashed()->get()->where('id', '=', 1)->pluck('company_id')->first(); //get company id to redirect company page
        // dd($companyId);
        $product = Product::withTrashed()->find($request->product_id)->restore();
        return redirect()->back()->withMessage('companies/' . $companyId);
    }
}
