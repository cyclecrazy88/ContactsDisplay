<script type="text/javascript">
    const data = <?php echo json_encode($resultData) ?>;
</script>
<div class="card_container">

@foreach ($resultData as $data)
<div class="card_item showItem" country="{{$data->country}}">
    <div class="headingSection">
        <img class="thumbnail" src="{{$data->thumbnail}}"/>
        <div class="key">{{$data->key}}</div>
        <div class="name">{{$data->name}}</div>
    </div>
    <div class="contactAction">
        <div class="email">{{$data->email}}</div>
        <div class="phone">{{$data->phone}}</div>
        <div class="mobile">{{$data->mobile}}</div>
    </div>
    <div class="contactAddress">
        <div class="postcode">{{$data->postcode}}</div>
        <div class="city">{{$data->city}}</div>
        <div class="state">{{$data->state}}</div>
        <div class="country">{{$data->country}}</div>
    </div>

    <div class="userComment">
        <?php $commentItem = ""; ?>
        @foreach ($commentsData as $comment)
            @if ($data->key == $comment->key)
                <?php $commentItem = $comment->comment; ?>
            @endif
        @endforeach
        <textarea keyCode="{{$data->key}}" class="userComment">{{$commentItem}}</textarea>
    </div>
</div>
@endforeach

</div>
