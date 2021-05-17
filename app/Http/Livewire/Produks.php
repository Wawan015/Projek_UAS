<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Produk;
use Livewire\WithPagination;

class Produks extends Component

{
    use WithPagination;
    public $produks;
    public $action;
    public $selectedItem;


    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;
        
        if ($action == 'delete') {
            // This will show the modal on the frontend
            $this->dispatchBrowserEvent('openDeleteModal');
        } elseif ($action == 'showPhotos') {
            // Pass the currently selected item
            $this->emit('getPostId', $this->selectedItem);

            // Show the modal that shows the additional photos
            $this->dispatchBrowserEvent('openModalShowPhotos');
        }
        else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('openModal');
        }
    }

    public function delete()
    {
        Produk::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('closeDeleteModal');
    }

    public function render()
    {
        return view('livewire.produks');
    }
   
}
