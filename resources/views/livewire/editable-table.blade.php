<div x-data="{
    rows: @entangle('rows').defer,
    addRow() {
        $wire.addRow().then(() => {
            this.rows = $wire.get('rows'); // Обновляем данные из Livewire вручную
        });
    },
    removeRow(index) {
        $wire.removeRow(index).then(() => {
            this.rows = $wire.get('rows'); // Обновляем данные из Livewire вручную
        });
    }
}">
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
        <tr>
            <th class="border px-4 py-2">№</th>
            <th class="border px-4 py-2">Alpine Component Input</th>
            <th class="border px-4 py-2">Input</th>
            <th class="border px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        <template x-for="(row, index) in rows" :key="index">
            <tr>
                <td class="border px-4 py-2" x-text="index + 1"></td>
                <td class="border px-4 py-2">
                    <input type="text" class="w-full px-2 py-1" x-model="row.alpine_input">
                </td>
                <td class="border px-4 py-2">
                    <input type="text" class="w-full px-2 py-1" x-model="row.input">
                </td>
                <td class="border px-4 py-2">
                    <button class="bg-red-500 text-white px-2 py-1 rounded" @click="removeRow(index)">Удалить</button>
                </td>
            </tr>
        </template>
        </tbody>
    </table>

    <div class="mt-4">
        <button class="bg-blue-500 text-white px-4 py-2 rounded" @click="addRow()">ДОБАВИТЬ СТРОКУ</button>
        <button class="bg-green-500 text-white px-4 py-2 rounded" wire:click="save">SAVE</button>
    </div>
</div>
