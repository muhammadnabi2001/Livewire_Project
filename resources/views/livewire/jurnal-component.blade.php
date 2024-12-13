<div>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Jurnal</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
            @if($permit)
                
            <div class="row">
                <div class="col-5">
                    <div class="table-responsive">
                        <form wire:submit.prevent='store'>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" wire:model.blur="name" disabled>
                                @error('name')
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
                        <button wire:click="back" class="btn btn-warning mt-3">Back</button>
                    </div>
                </div>
            </div>
                
            @endif
            @if(!$permit)
                
                
                <input type="date" class="form-control" wire:change='day' wire:model="select">

                <div class="row mt-4">
                    <h1>{{$now}}</h1>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <table class="table table-bordered" style="table-layout: fixed; width: 100%; word-wrap: break-word;">
                                <thead>
                                    <tr>
                                        <th style="width: 30px; padding: 5px;">Id</th>
                                        <th style="width: 150px; padding: 5px;">Fio</th>
                                        @foreach($days as $day)
                                            <th style="width: 50px; padding: 5px; word-wrap: break-word; white-space: normal; text-align: center;">
                                                {{$day}}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                @php
                                $int = 1;
                                @endphp
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row" style="padding: 5px; text-align: center;">{{$int++}}</th>
                                            <td style="padding: 5px;">{{$user->name}}</td>
                                            @foreach($days as $day)
                                                @php
                                                $jurnal = $this->checkJurnal($user->id, $day);
                                                @endphp
                                                <td style="text-align: center; padding: 5px;">
                                                    <button wire:click="plus({{$user->id}},{{$day}})" class="btn btn-sm 
                                                        {{$jurnal ? ($jurnal->hodim && $jurnal->hodim->kunlik_time && $jurnal->time < $jurnal->hodim->kunlik_time ? 'btn-danger' : 'btn-primary') : 'btn-light'}}"
                                                        style="width: 100%; height: 30px; padding: 2px; overflow: visible; white-space: nowrap; font-size: 12px;"  data-bs-toggle="tooltip" 
                                                        title="@if($user->hodim) start_time: {{ $user->hodim->start_time }} | end_time: {{ $user->hodim->end_time }} @else Hodim mavjud emas @endif">
                                                        {{$jurnal ? $jurnal->time : '-'}}
                                                        {{$jurnal ? ($jurnal->hodim && $jurnal->hodim->start_time >= $jurnal->start_time ? '+' : '-') : ''}}


                                                    </button>
                                                    
                                                    
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            
                            
                        </div>

                       
                    </div>
                </div>
                @endif
                
            </div>
        </section>
    </div>


</div>