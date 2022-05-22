<nav class="contactHeading">
    <span class="headingText">Stored Contacts Example</span>
    <div class="country">
    <select>
        <option value="">Select...</option>
        @foreach($countrySummary as $country)
        <option
            count="{{$country->count}}"
            country="{{$country->country}}">{{$country->country}} - ({{$country->count}})</option>
        @endforeach
    </select>
    </div>




</nav>
