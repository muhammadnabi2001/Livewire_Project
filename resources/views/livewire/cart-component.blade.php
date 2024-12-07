<div>
    {{-- Success is as dangerous as failure. --}}
    <section class="h-100 h-custom" style="background-color: #d2c9ff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0">Shopping Cart</h1>
                                            <h6 class="mb-0 text-muted">
                                                {{ session('cart') ? count(session('cart')) : 0 }} items
                                            </h6>

                                        </div>
                                        <hr class="my-4">

                                        @php
                                        $total = 0;
                                        @endphp
                                        @foreach($carts as $key=>$cart)
                                        @php
                                        $total += $cart['price'] * $cart['quantity'];
                                        @endphp

                                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                                            <div class="col-md-2 col-lg-2 col-xl-2">
                                                <img src="{{ asset('storage/' . $cart['img']) }}"
                                                    class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-3">
                                                <h6 class="text-muted">{{$cart['name']}}</h6>
                                                <h6 class="mb-0"></h6>
                                            </div>
                                            <div class="col-md-3 col-lg-3 col-xl-2">
                                                <button wire:click='take({{$key}})' class="btn btn-link px-2">
                                                    <i class="fas fa-minus"></i>
                                                </button>

                                                <input id="form1" min="0" name="quantity" value="{{$cart['quantity']}}"
                                                    type="number" class="form-control" />
                                                <button wire:click='add({{$key}})' class="btn btn-link px-2">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                <h6 class="mb-0">
                                                    @php

                                                    echo( $cart['price']*$cart['quantity'])
                                                    @endphp
                                                    so'm</h6>
                                            </div>
                                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                <a wire:click='unset({{$key}})' class="text-muted"><i
                                                        class="fas fa-times"></i></a>
                                            </div>
                                        </div>
                                        @endforeach



                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="/userpage" class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Back to
                                                    shop</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-body-tertiary">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>


                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Total price</h5>
                                            <h5>
                                                @php
                                                echo($total).' so\'m';
                                                @endphp
                                            </h5>
                                        </div>

                                        @if(session('cart') && count(session('cart')) > 0)
                                        <button wire:click='order({{$total}})' data-mdb-button-init data-mdb-ripple-init
                                            class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Buyurtma
                                            berish</button>
                                        @else
                                        <p class="btn btn-dark btn-block btn-lg">Cartga Qo'shilmagan</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>