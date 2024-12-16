<div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/navbat">Navbatlar</a>
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
    <section class="ftco-section">
        <div class="container mt-3">
            <div class="row">



                @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
    
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        });
                </script>
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
</div>