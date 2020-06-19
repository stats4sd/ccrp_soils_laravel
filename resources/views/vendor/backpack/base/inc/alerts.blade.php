{{-- Bootstrap Notifications using Prologue Alerts & PNotify JS --}}
<script type="text/javascript">
    Noty.overrideDefaults({
        layout   : 'topRight',
        theme    : 'backstrap',
        timeout  : 2500,
        closeWith: ['click', 'button'],
    });

    @foreach (\Alert::getMessages() as $type => $messages)

        @foreach ($messages as $message)

            new Noty({
                type: "{{ $type }}",
                text: "{!! str_replace('"', "'", $message) !!}"
            }).show();

        @endforeach
    @endforeach

    // Setup Echo
    @if(auth()->check())
        Echo.private("App.User.{{ auth()->user()->id }}")

            // DEPLOYMENT MESSAGES
            .listen('KoboDeploymentReturnedSuccess', (e) => {
                new Noty({
                    type: "success",
                    text: "<b>{{ t('Form') }}: " + e.form.title + "</b><br/><br/>{{ t('The form has been successfully uploaded and deployed to Kobotools.') }}",
                    timeout: false
                }).show();

                console.log(e);

                $('#kobo_url')
                .html('<a target="_blank" href="{{ config('services.kobo.endpoint') }}/#/forms/'+e.form.kobo_id+'/" class="btn btn-link text-white font-weight-bold text-center">Yes - View on Kobo</a>');

                $('#kobo_url').parent().class('w-50 m-0 p-3 bg-success');

                $('#enketo_url')
                .html('<a target="_blank" href="'+e.form.enketo_url+'/" class="btn btn-link text-white font-weight-bold text-center">Yes - View on Kobo</a>')

                $('#enketo_url').parent().class('w-50 m-0 p-3 bg-success');
            })
            .listen('KoboDeploymentReturnedError', (e) => {
                new Noty({
                    type: "error",

                    timeout: false
                }).show();

                console.log(e);

                $('#kobo_url')
                .html('No')
                $('#kobo_url').parent().class('w-50 m-0 p-3 bg-secondary');

                $('#enketo_url')
                .html('No')
                $('#enketo_url').parent().class('w-50 m-0 p-3 bg-secondary');
            })

            // UPLOAD MESSAGES
            .listen('KoboUploadReturnedSuccess', (e) => {
                new Noty({
                    type: "info",
                    text: "<b>{{ t('Form') }}: " + e.form.title + "</b><br/><br/>{{ t('The form has been successfully uploaded to Kobotools. It will now be deployed and shared with the users of the project') }}",
                    timeout: false
                }).show();

                console.log(e);
            })

            .listen('KoboUploadReturnedError', (e) => {
                new Noty({
                    type: "error",
                    text: "<b>{{ t('Form') }}: "+e.form.title+"</b><br/><br/> {{ t('The form could not be deployed to Kobotools. An error was returned') }}<hr/>{{ t('Error Type') }}: <b>"+e.errorType+"</b><hr/>{{ t('Error Message') }}: <b>"+e.errorMessage+"</b><br/><br/>{{ t('This error may indicate errors in the XLSX form.') }}",
                    timeout: false
                }).show();


                console.log(e);
            })

            // ARCHIVE MESSAGES
            .listen('KoboArchiveRequestReturnedSuccess', (e) => {
                new Noty({
                    type: "success",
                    text: "<b>{{ t('Form') }}: " + e.form.title + "</b><br/><br/>{{ t('The form has been successfully archived on Kobotools, and is no longer available for data collection') }}",
                    timeout: false
                }).show();

                console.log(e);

                $('#enketo_url')
                .html('No')
                $('#enketo_url').parent().class('w-50 m-0 p-3 bg-secondary');
            })

            .listen('KoboArchiveRequestReturnedError', (e) => {
                new Noty({
                    type: "error",
                    text: "<b>{{ t('Form') }}: "+e.form.title+"</b><br/><br/> {{ t('The form could not be archived. An error was returned') }}<hr/>{{ t('Error Type') }}: <b>"+e.errorType+"</b><hr/>{{ t('Error Message') }}: <b>"+e.errorMessage+"</b>",
                    timeout: false
                }).show();

                console.log(e);
            })
    @endif

</script>