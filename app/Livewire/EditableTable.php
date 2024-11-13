<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class EditableTable extends Component
{
    public $rows = [];

    public function mount()
    {

        $this->rows = Cache::get('editable_table_rows', [
            ['alpine_input' => '', 'input' => '']
        ]);

        dd($this->rows);
    }

    public function addRow()
    {
        $this->rows[] = [
            'alpine_input' => '', 'input' => ''
        ];

        Cache::put('editable_table_rows', $this->rows);
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);

        Cache::put('editable_table_rows', $this->rows);
    }

    public function save()
    {
        Cache::put('editable_table_rows', $this->rows);

//        dd(Cache::get('editable_table_rows'));
    }

    public function render()
    {
        return view('livewire.editable-table');
    }
}
