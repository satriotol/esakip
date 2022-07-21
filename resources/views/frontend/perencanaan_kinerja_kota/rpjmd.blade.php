<div class="country-lists" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-12">
            @if ($rpjmd != null)
                <object data="{{ asset('uploads/' . $rpjmd->file) }}" class="w-100 mt-5" style="height: 550px;width: 100%"
                    type="application/pdf">
                    <div>No online PDF viewer installed</div>
                    <p><a href="{{ asset('uploads/' . $rpjmd->file) }}" download="" target="_blank">Download File</a>
                    </p>
                </object>
            @endif
        </div>
    </div>
</div>
