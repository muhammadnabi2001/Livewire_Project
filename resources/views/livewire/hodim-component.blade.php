<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Hodimlar</h1>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6 mt-2">
                        <button class="btn btn-primary m-2" wire:click="{{ $check ? 'Back' : 'Create'}}"> {{ $check ? 'Back' : 'Create'}} </button>
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
                                    <label class="form-label">Users</label>
                                    <select class="form-control" wire:model="user_id">
                                        <option value="" disabled selected>Select a User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                @error('user_id')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Bulimlar</label>
                                    <select class="form-control" wire:model="bulim_id">
                                        <option value="" disabled selected>Select a Bulim</option> 
                                        @foreach($bulims as $bulim)
                                        <option value="{{ $bulim->id }}">{{ $bulim->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('bulim_id')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Oylik Turi</label>
                                    <select class="form-control" wire:model="oylik_type">
                                        <option value="" disabled selected>Select a Oylik Type</option> 
                                        <option value="fixed">fixed</option>
                                        <option value="mixed">mixed</option>
                                    </select>
                                </div>
                                @error('oylik_type')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Rasm</label>
                                    <input type="file" class="form-control" wire:model.blur="img">

                                    @error('img')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                @error('img')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Oyli Midqor</label>
                                    <input type="number" class="form-control" wire:model.blur="oylik_miqdor">
                                    @error('oylik_miqdor')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bonus</label>
                                    <input type="number" class="form-control" wire:model.blur="bonus">
                                    @error('bonus')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" class="form-control" wire:model.blur="start_time">

                                    @error('start_time')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="time" class="form-control" wire:model.blur="end_time">

                                    @error('end_time')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kunlik Time</label>
                                    <input type="time" class="form-control" wire:model.blur="kunlik_time">

                                    @error('kunlik_time')
                                        <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Oylik Time</label>
                                    <input type="time" class="form-control" wire:model.blur="oylik_time">

                                    @error('oylik_time')
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
                                        <th scope="col" style="width: 5%;">Name</th>
                                        <th scope="col" style="width: 5%;">Bulim</th>
                                        <th scope="col" style="width: 5%;">Oylik Turi</th>
                                        <th scope="col" style="width: 5%;">Oylik Miqdori</th>
                                        <th scope="col" style="width: 5%;">Rasm</th>
                                        <th scope="col" style="width: 20%;">Option</th>
                                    </tr>
                                </thead>
                                <tbody wire:sortable='updateGroup'>
                                    @foreach($hodimlar as $hodim)
                                        @if($allow != $hodim->id)
                                        <tr draggable="true" wire:sortable.item="{{ $hodim->id }}">
                                            <th scope="row" style="white-space: nowrap;">{{ $hodim->id }}</th>
                                            <td>{{ $hodim->user->name }}</td>
                                            <td>{{ $hodim->bulim->name }}</td>
                                            <td>{{ $hodim->oylik_type }}</td>
                                            <td>{{ $hodim->oylik_miqdor }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $hodim->img) }}" alt="Meal Image" width="100px" height="100px">
                                            </td>
                                            <td>
                                                <a wire:click="change({{ $hodim->id }})" class="btn btn-warning" draggable="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                                                    </svg>
                                                </a>
                                                <a wire:click="delete({{ $hodim->id }})" class="btn btn-danger" draggable="false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        @endif  
                        
                                        @if($allow == $hodim->id)
                                        <tr>
                                            <td style="white-space: nowrap;">{{ $hodim->id }}</td>
                                            <td>
                                                <input type="text" class="form-control" style="max-width: 100%;" wire:model.blur="editname">
                                                @error('editname') 
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button class="btn btn-success" type="submit" wire:click='edit'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{$hodimlar->links()}}
                            @endif
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
    
</div>
