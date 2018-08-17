@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{__('Dashboard')}}</div>

                    <div class="card-body">
                        @if (count($errors) > 0)

                            <div class="row">
                                <div class="col-md-12">
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach

                                </div>

                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <form  enctype="multipart/form-data" id="add-tablet" action="{{route('admin.add.store')}}" method="post">


                            <div class="respond" >

                            </div>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">{{__('Tablet Name')}}</label>
                                        <input type="text" id="firstName" class="form-control" name="title"
                                               placeholder="" required value=""></div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="">
                                        <label class="control-label">{{__('Alias:')}}
                                        </label>

                                    </div>
                                    <input required name="alias" type="text" id="alias" class="form-control" placeholder=""
                                           value=""></div>


                                <!--/span-->
                            </div>

                            <div class="form-group">
                                <label id="tablet-description" class="box-title ">{{__('Tablet Description')}}</label>
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="form-group">
                                            <textarea required  id="tablet-description"
                                                      name="description"
                                                      class="desc form-control"
                                                      rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 col-lg-4">

                                    <div class="form-group">

                                        <label class="control-label">{{__('Select category')}}</label>

                                        <select required name="category_id" class="form-control"
                                                data-placeholder="Choose a Category" tabindex="1">
                                            <option value="">{{__('Select category')}}</option>
                                            {!! $category_list ?? '' !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label">{{__('Select manufacture')}}</label>
                                        <select required name="manufacture_id" class="form-control"
                                                data-placeholder="Choose a Category" tabindex="1">

                                            <option value="">{{__('Select manufacture')}}</option>
                                            @if($manufactures )
                                                @foreach($manufactures as $manufacture)
                                                    <option value="{{$manufacture->id}}">{{$manufacture->title}}</option>
                                                @endforeach

                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 ol-md-12 col-xs-12">
                                    <div class="white-box">
                                        <label for="input-file-now">{{__('Upload Image')}}</label>
                                        <input name="file" type="file" id="input-file-now" class="dropify"/></div>
                                </div>

                                <!--/span-->

                                <!--/span-->
                            </div>
                            <div class="clearfix"></div>
                            <br>
                            <button type="submit" class="btn  btn-success btn-lg"><i class="fa fa-check"></i>


                                {{__('Save')}}

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
