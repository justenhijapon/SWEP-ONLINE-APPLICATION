<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GroupedShippingPermitExport implements FromView
{
    protected $columns_chosen;
    protected $columns;
    protected $sp;
    protected $port_origin;

    public function __construct($columns_chosen, $sp, $columns, $port_origin)
    {
        $this->sp = $sp;
        $this->columns_chosen = $columns_chosen;
        $this->columns = $columns;
        $this->port_origin = $port_origin;
    }

    public function view(): View
    {
        return view('printables.shipping_permits.shipping_permit_excel')->with([
            'columns_chosen' => $this->columns_chosen,
            'sp' => $this->sp,
            'columns' => $this->columns,
            'port_origin' => $this->port_origin,
        ]);
    }
}

