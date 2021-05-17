<div>    
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">
        Tambah Item
    </button>
    
    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Simpan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('post-form')
                </div>            
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalFormDelete" tabindex="-1" aria-labelledby="modalFormDeletePost" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormDeletePost">Hapus Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Kamu yakin Untuk Menghapus Item Ini ? </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button wire:click="delete" type="button" class="btn btn-primary">Hapus</button>
            </div>
            </div>
        </div>
    </div>

    <div>
        <br />
        @if ($posts->count())
            <table class="table table-striped">
                <thead>
                    
                    <th>Nama Produk</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th width="30%">Actions</th>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr>
                           
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->harga }}</td>

                            <td>
                                @if (!empty($item->featured_image))
                                    <img width="100px" src="{{ url('storage/photos_thumb/'. $item->featured_image) }}" />
                                @else
                                    No featured image available!
                                @endif
                            </td>
                            <td>
                                <button wire:click="selectItem({{ $item->id }}, 'update')" class="btn btn-sm btn-success">Edit</button>
                                <button wire:click="selectItem({{ $item->id }}, 'delete')" class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $posts->links()}}
        @endif
    </div>    
</div>
