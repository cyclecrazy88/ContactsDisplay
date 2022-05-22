<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class summaryCard extends Component
{
    public $resultData = null;
    public $commentsData = null;
    public $commentItem = "";
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->resultData =
            DB::table('ContactsList')->orderBy("Country")->get();
        $commentsData =
            DB::table('CommentsList')->orderBy("key")->get();
        $this->commentsData = $commentsData;

        #echo "Comment: ".var_dump($commentsData,true);
        // Loop around the contacts -- Add the contacts details
        //  when available
        foreach ( $this->resultData as $contactKey => $value){
            //echo "Contact: ".var_export($value,true)."\n";
            $value->comment = "";

            // Loop around the comments result -- Append a comment
            //  to the result if available.
            foreach ($commentsData as $commentKey => $commentItem){
                if ($commentItem->key == $value->key){
                    $value->comment = $commentItem->comment;
                    echo "Comment: ".$value->comment."\n";
                }
            }
        }


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.summary-card');
    }
}
