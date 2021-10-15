<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductsDataTable extends DataTable
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
            ->addColumn('action', function ($product) {
                return '
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="'.route('products.edit', $product->id).'" class="btn btn-xs btn-primary">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div>
                    <form method="POST" action="'.route('products.destroy', $product->id).'">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-xs btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                    </form>
                </div>';
            })
            ->editColumn('id', 'ID: {{$id}}');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProductsDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('products-table')
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
            Column::make('name'),
            Column::make('price'),
            Column::make('SKU'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::make('admin_created_id'),
            Column::make('admin_updated_id'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('align-middle'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Products_' . date('YmdHis');
    }
}
