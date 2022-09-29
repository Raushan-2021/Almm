@php $documents = json_decode($installation->documents, true); @endphp
@php $docBaseUrl = Auth::getDefaultDriver().'/preview-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('installation').'/'; @endphp
@php $docDownloadUrl = Auth::getDefaultDriver().'/download-docs/'.base64_encode($installation->consumerId).'/'.base64_encode('installation').'/'; @endphp

<div class="row">
    <div class="col-md-12 mb-15"><em class="error fs12">*Kindly upload documents in PDF searchable format including scanned documents and Images either in PNG or JPG format</em></div>
</div>
<div class="row">
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="agreement_copy">1. Agreement Copy <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['agreement_copy'])) required @endif" name="pictures[agreement_copy]">
            @if (!empty($documents['agreement_copy']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['agreement_copy']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['agreement_copy']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="installer_pic">2. Picture of the Installer <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['installer_pic'])) required @endif" name="pictures[installer_pic]">
            @if (!empty($documents['installer_pic']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['installer_pic']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['installer_pic']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="owner_pic">3. Picture of the Owner <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['owner_pic'])) required @endif" name="pictures[owner_pic]">
            @if (!empty($documents['owner_pic']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['owner_pic']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['owner_pic']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="site_before_installation_pic">4. Picture of the site before installation - with layout marking (Geo Tag Photo only) <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['site_before_installation_pic'])) required @endif" name="pictures[site_before_installation_pic]">
            @if (!empty($documents['site_before_installation_pic']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['site_before_installation_pic']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['site_before_installation_pic']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="under_const_bio_plant">5. Picture of Under Construction of the biogas plant (Half digester construction stage) <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['under_const_bio_plant'])) required @endif" name="pictures[under_const_bio_plant]">
            @if (!empty($documents['under_const_bio_plant']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['under_const_bio_plant']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['under_const_bio_plant']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="bio_plant_with_beneficiary">6. Picture of biogas plant with beneficiary (After pipeline fitting, registration number should be marked on inlet portion) <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['bio_plant_with_beneficiary'])) required @endif" name="pictures[bio_plant_with_beneficiary]">
            @if (!empty($documents['bio_plant_with_beneficiary']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['bio_plant_with_beneficiary']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['bio_plant_with_beneficiary']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="stove_pic">7. Picture of the Stove <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['stove_pic'])) required @endif" name="pictures[stove_pic]">
            @if (!empty($documents['stove_pic']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['stove_pic']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['stove_pic']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv">
        <div class="form-group">
            <label for="h_s_training_statement_pic">8. Health & Safety training statement <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['h_s_training_statement_pic'])) required @endif" name="pictures[h_s_training_statement_pic]">
            @if (!empty($documents['h_s_training_statement_pic']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['h_s_training_statement_pic']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['h_s_training_statement_pic']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 fileDiv {{($installation->toilet_status ?? '') == '1' ? '' : 'hidden'}}" id="toiletLinkedPhoto">
        <div class="form-group">
            <label for="linked_toilet_photo">9. Photo of Linked Toilet <span class="error">*</span></label>
            <input type="file" {{$editable ?? ''}} class="form-control @if(empty($documents['linked_toilet_photo'])) required @endif" name="pictures[linked_toilet_photo]">
            @if (!empty($documents['linked_toilet_photo']))
                <a class="" href="{{URL::to($docBaseUrl.$documents['linked_toilet_photo']['name'])}}" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i>  View</a>
                <a class="ml-5 download-link" href="{{URL::to($docDownloadUrl.$documents['linked_toilet_photo']['name'])}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>  Download</a>
            @endif
        </div>
    </div>
</div>