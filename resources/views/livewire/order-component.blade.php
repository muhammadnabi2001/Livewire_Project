<div>
    <div class="content-wrapper kanban">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>All Orders</h1>
                    </div>

                </div>
            </div>
        </section>
        <section class="content pb-3">
            <div class="container-fluid h-100">
                <div class="card card-row card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Buyurtmalar
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach($orders as $order)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">{{$order->queue}}-Navbat</h5>
                                <div class="card-tools">
                                    <a wire:click="show({{$order->id}})" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            @if($permission == $order->id)
                            <div class="card-body">
                                @foreach($order->orderItems as $orderItem)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox"
                                        id="customCheckbox1{{$orderItem->id}}" disabled>
                                    <label for="customCheckbox1{{$orderItem->id}}" class="custom-control-label">
                                        {{$orderItem->meal->name}} {{$orderItem->count}} ta
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button wire:click="accept({{$order->id}})" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Qabul qilish
                                </button>
                            </div>
                            @endif
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="card card-row card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Jarayonda
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach($jarayonda as $jarayon)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">{{$jarayon->queue}}-Navbat</h5>
                                <div class="card-tools">
                                    <a wire:click="ruxsat({{$jarayon->id}})" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            @if($allow == $jarayon->id)
                            <div class="card-body">
                                @foreach($jarayon->orderItems as $orderItem)
                                <div class="custom-control custom-checkbox">
                                    <input wire:click="done({{$orderItem->id}})" class="custom-control-input"
                                        type="checkbox" id="customCheckbox1{{$orderItem->id}}" @if($orderItem->status ==
                                    3) checked @endif>
                                    <label for="customCheckbox1{{$orderItem->id}}" class="custom-control-label">
                                        {{$orderItem->meal->name}} {{$orderItem->count}} ta
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card card-row card-default">
                    <div class="card-header bg-info">
                        <h3 class="card-title">
                            Tayyor
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach($tayyor as $t)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">{{$t->queue}}-Navbat</h5>
                                <div class="card-tools">
                                    <a wire:click="consent({{$t->id}})" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            @if($tayyorpermit == $t->id)
                            <div class="card-body">
                                @foreach($t->orderItems as $orderItem)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox"
                                        id="customCheckbox1{{$orderItem->id}}" disabled>
                                    <label for="customCheckbox1{{$orderItem->id}}" class="custom-control-label">
                                        {{$orderItem->meal->name}} {{$orderItem->count}} ta
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button wire:click="topshirish({{$t->id}})" class="btn btn-success btn-sm">
                                    <i class="fas fa-check"></i> Afisantga Topshirish
                                </button>
                            </div>
                            @endif
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="card card-row card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Afisantga Topshirilgan
                        </h3>
                    </div>
                    <div class="card-body">
                        @foreach($topshirilgan as $topshir)
                        <div class="card card-info card-outline">
                            <div class="card-header">
                                <h5 class="card-title">{{$topshir->queue}}-Navbat</h5>
                                <div class="card-tools">
                                    <a wire:click="see({{$topshir->id}})" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>

                            @if($licence == $topshir->id)
                            <div class="card-body">
                                @foreach($topshir->orderItems as $orderItem)
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox"
                                        id="customCheckbox1{{$orderItem->id}}" disabled>
                                    <label for="customCheckbox1{{$orderItem->id}}" class="custom-control-label">
                                        {{$orderItem->meal->name}} {{$orderItem->count}} ta
                                    </label>
                                </div>
                                @endforeach
                            </div>

                            @endif
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
    </div>
</div>