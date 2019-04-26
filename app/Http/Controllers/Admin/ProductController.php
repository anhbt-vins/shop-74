<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product) {
        $this->product = $product;
    }
    public function index() {
        $products = Product::paginate(7);
    	return view('admin.product.index', compact('products'));
    }
    public function create() {
    	return view('admin.product.create');
    }
    public function getEdit($product) {
        $product = $this->product->find($product);
    	return view('admin.product.edit',compact('product'));
    }
    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'unique:products,name'
        ],
        [
            'name.unique' => 'Tên danh mục đã bị trùng'
        ]);
        //dd('sadsa');
        if ($request->hasFile('avatar')) {
            $avatarName = Str::uuid('image') . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('media/product'),$avatarName);
            $product->avatar  = asset('media/product'). '/' . $avatarName;
         }
        $product->name = $request->name;
        $product->price = $request->price;
        $product->highlight = $request->highlight;
        $product->quantity  = $request->quantity;
        $product->save();
        return back();
    }
    public function store(Request $request) {
    	$this->validate($request,
    		[
    			'name' => 'required',
    			'price' => 'required',
    		],

    		[
    			'required' => ':attribute field is required',
    		]
    	);
    	$product = Product::create([
    		'name' => $request->name,
    		'price'=> $request->price,
    		'highlight' => $request->highlight,
    		'quantity'  => $request->quantity,
    		'avatar'    => $request->avatar,
    		'description' => $request->description,
    	]);
    	session()->flash('add_product', 'succee');
    	return redirect('admin/products/'.$product->id.'/edit');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message'=>'thành công'], 204);
    }
    // public function update(Product $product, Request $request)
    // {
    //     if ($request->hasFile('avatar')) {
            
    //     }
    // }
}
