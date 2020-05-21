<div class="container mt-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ t("Form Name") }}</th>
                <!-- <th>{{ t("Kobotools Form ID") }}</th> -->
                <th>{{ t("Records") }}</th>
                <th>{{ t("Status") }}</th>
                <th>{{ t("Action") }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $project->xls_forms as $xls_form)
            <tr>
                <td>{{ $xls_form->form_title }}</td>
                <!-- <td>{{ $xls_form->pivot->form_kobo_id_string }}</td> -->
                <td>{{ $xls_form->pivot->records }}</td>
                <td>
                    @if($xls_form->pivot->deployed)
                    <p>Deployed (<a href="https://kf.kobotoolbox.org/#/forms/{{ $xls_form->pivot->form_kobo_id_string }}/summary">Show on Kobotoolbox</a>)</p>
                    @else
                    <p>{{ t("undeployed") }}</p>
                    @endif
                </td>
                <td>
                    <div class="w3-show-inline-block">
                        <div class="w3-bar">
                            <a href="{{ route('kobo.publish', [
                                                    'project' => $project,
                                                    'form' => $xls_form ]
                                                    )}}" class="btn btn-dark btn-sm" id="deploy-form-button{{$xls_form->id}}" onclick="deploy(event)">
                                {{ t("DEPLOY") }}
                            </a>

                        </div>
                    </div>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <a class="btn btn-dark btn-sm text-light" href="{{ url(APP()->getLocale().'/projects/' . $project->slug . '/download-samples-merged') }}" onclick="getDownload(event)" data-toggle="popover">{{ t("DOWNLOAD DATA") }}</a>
    <div hidden class="alert alert-danger alert-block" id="error"></div>
</div>