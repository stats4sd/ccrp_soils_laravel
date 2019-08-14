<script>

    function deploy(projectId, formId) {

        jQuery.ajax('{{ url('en/kobo/publish') }}', {
            method: "POST",
            data: {
                projectId: projectId,
                formId: formId,
            }
        }).done(function(res) {
            console.log(res);
        });

    }

</script>