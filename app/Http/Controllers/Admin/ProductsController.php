<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //SELECT products.* , categories.name as category_name FROM products
        //INNER join categories ON categories.id = products.category_id
        //$products= DB::table('products')
        //->leftJoin('categories','categories.id','=','products.category_id')
        //->select([
        //    'products.*',
        //    'categories.name as category_name',
        // ])
        //->get(); //collection objects = array
        //SELECT * FROM products

        $products = Product::leftJoin('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name',
            ])
           // ->active()
            //->withoutGlobalScope('owner')
            ->paginate(5); //Collection of product model

        return view('admin.products.index', [
            'title' => 'Products List',
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', [
            'product' => new product(),
            'categories' => $categories,
            'status_options' => Product::statusOptions(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // $rules = $this->rules();
        // $messages = $this->messages();
        // $request->validate($rules, $messages);

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image'); //return UploadedFile object
            $path = $file->store('uploads/images', 'public'); //return file path after store
            $data['image'] = $path;
        }
        $product = Product::create($data);

        if($request->hasFile('gallery')){
            foreach($request->file('gallery') as $file){
             ProductImage::create([
                 'product_id' => $product->id,
                 'image' => $file->store('uploads/images', 'public'),
             ]);
            } // array of uplaoded file
         }
         

        //$request->all();
        //$product = Product::create($request->all());
        //$product = new Product();
        //$product->name = $request->input('name');
        //$product->slug = $request->input('slug');
        //$product->category_id = $request->input('category_id');
        //$product->description = $request->input('description');
        //$product->short_description = $request->input('short_description');
        //$product->price = $request->input('price');
        //$product->compare_price = $request->input('compare_price');
        // $product->image = $request->input('image');
        // $product->status = $request->input('status','active');
        // $product->save();

        //Prg post redirict get
        return redirect()
            ->route('products.index')
            ->with('success', "Product ({$product->name}) created"); //add flash message with name=success

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        //$product = product::findOrFail($id); //return Model object or null
        $categories = Category::all();
        $gallery = ProductImage::where('product_id', '=', $product->id)->get();

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'status_options' => Product::statusOptions(),
            'gallery' => $gallery,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // $rules = $this->rules($id);
        // $messages = $this->messages();
        // $request->validate($rules, $messages);
        

        $data = $request->validated();//mass assaigment
        if ($request->hasFile('image')) {
            $file = $request->file('image'); //return UploadedFile object
            $path = $file->store('uploads/images', 'public'); //return file path after store
            $data['image'] = $path;
        }

        $old_image = $product->image;
        $product->update($data);
        
        if ($old_image && $old_image != $product->image) {
            Storage::disk('/public')->delete($old_image);
        }

        if($request->hasFile('gallery')){
           foreach($request->file('gallery') as $file){
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $file->store('uploads/images', 'public'),
            ]);
           } // array of uplaoded file
        }
        

        // if($request->hasFile('gallery')){
        //     foreach($request->file('gallery'as $file){
        //         ProductImage::create
        //     }
        // }
        //$product =Product::findOrFail($id);
        // $product->name = $request->input('name');
        ///$product->slug = $request->input('slug');
        ///$product->category_id = $request->input('category_id');
        // $product->description = $request->input('description');
        // $product->short_description = $request->input('short_description');
        // $product->price = $request->input('price');
        // $product->compare_price= $request->input('compare_price');
        // $product->status= $request->input('status','active');
        // $product->save();

        return redirect()
            ->route('products.index')
            ->with('success', "Product({$product->name}) updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //Product::where('id', '=', $id)->delete();
        // product::destroy($id);
        //$product = product::findOrFail($id);
        $product->delete();
      
        return redirect()
            ->route('products.index')
            ->with('success', "Product({$product->name}) deleted");
    }

    public function trashed()
    {
        $products = Product::onlyTrashed()->paginate();
        return view('admin.products.trashed', [
            'products' => $products
        ]);
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()
            ->route('products.index')
            ->with('success', "Product ({$product->name}) restored");
    }


    public function forceDelete($id)
    {
        $product = product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        if ($product->image) {
            Storage::disk('puplic')->delete($product->image);
        }
        return redirect()
            ->route('products.index')
            ->with('success', "product({$product->name}) deleted forever!");
    }

    protected function messages(): array
    {
        return
            [
                'required' => ':attribute field is require!!',
                'unique' => 'The value alredy exists!',
                'name.required' => 'The product name is mandatory!',
            ];
        [
            'required' => ':attribbute ifeld is '
        ];
    }
    protected function rules($id = 0)
    {
        return [
            'name' => 'required|max:255|min:3',
            'slug' => "required|unique:products,slug,$id",
            'category_id' => 'nullable|int|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'image' => 'nullable|image|dimensions:min_width=400,min_height=300|max:1024',
            'status' => 'required|in:active,draft,archived',
        ];
    }
}
