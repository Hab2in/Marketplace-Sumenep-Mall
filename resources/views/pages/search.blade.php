@extends('layouts.app')

@section('title')
    Search Page
@endsection


@section('content')
<!-- <div class="page-content page-home">
  <section class="search-section">
    <h3>Etalase</h3>
    <p>Temukan produk kesukaan mu disini <br> dengan lebih mudah !!</p>
    <div class="search-bar">
      <input type="text" placeholder="Search">
      <button type="submit" class="btn">🔍Search</button>
    </div>
  </section>

  <section class="store-new-products mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Produk Ditemukan</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <a href="/details.html" class="component-products d-block">
            <div class="products-thumbnail">
              <div class="products-image" style="background-image: url('/images/pic-jam.jpg')"></div>
            </div>
            <div class="products-text">Jam Tangan Sakera</div>
            <div class="products-price">Rp.650000</div>
          </a>
        </div>
      </div>
    </div>
  </section>
</div> -->

<div class="page-content page-home">
  <section class="search-section">
    <h3>Etalase</h3>
    <p>Temukan produk kesukaanmu disini <br> dengan lebih mudah !!</p>
    <form action="{{ route('search') }}" method="GET" class="search-bar">
      <input type="text" name="query" value="{{ request('query') }}" placeholder="Cari produk..." />
      <button type="submit" class="btn">🔍 Cari</button>
    </form>
  </section>

  <section class="store-new-products mt-4">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Produk Ditemukan</h5>
        </div>
      </div>
      <div class="row">
        @forelse ($products as $product)
          <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('detail', $product->slug) }}" class="component-products d-block">
              <div class="products-thumbnail">
                <div 
                class="products-image" 
                style="
                  @if($product->galleries)
                    background-image: url('{{ Storage::url($product->galleries->first()->photos) }}')
                  @else
                    background-color: #eee
                  @endif
                ">
                </div>
              </div>
              <div class="products-text">{{ $product->name }}</div>
              <div class="products-price">Rp.{{ $product->price }}</div>
            </a>
          </div>
        @empty
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
            No Products Found
          </div>
        @endforelse
      </div>
    </div>
  </section>
</div>
@endsection



