@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Products</h1>
</div>


<div class="card">
    <form action="/searched-products" method="post" class="card-header">
        @csrf
        <div class="form-row justify-content-between">
            <div class="col-md-2">
                <input type="text" name="title" placeholder="Product Title" class="form-control">
            </div>
            <div class="col-md-2">
                <select name="variant" id="" class="form-control">
                    @foreach($Products as $key=>$product)
                    @foreach($product->product_variants as $key=>$product_variant)
                    @foreach($product_variant->Variants as $variant)
                    <option>{{$variant->title}}</option>
                    @endforeach
                    @endforeach
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Price Range</span>
                    </div>
                    <input type="text" name="price_from" aria-label="First name" placeholder="From"
                        class="form-control">
                    <input type="text" name="price_to" aria-label="Last name" placeholder="To" class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <input type="date" name="date" placeholder="Date" class="form-control">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>

    <div class="card-body">
        <div class="table-response">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Variant</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($Products as $key=>$product)

                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{ $product->title }} <br> <small>Created at :
                                {{ date('d-m-Y', strtotime($product->updated_at)) }}</small>
                        </td>
                        <td>{{ $product->description }}</td>
                        <td>
                            <dl class="row mb-0" style="height: 80px; overflow: hidden" id="variant">

                                <dt class="col-sm-3 pb-0">
                                    @foreach($product->product_variants as $key=>$product_variant)

                                    @foreach($product_variant->Variants as $variant)

                                    <small> {{$variant->title}} </small>
                                    @if(!$loop->last)
                                    <br />
                                    @endif

                                    @endforeach

                                </dt>
                                <dd class="col-sm-9">
                                    <dl class="row mb-0">
                                        <dt class="col-sm-4 pb-0"> <small> Price : {{ number_format(200,2) }} </small>
                                        </dt>
                                        <dd class="col-sm-8 pb-0"> <small>InStock : 50 </small></dd>
                                    </dl>
                                </dd>

                                @endforeach

                            </dl>
                            <button onclick="$('#variant').toggleClass('h-auto')" class="btn btn-sm btn-link">Show
                                more</button>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('product.edit', 1) }}" class="btn btn-success">Edit</a>
                            </div>
                        </td>
                    </tr>

                    @endforeach

                </tbody>

            </table>
            <div class="row">{{$Products->links()}}</div>
        </div>

    </div>

    <div class="card-footer">
        <div class="row justify-content-between">
            <div class="col-md-6">
                <p>Showing {{($Products->currentpage()-1)*$Products->perpage()+1}} to
                    {{ $Products->currentpage()*(($Products->perpage() < $Products->total()) ? $Products->perpage(): $Products->total())}}
                    out of {{ $Products->total() }}
                </p>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </div>
</div>

@endsection