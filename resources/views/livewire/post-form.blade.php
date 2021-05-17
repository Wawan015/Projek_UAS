<div>
    <label>Pilih Gambar</label><br/>
    <input type="file" wire:model="featuredImage" />
    <br/><br/>
    <label>Nama Produk</label>
    <input wire:model="title" type="text" class="form-control"/>
    @if ($errors->has('title'))
        <p style="color: red;">{{$errors->first('title')}}</p>
    @endif
    <label>Jenis</label>
    <textarea wire:model="content" type="text" class="form-control"/></textarea>
    @if ($errors->has('content'))
        <p style="color: red;">{{$errors->first('content')}}</p>
    @endif
    <label>Harga</label>
    <textarea wire:model="harga" type="text" class="form-control"/></textarea>
    @if ($errors->has('harga'))
        <p style="color: red;">{{$errors->first('harga')}}</p>
    @endif
    <br/>
    <button wire:click="save" class="btn btn-primary">Simpan</button>
   
</div>
