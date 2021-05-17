<div>
    <div>
        <label>Pilih Gambar</label><br/>
        <input type="file" wire:model="gambar" />
        <br/><br/>
        <label>Produk</label>
        <input wire:model="nama" type="text" class="form-control"/>
        @if ($errors->has('nama'))
            <p style="color: red;">{{$errors->first('nama')}}</p>
        @endif
        <label>Harga</label>
        <textarea wire:model="harga" type="number" class="form-control"/></textarea>
        @if ($errors->has('harga'))
            <p style="color: red;">{{$errors->first('harga')}}</p>
        @endif
        <label>Jenis</label>
        <textarea wire:model="jenis" type="text" class="form-control"/></textarea>
        @if ($errors->has('jenis'))
            <p style="color: red;">{{$errors->first('jenis')}}</p>
        @endif
        <br/>
        <button wire:click="save" class="btn btn-primary">Simpan</button>
       
    </div>
    
</div>
