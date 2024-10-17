@extends('layouts.dashboard')

@section('title')
    Dashboard Transaction Page
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
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
          <ul
            class="nav nav-pills mb-3"
            id="pills-tab"
            role="tablist"
          >
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
              @foreach ($sellTransactions as $transaction)
                <a
                  href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                  class="card card-list d-block"
                >
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img
                          src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                          class="w-50"
                        />
                      </div>
                      <div class="col-md-4">
                        {{ $transaction->product->name }}
                      </div>
                      <div class="col-md-3">
                        {{ $transaction->product->user->store_name }}
                      </div>
                      <div class="col-md-3">
                        {{ $transaction->created_at }}
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
              @foreach ($buyTransactions as $transaction)
                <a
                  href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                  class="card card-list d-block"
                >
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img
                          src="{{ Storage::url($transaction->product->galleries->first()->photos ?? '') }}"
                          class="w-50"
                        />
                      </div>
                      <div class="col-md-4">
                        {{ $transaction->product->name }}
                      </div>
                      <div class="col-md-3">
                        {{ $transaction->product->user->store_name }}
                      </div>
                      <div class="col-md-3">
                        {{ $transaction->created_at }}
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
</div>
<!-- <div class="section-content section-dashboard-home" data-aos="fade-up">
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
          <ul class="nav nav-pills" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="sell-tab" data-toggle="tab" href="#sell" role="tab"
                aria-controls="sell" aria-selected="true">Sell Product</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="buy-tab" data-toggle="tab" href="#buy" role="tab" aria-controls="buy"
                aria-selected="false">Buy Product</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="sell" role="tabpanel" aria-labelledby="sell-tab">
              <div class="row mt-3">
                <div class="col-12 mt-2">
                  <a href="/dashboard-transactions-details.html" class="card card-list card-block">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-1">
                          <img src="/images/dashboard-icon-product-1.png" alt="">
                        </div>
                        <div class="col-md-4">
                          Kopi Madura
                        </div>
                        <div class="col-md-3">
                          Upin Ipin
                        </div>
                        <div class="col-md-3">
                          12 Juni, 2024
                        </div>
                        <div class="col-md-1 d-none d-md-block">
                          <img src="/images/dashboard-arrow-right.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="/dashboard-transactions-details.html" class="card card-list card-block">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-1">
                          <img src="/images/dashboard-icon-product-2.png" alt="">
                        </div>
                        <div class="col-md-4">
                          Sepatu Kulit Sapi
                        </div>
                        <div class="col-md-3">
                          Mail
                        </div>
                        <div class="col-md-3">
                          14 Mei, 2024
                        </div>
                        <div class="col-md-1 d-none d-md-block">
                          <img src="/images/dashboard-arrow-right.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </a>
                  <a href="/dashboard-transactions-details.html" class="card card-list card-block">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-1">
                          <img src="/images/dashboard-icon-product-3.png" alt="">
                        </div>
                        <div class="col-md-4">
                          Bantal Bulu Ayam
                        </div>
                        <div class="col-md-3">
                          Kak Rose
                        </div>
                        <div class="col-md-3">
                          14 Februari, 2024
                        </div>
                        <div class="col-md-1 d-none d-md-block">
                          <img src="/images/dashboard-arrow-right.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="buy" role="tabpanel" aria-labelledby="buy-tab">
              <div class="row mt-3">
                <div class="col-12 mt-2">
                  <a href="/dashboard-transactions-details.html" class="card card-list card-block">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-1">
                          <img src="/images/dashboard-icon-product-3.png" alt="">
                        </div>
                        <div class="col-md-4">
                          Bantal Bulu Ayam
                        </div>
                        <div class="col-md-3">
                          Kak Rose
                        </div>
                        <div class="col-md-3">
                          14 Februari, 2024
                        </div>
                        <div class="col-md-1 d-none d-md-block">
                          <img src="/images/dashboard-arrow-right.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> -->
@endsection