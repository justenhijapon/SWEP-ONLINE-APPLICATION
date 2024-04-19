<?php

namespace App\Exports;

use App\Models\OfficialReciepts;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OfficialRecieptsExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $columns_chosen;
    protected $columns;
    protected $or;

    public function __construct($columns_chosen,$or,$columns)
    {
        $this->or = $or;
        $this->columns_chosen = $columns_chosen;
        $this->columns = $columns;
    }

    public function view(): View
    {
        return view('printables.official_reciepts.official_reciepts_excel')->with([
            'columns_chosen' => $this->columns_chosen,
            'or' => $this->or,
            'columns' => $this->columns,
        ]);
    }


}
