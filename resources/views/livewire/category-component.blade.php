<div>
    {{-- Stop trying to control. --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">category</h1>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 mt-2">
                        <button class="btn btn-primary m-2" wire:click="{{ $check ? 'Back' : 'Create'}}"> {{ $check ?
                            'Back' : 'Create'}} </button>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @if($check)

                <div class="row">
                    <div class="col-5">
                        <div class="table-responsive">
                            <form wire:submit.prevent='store'>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" wire:model.blur="name">
                                    @error('name')
                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if(!$check)
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 10%;">#</th>
                                        <th scope="col" style="width: 70%;">Name</th>
                                        <th scope="col" style="width: 20%;">Option</th>
                                    </tr>
                                </thead>
                                <tbody wire:sortable='updateGroup'>
                                    @foreach($categories as $category)
                                    @if($allow != $category->id)
                                    <tr draggable="true" wire:sortable.item="{{ $category->id }}">
                                        <th scope="row" style="white-space: nowrap;">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <a wire:click="change({{ $category->id }})" class="btn btn-warning"
                                                draggable="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path
                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                                </svg>
                                            </a>
                                            <a wire:click="delete({{ $category->id }})" class="btn btn-danger"
                                                draggable="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif

                                    @if($allow == $category->id)
                                    <tr>
                                        <td style="white-space: nowrap;">{{ $category->id }}</td>
                                        <td>
                                            <input type="text" class="form-control" style="max-width: 100%;"
                                                wire:model.blur="editname">
                                            @error('editname')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            <button class="btn btn-success" type="submit" wire:click='edit'>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{$categories->links()}}
                            @endif
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
</div>