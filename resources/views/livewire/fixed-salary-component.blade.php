<div>
    <div>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">FixedSalary Calculation</h1>
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

                    <div class="row mt-4">
                        <div class="col-12">
                            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Fio</th>
                                            <th>Jami ishlagan soat</th>
                                            <th>
                                                oylik miqdori
                                            </th>
                                        </tr>
                                    </thead>
                                    @php
                                    $int = 1;
                                    @endphp
                                    <tbody>
                                        @foreach($users as $user)
                                        @php
                                            $j=$this->salarycalculate($user->user_id);
                                        @endphp
                                        <tr>
                                            <th scope="row" style="padding: 5px; text-align: center;">{{$int++}}</th>
                                            <td style="padding: 5px;">{{$user->user->name}}</td>
                                            <td>{{$j}}</td>
                                            <td>{{$j}}</td>
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