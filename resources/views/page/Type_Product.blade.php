@extends('master')
@section('content')
    <div class="inner-header">
        <div class="container">
            <div class="pull-left">
                <h6 class="inner-title">{{$typeName->name}}</h6>
            </div>
            <div class="pull-right">
                <div class="beta-breadcrumb font-large">
                    <a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Loại sản phẩm</span>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="container">
        <div id="content" class="space-top-none">
            <div class="main-content">
                <div class="space60">&nbsp;</div>
                <div class="row">
                    <div class="col-sm-3">
                        <ul class="aside-menu">
                            @foreach ($productType as $item)

                            <li><a href="{{route('loai-san-pham',$item->id)}}">{{$item->name}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-sm-9">
                        <div class="beta-products-list">
                            <h4>Sản phẩm mới</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{ $productOthers->total() }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>

                            <div class="row">
                                @foreach ($productByType as $item)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                <a href="{{route('chi-tiet-san-pham',$item->id)}}"><img src="source/image/product/{{ $item->image }}"
                                                        alt=""></a>
                                            </div>
                                            @if ($item->unit_price > $item->promotion_price && $item->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $item->name }}</p>
                                                <p class="single-item-price">
                                                    @if ($item->unit_price > $item->promotion_price)
                                                        <span class="flash-del">{{ number_format($item->unit_price) }}
                                                            VND</span>
                                                        <span class="flash-sale">{{ number_format($item->promotion_price) }}
                                                            VND</span>
                                                    @else
                                                        <span class="flash-sale">{{ number_format($item->unit_price) }}
                                                            VND</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{route('chi-tiet-san-pham',$item->id)}}">Details <i
                                                        class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div> <!-- .beta-products-list -->

                        <div class="space50">&nbsp;</div>

                        <div class="beta-products-list">
                            <h4>Sản phẩm khác</h4>
                            <div class="beta-products-details">
                                <p class="pull-left">Tìm thấy {{ $productOthers->total() }} sản phẩm</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="row">
                                @foreach ($productOthers as $item)
                                    <div class="col-sm-4">
                                        <div class="single-item">
                                            <div class="single-item-header">
                                                <a href="product.html"><img src="source/image/product/{{ $item->image }}"
                                                        alt=""></a>
                                            </div>
                                            @if ($item->unit_price > $item->promotion_price && $item->promotion_price != 0)
                                                <div class="ribbon-wrapper">
                                                    <div class="ribbon sale">Sale</div>
                                                </div>
                                            @endif
                                            <div class="single-item-body">
                                                <p class="single-item-title">{{ $item->name }}</p>
                                                <p class="single-item-price">
                                                    @if ($item->unit_price > $item->promotion_price && $item->promotion_price != 0)
                                                        <span class="flash-del">{{ number_format($item->unit_price) }}
                                                            VND</span>
                                                        <span
                                                            class="flash-sale">{{ number_format($item->promotion_price) }}
                                                            VND</span>
                                                    @else
                                                        <span class="flash-sale">{{ number_format($item->unit_price) }}
                                                            VND</span>
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="single-item-caption">
                                                <a class="add-to-cart pull-left" href="shopping_cart.html"><i
                                                        class="fa fa-shopping-cart"></i></a>
                                                <a class="beta-btn primary" href="{{ route('chi-tiet-san-pham') }}">Details
                                                    <i class="fa fa-chevron-right"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">{{ $productOthers->links() }}</div>
                            <div class="space40">&nbsp;</div>

                        </div> <!-- .beta-products-list -->
                    </div>
                </div> <!-- end section with sidebar and main content -->


            </div> <!-- .main-content -->
        </div> <!-- #content -->
    </div>
@endsection
