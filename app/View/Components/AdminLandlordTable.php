<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Landlord;

class AdminLandlordTable extends Component
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
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
       
            $landlords = Landlord::orderBy('created_at','desc')->paginate(10);
          
        
        return view('components.admin-landlord-table')->with('landlords', $landlords);
    }
}
