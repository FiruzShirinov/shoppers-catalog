<?php

namespace App\DataTables;

use App\Models\Shopper;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShoppersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('image', function ($shopper) {
                return '<img src="'.$shopper->image.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('action', function ($shopper) {
                return '
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="'.route('shoppers.edit', $shopper->id).'" class="btn btn-xs btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div>
                    <form method="POST" action="'.route('shoppers.destroy', $shopper->id).'">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-xs btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                    </form>
                </div>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['image', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ShoppersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Shopper $model)
    {
        return $model->newQuery()->withCount('purchases')->withSum('purchases', 'total');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('shoppers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('image'),
            Column::make('name'),
            Column::make('phone'),
            Column::make('email'),
            Column::make('purchases_count'),
            Column::make('purchases_sum_total'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('admin_created_id'),
            Column::make('admin_updated_id'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Shoppers_' . date('YmdHis');
    }
}
