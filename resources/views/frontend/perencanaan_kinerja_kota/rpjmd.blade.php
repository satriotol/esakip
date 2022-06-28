<div class="country-lists" style="margin-top: 10px">
    <div class="row">
        <div class="col-md-12">
            @if ($rpjmd != null)
                <object data="{{ asset('uploads/' . $rpjmd->file) }}" class="w-100 mt-5"
                    style="height: 550px;width: 100%" type="application/pdf">
                    <div>No online PDF viewer installed</div>
                </object>
            @endif
        </div>
    </div>
</div>
