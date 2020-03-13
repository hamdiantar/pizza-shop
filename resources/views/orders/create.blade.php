@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">create new order</div>
                    <div class="card-body">
                    @include('messages.success')
                    @include('messages.error')
                        <form method="post" action="{{route('orders.store')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Select Pizza</label>
                                <select name="pizza" class="form-control @error('quantity') is-invalid @enderror" id="exampleFormControlSelect1">
                                    <option disabled selected value>---Select Pizza---</option>
                                    @foreach($pizzas as $pizza)
                                        <option value="{{ $pizza->id }}" {{ old('pizza') == $pizza->id  ? 'selected' : ''}}>{{$pizza->flavor}}</option>
                                    @endforeach
                                </select>
                                @error('pizza')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control  @error('quantity') is-invalid @enderror" id="quantity" name="quantity" min="1">
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Select Size</label>
                                    <select name="size" class="form-control @error('size') is-invalid @enderror" id="exampleFormControlSelect1">
                                        <option disabled selected value>--- Select Size ---</option>
                                        @foreach($sizes as $size=>$key)
                                            <option value="{{ $key ?? '' }}" {{ old('size') == $key ?? '' ? 'selected' : ''}}>{{$size}}</option>
                                        @endforeach
                                    </select>
                                    @error('size')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-4">
                                    <label for="exampleFormControlSelect1">Select Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror" id="exampleFormControlSelect1" >
                                        <option selected disabled value="">--Select status--</option>
                                        <option value="hold" {{old('status') == 'hold' ? 'selected' : ''}}>hold</option>
                                        <option value="delivered" {{old('status') == 'delivered' ? 'selected' : ''}}>delivered</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">customer name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                                @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">customer Address</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="address" value="{{ old('address') }}">
                                @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-lg btn-primary">create Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
