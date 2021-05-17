<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Produk;
use App\AdditionalPhotos;
use Intervention\Image\ImageManager;

class ProdukForm extends Component
{
    use WithFileUploads;

    public $nama;
    public $harga;
    public $jenis;
    public $gambar;
   

    protected $listeners = [
        'getModelId',
        'forcedCloseModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Produk::find($this->modelId);
        
        $this->nama = $model->nama;
        $this->harga = $model->harga;
        $this->jenis = $model->jenis;
       // $this->gambar = $model->gambar;

    }

    public function save()
    {   
        // Data validation
        $validateData = [
            'nama' => 'required',
            'harga' => 'required',
            'jenis' => 'required',
        ];

        // Default data
        $data = [
            'nama' => $this->nama,
            'harga' => $this->harga,
            'jenis' => $this->jenis,
            
        ];

        if (!empty($this->gambar)) {
            $imageHashName = $this->gambar->hashName();

            // Append to the validation if image is not empty
            $validateData = array_merge($validateData, [
                'gambar' => 'image'
            ]);
            
            // This is to save the filename of the image in the database
            $data = array_merge($data, [
                'gambar_image' => $imageHashName
            ]);
            
            // Upload the main image
            $this->gambar->store('public/photos');

            // Create a thumbnail of the image using Intervention Image Library
            $manager = new ImageManager();
            $image = $manager->make('storage/photos/'.$imageHashName)->resize(300, 200);
            $image->save('storage/photos_thumb/'.$imageHashName);
        }
        $this->validate($validateData);

        if ($this->modelId) {
            Produk::find($this->modelId)->update($data);
            $postInstanceId = $this->modelId;
        } else {            
            $postInstance = Produk::create($data);
            $postInstanceId = $postInstance->id;
        }

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeModal');
        $this->cleanVars();
    }

    public function forcedCloseModal()
    {
        // This is to reset our public variables
        $this->cleanVars();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }

    private function cleanVars()
    {
        $this->modelId = null;
        $this->nama = null;
        $this->harga = null;
        $this->jenis = null;
        $this->gambar = null;
       
    }
    public function render()
    {
        return view('livewire.produk-form');
    }
}
