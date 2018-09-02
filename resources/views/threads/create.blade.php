@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Thread</div>

                    <div class="panel-body">
                        @include('common.error')
                        <form method="post" action="{{route('threads.store')}}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" value="{{old('title')}}" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="channel_id">Choose a Channel</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">请选择分类</option>
                                    @foreach(App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea name="body" id="body" class="form-control" rows="8">{{old('body')}}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Publish</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection