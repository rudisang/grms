<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class AdminCategoryTable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if(request()->has('cat')){
            $search = request()->get('cat');
            $categories = Category::where('name', 'like', '%'.$search.'%')->paginate(10);
          }else{
            $categories = Category::orderBy('name','asc')->paginate(10);
          }
        return view('components.admin-category-table')->with('categories', $categories);
    }
}
