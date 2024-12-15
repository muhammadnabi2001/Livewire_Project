<div>
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
    <section class="ftco-section">
        <div class="container mt-3">
            <div class="row">
                <!-- Backlog Column -->
                <div class="col-md-4">
                    <div class="card card-row card-secondary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Progress</h3>
                        </div>
                            
                        <div class="card-body">  
                        @foreach($jarayonda as $jarayon)

                            <div class="card card-primary card-outline">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">{{$jarayon->queue}}-Navbat</h5>
                                    <div class="card-tools">
                                        <a wire:click="show({{$jarayon->id}})" class="btn btn-tool">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    @if($permission == $jarayon->id)
                                    @foreach($jarayon->orderItems as $item)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                                        <label for="customCheckbox1_1" class="custom-control-label">{{$item->meal->name}}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        </div>
                    </div>
                </div>
                
    
                <!-- To Do Column -->
                <div class="col-md-4">
                    <div class="card card-row card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Yakunlandi</h3>
                        </div>
                        <div class="card-body">
                            @foreach($tayyor as $t)

                            <div class="card card-primary card-outline">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">{{$t->queue}}-Navbat</h5>
                                    <div class="card-tools">
                                        <a wire:click="ruxsat({{$t->id}})" class="btn btn-tool">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    @if($allow == $t->id)
                                    @foreach($t->orderItems as $item)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                                        <label for="customCheckbox1_1" class="custom-control-label">{{$item->meal->name}}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
    
                <!-- In Progress Column -->
                <div class="col-md-4">
                    <div class="card card-row card-default">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Ofitsantda</h3>
                        </div>
                        <div class="card-body">
                            @foreach($topshirilgan as $topshir)

                            <div class="card card-primary card-outline">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">{{$topshir->queue}}-Navbat</h5>
                                    <div class="card-tools">
                                        <a wire:click="see({{$topshir->id}})" class="btn btn-tool">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="card-body">
                                    @if($licence == $topshir->id)
                                    @foreach($topshir->orderItems as $item)
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                                        <label for="customCheckbox1_1" class="custom-control-label">{{$item->meal->name}}</label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
    
                <!-- Done Column -->

    
            </div>
        </div>
    </section>
    
    
    
</div>