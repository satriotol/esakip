<div class="country-lists" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
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
                </table>
            </div>
        </div>
    </div>
</div>
