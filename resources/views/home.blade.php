@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" id="timeline">
        <div class="col-md-4">
          <form class="" action="#" method="post">

          <div class="form-group">
            <textarea class="form-control" rows="8" maxlength="140" placeholder="what are you up to" required></textarea>
          </div>
          <input type="submit" name="name" class="form-control" value="Post">

        </form>
                Post Status
        </div>
        <div class="col-md-8">
                Timeline
        </div>
    </div>
</div>
@endsection
