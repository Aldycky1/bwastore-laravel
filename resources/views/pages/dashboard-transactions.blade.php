@extends('layouts.dashboard')

@section('title')
    Shopay Dashboard Transaction
@endsection

@section('content')
<!-- Section Content -->
<section
    class="section-content section-dashboard-home"
    data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Transactions</h2>
            <p class="dashboard-subtitle">
                Big result start from the small one
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12 mt-2">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link active"
                                id="pills-home-tab"
                                data-toggle="pill"
                                href="#pills-home"
                                role="tab"
                                aria-controls="pills-home"
                                aria-selected="true"
                                >Sell Product</a
                            >
                        </li>
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link"
                                id="pills-profile-tab"
                                data-toggle="pill"
                                href="#pills-profile"
                                role="tab"
                                aria-controls="pills-profile"
                                aria-selected="false"
                                >Buy Product</a
                            >
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="pills-home"
                            role="tabpanel"
                            aria-labelledby="pills-home-tab"
                        >
                            @foreach ($sellTransactions as $sellTransaction)
                                <a 
                                    href="{{ route('dashboard-transaction-details', $sellTransaction->id) }}" 
                                    class="card card-list d-block"
                                >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img
                                                    src="{{ Storage::url($sellTransaction->product->productGalleries->first()->photos ?? '') }}"
                                                    alt=""
                                                    class="w-50"
                                                />
                                            </div>
                                            <div class="col-md-4">
                                                {{ $sellTransaction->product->name }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $sellTransaction->product->user->store_name }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $sellTransaction->created_at }}
                                            </div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img
                                                    src="/images/dashboard-arrow-right.svg"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </a>                                
                            @endforeach
                        </div>
                        <div
                            class="tab-pane fade"
                            id="pills-profile"
                            role="tabpanel"
                            aria-labelledby="pills-profile-tab"
                        >
                            @foreach ($buyTransactions as $buyTransaction)
                                <a 
                                    href="{{ route('dashboard-transaction-details', $buyTransaction->id) }}" 
                                    class="card card-list d-block"
                                >
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-1">
                                                <img
                                                    src="{{ Storage::url($buyTransaction->product->productGalleries->first()->photos ?? '') }}"
                                                    alt=""
                                                    class="w-50"
                                                />
                                            </div>
                                            <div class="col-md-4">
                                                {{ $buyTransaction->product->name }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $buyTransaction->product->user->store_name }}
                                            </div>
                                            <div class="col-md-3">
                                                {{ $buyTransaction->created_at }}
                                            </div>
                                            <div class="col-md-1 d-none d-md-block">
                                                <img
                                                    src="/images/dashboard-arrow-right.svg"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </a>                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection