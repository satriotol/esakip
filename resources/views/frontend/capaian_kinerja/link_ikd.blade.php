<div id="blog" class="blog-area bg-gray default-padding bottom-less">
    <div class="container">
        <div class="row">
            <div class="blog-items">
                @foreach ($link_3 as $link)
                    <div class="single-item col-md-3">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{ $link->url }}" target="_blank">
                                    <img src="{{ asset('uploads/' . $link->image) }}" alt="Thumb">
                                    <div class="title">
                                        <div class="tags">
                                            <h5>{{ $link->title }}</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="info">
                                <p>
                                    {{ $link->description }}
                                </p>
                                <a class="more-btn" href="{{ $link->url }}" target="_blank">
                                    <i class="fas fa-link"></i> Kunjungi Link
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
