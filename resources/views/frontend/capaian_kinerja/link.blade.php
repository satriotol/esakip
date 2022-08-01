{{-- <div class="country-lists" style="margin-top: 10px"> --}}
{{-- <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($links as $link)
                            <tr>
                                <td>
                                    {{ $link->title }}
                                </td>
                                <td>
                                    <a href="{{ $link->url }}" target="_blank">
                                        {{ $link->url }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
{{-- <div class="row">
        <div class="blog-items">
            <!-- Single Item -->
            <div class="single-item col-md-3">
                <div class="item">
                    <div class="thumb">
                        <a href="#">
                            <img src="assets/img/800x800.png" alt="Thumb">
                            <div class="title">
                                <h4>The number of COVID-19 coronavirus infections worldwide</h4>
                                <div class="tags">
                                    <h5>China</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="info">
                        <div class="meta">
                            <ul>
                                <li><i class="fas fa-clock"></i> 14 Apr, 2020</li>
                            </ul>
                        </div>
                        <p>
                            Recommend exquisite household eagerness preserved now. My improved honoured he
                            am ecstatic quitting greatest formerly.
                        </p>
                        <a class="more-btn" href="#">
                            <i class="fas fa-plus"></i> Read More
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Single Item -->
            <!-- Single Item -->
            <div class="single-item col-md-3">
                <div class="item">
                    <div class="thumb">
                        <a href="#">
                            <img src="assets/img/800x800.png" alt="Thumb">
                            <div class="title">
                                <h4>Deaths from COVID-19 in Italy have exceeded those reported</h4>
                                <div class="tags">
                                    <h5>France</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="info">
                        <div class="meta">
                            <ul>
                                <li><i class="fas fa-clock"></i> 27 Jun, 2020</li>
                            </ul>
                        </div>
                        <p>
                            Recommend exquisite household eagerness preserved now. My improved honoured he
                            am ecstatic quitting greatest formerly.
                        </p>
                        <a class="more-btn" href="#">
                            <i class="fas fa-plus"></i> Read More
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Single Item -->
            <!-- Single Item -->
            <div class="single-item col-md-3">
                <div class="item">
                    <div class="thumb">
                        <a href="#">
                            <img src="assets/img/800x800.png" alt="Thumb">
                            <div class="title">
                                <h4>The number of confirmed coronavirus cases has doubled in less than two
                                    weeks</h4>
                                <div class="tags">
                                    <h5>Italy</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="info">
                        <div class="meta">
                            <ul>
                                <li><i class="fas fa-clock"></i> 15 May, 2020</li>
                            </ul>
                        </div>
                        <p>
                            Recommend exquisite household eagerness preserved now. My improved honoured he
                            am ecstatic quitting greatest formerly.
                        </p>
                        <a class="more-btn" href="#">
                            <i class="fas fa-plus"></i> Read More
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Single Item -->
        </div>
    </div>
</div> --}}
<div id="blog" class="blog-area bg-gray default-padding bottom-less">
    <div class="container">
        <div class="row">
            <div class="blog-items">
                @foreach ($links as $link)
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
