<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class heading extends Component
{
    public $countrySummary = null;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        #echo "Heading...!";
        $this->countrySummary =
        DB::table('ContactsList')->
            select(DB::raw("Country as country, count(*) as count"))
                ->groupBy("Country")->orderBy("Country")->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        #echo "Summary: ".var_dump($this->countrySummary,true)."\n";
        foreach ( $this->countrySummary as $key => $item ){
            //echo "Item: ".var_dump($item->country,true)."\n";
        }
        return view('components.heading');
    }
}
