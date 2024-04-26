<?php
//
//namespace App\Exports;
//
//use App\Models\ShippingPermit;
//use Illuminate\Contracts\View\View;
//use Maatwebsite\Excel\Concerns\FromView;
//
//class UsersExport implements FromView
//{
//    /**
//    * @return \Illuminate\Support\Collection
//    */
//    protected $columns_chosen;
//    protected $columns;
//    protected $sp;
//
//    public function __construct($columns_chosen,$sp,$columns)
//    {
//        $this->sp = $sp;
//        $this->columns_chosen = $columns_chosen;
//        $this->columns = $columns;
//    }
//
//    public function view(): View
//    {
//        return view('printables.shipping_permits.shipping_permit_excel')->with([
//            'columns_chosen' => $this->columns_chosen,
//            'sp' => $this->sp,
//            'columns' => $this->columns,
//        ]);
//    }
//
//
//}
