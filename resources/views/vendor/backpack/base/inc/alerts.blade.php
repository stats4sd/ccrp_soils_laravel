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
            .listen('NewFormDeployedToKoboForAdmins', (e) => {
                new Noty({
                    type: "success",
                    text: "The " + e.xlsform.title + " Form has been successfully uploaded to Kobotools.",
                    timeout: 4000
                }).show();

                console.log(e);
            })
    @endif

</script>