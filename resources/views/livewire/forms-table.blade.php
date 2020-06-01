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
            @foreach($project->xls_forms as $form)
            <tr>
                <td>{{ $form->title }}</td>
                <!-- <td>{{ $form->pivot->form_kobo_id_string }}</td> -->
                <td>{{ $form->pivot->records }}</td>
                <td>
                    @if($form->pivot->deployed)
                    <p>Deployed (<a href="https://kf.kobotoolbox.org/#/forms/{{ $form->pivot->form_kobo_id_string }}/summary">Show on Kobotoolbox</a>)</p>
                    @else
                    <p>{{ t("undeployed") }}</p>
                    @endif
                </td>
                <td>
                    <div class="w3-show-inline-block">
                        <div class="w3-bar">
                            <button class="btn btn-dark btn-sm text-white" wire:click="deployForm({{ $form->id }})">
                                Deploy Form
                            </button>

                        </div>
                    </div>
                </td>
                @if($showNotify)
                <h1>WOW - IT WORKS</h1>
                @endif
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@push('scripts')

<script>
Echo.private('App.User.{{ auth()->user()->id }}')
    .listen('NewFormDeployedToKobo', (e) => {
        console.log("Yo " + e.user.name);
    })

</script>
@endpush