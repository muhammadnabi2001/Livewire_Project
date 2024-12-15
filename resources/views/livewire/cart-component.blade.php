<div>
    {{-- Success is as dangerous as failure. --}}
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">FlashFood</a>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a wire:click="swap(null)" class="nav-link">Barchasi</a>
                    </li>

                    @foreach($categories as $category)
                    <li class="nav-item" wire:key="category-{{ $category->id }}">
                        <a wire:click="swap({{$category->id}})" class="nav-link">{{ $category->name }}</a>
                    </li>
                    @endforeach
                    <li class="nav-item">
                        <a href="carts" class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-cart2" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                            </svg>
                            <span class="badge bg-warning">{{ count(session('cart', [])) }}</span>


                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if($allow)

    <section class="ftco-section">
        <div class="container mt-3">
            <div class="row">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @foreach($meals as $meal)
                <div class="col-md-6 col-lg-4 mb-4" wire:key="meal-{{ $meal->id }}">
                    <div class="menu-wrap">
                        <div class="menus d-flex">
                            <div class="menu-img img"
                                style="background-image: url({{ asset('storage/' . $meal->img) }});"></div>
                            {{-- <img src="{{ asset('storage/' . $meal->img) }}" class="menu-img img" width="100px"
                                height="100px" alt="" style="background-image: "> --}}
                            <div class="text">
                                <div class="d-flex">
                                    <div class="one-half">
                                        <h3>{{ $meal->name }}</h3>
                                    </div>
                                    <div class="one-forth">
                                        <span class="price">{{ $meal->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="position: absolute; bottom: 10px; right: 10px;">
                            <button wire:click="addToCart({{$meal->id}})" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-cart2" viewBox="0 0 16 16">
                                    <path
                                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            <div class="mt-4">
                {{ $meals->links() }}
            </div>


        </div>


    </section>

    @endif
    @if(!$allow)

    <section class="ftco-section">
        <div class="container mt-3">
            <div class="row">
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

                                                    <div
                                                        class="row mb-4 d-flex justify-content-between align-items-center">
                                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                                            <img src="{{ asset('storage/' . $cart['img']) }}"
                                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                                            <h6 class="text-muted">{{$cart['name']}}</h6>
                                                            <h6 class="mb-0"></h6>
                                                        </div>
                                                        <div class="col-md-3 col-lg-3 col-xl-2">
                                                            <button wire:click='take({{$key}})'
                                                                class="btn btn-link px-2">
                                                                <i class="fas fa-minus"></i>
                                                            </button>

                                                            <input id="form1" min="0" name="quantity"
                                                                value="{{$cart['quantity']}}" type="number"
                                                                class="form-control" readonly />
                                                            <button wire:click='add({{$key}})'
                                                                class="btn btn-link px-2">
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
                                                    <button wire:click='order({{$total}})' data-mdb-button-init
                                                        data-mdb-ripple-init class="btn btn-dark btn-block btn-lg"
                                                        data-mdb-ripple-color="dark">Buyurtma
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


    </section>
    @endif
</div>