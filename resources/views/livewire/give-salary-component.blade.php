<div>
    <div>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">GiveSalary Calculation</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">

                    <input type="date" class="form-control" wire:change='day' wire:model="select">

                    <div class="row mt-4">
                        <h1>{{$now}}</h1>
                    </div>
                    <!-- Alert Box for Error -->
                    <!-- Xatolik bo'lsa, yuqori qismda alert ko'rsatiladi -->
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif


                    <div class="row mt-4">
                        <div class="col-12">
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fio</th>
                                            <th>fixed</th>
                                            <th>Jami ishlagan soat</th>
                                            
                                            <th>Berilgan</th>
                                            <th>Qolgani</th>
                                            <th>Bonus</th>
                                            <th>Oylik berish</th>

                                        </tr>
                                    </thead>
                                    @php
                                    $int = 1;
                                    @endphp
                                    <tbody>
                                        @foreach($users as $user)
                                        @php
                                        $j=$this->salarycalculate($user);
                                        @endphp
                                        <tr>
                                            <th scope="row" style="padding: 5px; text-align: center;">{{$int++}}</th>
                                            <td style="padding: 5px;">{{$user->user->name}}</td>
                                            <td>{{$user->oylik_miqdor}}</td>
                                            <td>{{number_format($j['total_worked_hours'])}} soat</td>
                                            @php
                                                $calc=$this->count($user);
                                               
                                            @endphp
                                            @php
                                                 $bonus=$this->bonus($user);
                                            @endphp
                                            <td>{{number_format($calc['berilgan'])}}</td>
                                            <td>{{number_format($calc['qolgan'])}}</td>
                                            <td>{{number_format($bonus['bonus'])}}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal{{$user->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-send-check-fill"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z" />
                                                        <path
                                                            d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686" />
                                                    </svg>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel{{$user->id}}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5"
                                                                    id="exampleModalLabel{{$user->id}}">
                                                                    Modal title</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form wire:submit.prevent='give({{$user->id}})'>
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputEmail1{{$user->id}}"
                                                                            class="form-label">Oylik summa</label>
                                                                        <input type="text" class="form-control"
                                                                            id="exampleInputEmail1{{$user->id}}"
                                                                            aria-describedby="emailHelp"
                                                                            wire:model='summa'>
                                                                        @error('summa')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>


                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Give
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>


                            </div>


                        </div>
                    </div>

                </div>
            </section>
        </div>


    </div>
</div>