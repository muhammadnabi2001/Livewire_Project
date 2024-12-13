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
                @if(!$allow && !$kurish)

                <div class="row mb-2">
                    <div class="col-sm-6 mt-2">
                        <button class="btn btn-primary m-2" wire:click="{{ $check ? 'Back' : 'Create'}}"> {{ $check ?
                            'Back' : 'Create'}} </button>
                    </div>
                </div>

                @endif
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @if($check)

                <div class="row">
                    <div class="col-5">
                        <div class="table-responsive">
                            <form wire:submit.prevent='store' enctype="multipart/form-data">
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
                                </div>
                                @error('img')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                @if ($img)
                                <div class="mt-2">
                                    <img src="{{ $img->temporaryUrl() }}" alt="Meal Image" class="img-fluid mt-2"
                                        style="max-width: 200px;">
                                </div>
                                @endif
                                <div class="mb-3">
                                    <label class="form-label">Oyli Midqor</label>
                                    <input type="number" class="form-control" wire:model.blur="oylik_miqdor">
                                    @error('oylik_miqdor')
                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bonus</label>
                                    <input type="text" class="form-control" wire:model.blur="bonus">
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
                                    <button type="submit" class="btn btn-primary mt-3">Create</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>


                @endif
                @if(!$allow && !$kurish)
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if(!$check)
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%;">#</th>
                                        <th scope="col" style="width: 5%;">Name</th>
                                        <th scope="col" style="width: 5%;">Bulim</th>

                                        <th scope="col" style="width: 5%;">Rasm</th>
                                        <th scope="col" style="width: 10%;">Option</th>
                                    </tr>
                                </thead>
                                <tbody wire:sortable='updateGroup'>
                                    @foreach($hodimlar as $hodim)
                                    <tr draggable="true" wire:sortable.handle="{{ $hodim->id }}">
                                        <th scope="row" style="white-space: nowrap;">{{ ($hodimlar->currentPage() - 1) * $hodimlar->perPage() + $loop->iteration }}</th>

                                        <td>{{ $hodim->user->name }}</td>
                                        <td>{{ $hodim->bulim->name }}</td>

                                        <td>
                                            <img src="{{ asset('storage/' . $hodim->img) }}" alt="Meal Image"
                                                width="100px" height="100px">
                                        </td>
                                        <td>
                                            <a wire:click="change({{ $hodim->id }})" class="btn btn-warning"
                                                draggable="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path
                                                        d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
                                                </svg>
                                            </a>
                                            <a wire:click="delete({{ $hodim->id }})" class="btn btn-danger"
                                                draggable="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                                </svg>
                                            </a>
                                            <a wire:click="observe({{$hodim->id}})" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                              </svg></a>
                                        </td>
                                    </tr>

                                    @if($allow == $hodim->id)

                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{$hodimlar->links()}}
                            @endif
                        </div>

                    </div>

                </div>
                @endif
                @if($allow)

                <div class="row">
                    <div class="col-5">
                        <div class="table-responsive">
                            <form wire:submit.prevent='edit' enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Users</label>
                                    <select class="form-control" wire:model="edituser_id">
                                        <option value="" disabled selected>Select a User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('edituser_id')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Bulimlar</label>
                                    <select class="form-control" wire:model="editbulim_id">
                                        <option value="" disabled selected>Select a Bulim</option>
                                        @foreach($bulims as $bulim)
                                        <option value="{{ $bulim->id }}">{{ $bulim->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('editbulim_id')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Oylik Turi</label>
                                    <select class="form-control" wire:model="editoylik_type">
                                        <option value="" disabled selected>Select a Oylik Type</option>
                                        <option value="fixed">fixed</option>
                                        <option value="mixed">mixed</option>
                                    </select>
                                </div>
                                @error('editoylik_type')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Rasm</label>
                                    <input type="file" class="form-control" wire:model.blur="editimg">
                                </div>
                                @error('editimg')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                                @enderror
                                <div class="mb-3">
                                    <label class="form-label">Oyli Midqor</label>
                                    <input type="number" class="form-control" wire:model.blur="editoylik_miqdor">
                                    @error('editoylik_miqdor')
                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bonus</label>
                                    <input type="text" class="form-control" wire:model.blur="editbonus">
                                    @error('editbonus')
                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Start Time</label>
                                    <input type="time" class="form-control" wire:model.blur="editstart_time">

                                    @error('editstart_time')
                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">End Time</label>
                                    <input type="time" class="form-control" wire:model.blur="editend_time">

                                    @error('editend_time')
                                    <span class="text-danger d-block mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Update</button>
                            </form>
                            <button wire:click='nazad' class="btn btn-warning mt-3">Back</button>
                        </div>
                    </div>
                </div>

                @endif


                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if($kurish)
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 1%;">#</th>
                                        <th scope="col" style="width: 5%;">Name</th>
                                        <th scope="col" style="width: 5%;">Bulim</th>

                                        <th scope="col" style="width: 5%;">Rasm</th>
                                        <th scope="col" style="width: 10%;">Ishni Boshlash</th>
                                        <th scope="col" style="width: 10%;">Ishni Tugatish</th>
                                        <th scope="col" style="width: 10%;">Kunlik Soat</th>
                                        <th scope="col" style="width: 10%;">Oylik</th>
                                        <th scope="col" style="width: 10%;">Oylik Turi</th>
                                        <th scope="col" style="width: 10%;">Bonus</th>
                                    </tr>
                                </thead>
                                <tbody wire:sortable='updateGroup'>
                                    <tr draggable="true">
                                        <th scope="row" style="white-space: nowrap;">{{$detail->id}}</th>

                                        <td>{{$detail->user->name}}</td>
                                        <td>{{$detail->bulim->name}}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $detail->img) }}" alt="Meal Image"
                                                width="100px" height="100px">
                                        </td>
                                        <td>
                                            {{$detail->start_time}}
                                        </td>
                                        <td>
                                            {{$detail->end_time}}
                                        </td>
                                        <td>
                                            {{$detail->kunlik_time}}
                                        </td>
                                        <td>
                                            {{$detail->oylik_miqdor}}
                                        </td>
                                        <td>
                                            {{$detail->oylik_type}}
                                        </td>
                                        <td>
                                            {{$detail->bonus}}
                                        </td>
                                     
                                    </tr>

                                </tbody>
                            </table>
                            <div class="mb-3">
                                <input class="btn btn-warning mt-3" value="Back" wire:click="restore">
                            </div>
                            @endif
                        </div>

                    </div>

                </div>



            </div>
        </section>
    </div>

</div>