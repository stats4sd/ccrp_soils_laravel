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
            @foreach($projectforms as $form)
            <tr>
                <td>{{ $form->xlsform->title }}</td>
                <!-- <td>{{ $form->form_kobo_id_string }}</td> -->
                <td>{{ $form->records }}</td>
                <td>
                    @if($form->deployed)
                    <p>Deployed (<a href="https://kf.kobotoolbox.org/#/forms/{{ $form->form_kobo_id_string }}/summary">Show on Kobotoolbox</a>)</p>
                    @else
                    <p>{{ t("undeployed") }}</p>
                    @endif
                </td>
                <td>
                    <div class="w3-show-inline-block">
                        <div class="w3-bar">
                            <button
                            class="btn btn-dark btn-sm text-white" wire:click="deployForm({{ $form }})"
                            {{ $form->processing ? 'disabled' : '' }}>
                                Deploy Form
                            </button>

                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('scripts')

<script>
Echo.private('App.User.{{ auth()->user()->id }}')
    .listen('KoboDeployementReturnedSuccess', (e) => {
        console.log("Yo " + e.user.name);
    })

</script>
@endpush