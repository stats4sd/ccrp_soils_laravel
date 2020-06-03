<template>
<div class="container mt-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Form Name</th>
                <th>No. Submissions</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr
            v-for="(form, index) in projectForms"
            :key="form.id">
                <td>{{ form.title }}</td>
                <td>{{ form.records }}</td>
                <td>
                    <p v-if="!form.kobo_id">undeployed</p>
                    <p v-if="form.kobo_id && form.is_active">
                        Deployed -
                        <a target="_blank" :href="'https://kf.kobotoolbox.org/#/forms/'+form.kobo_id+'/summary'">Show on Kobotoolbox</a>
                    </p>
                    <p v-if="form.kobo_id && !form.is_active">
                        Uploaded -
                        <a target="_blank" :href="'https://kf.kobotoolbox.org/#/forms/'+form.kobo_id+'/summary'">Show on Kobotoolbox</a>
                    </p>
                    <p v-if="form.kobo_id && form.kobo_version_id && !form.is_active">
                        Archived -
                        <a target="_blank" :href="'https://kf.kobotoolbox.org/#/forms/'+form.kobo_id+'/summary'">Show on Kobotoolbox</a>
                    </p>
                </td>
                <td class="d-flex justify-content-start">
                    <button
                    class="btn btn-sm mr-3"
                    :class="form.kobo_id ? 'btn-info' : 'btn-success'"
                    @click="deployForm(index)"
                    :disabled="form.processing==1"
                    >
                        <span v-if="!form.kobo_id">Deploy Form</span>
                        <span v-if="form.kobo_id && form.is_active">Update to Latest Form</span>
                        <span v-if="form.kobo_id && !form.is_active">Re-deploy Form</span>
                    </button>
                    <button
                    v-if="form.kobo_id && form.is_active"
                    class="btn btn-warning btn-sm"
                    @click="archiveForm(index)"
                    :disabled="form.processing==1"
                    >
                        Archive Form
                    </button>
                    <div v-if="form.processing==1">
                        <span class="spinner-border spinner-border-sm text-muted"></span>
                    </div>

                </td>
            </tr>
        </tbody>
    </table>
    <button
    @click="getData()"
    class="btn btn-success"
    :disabled="anyProcessing==true"
    >Get data from KoboToolBox</button>
</div>
</template>

<script>

    const rootUrl = process.env.MIX_APP_URL
    export default {
        props: ['project','userId'],
        data() {
            return {
                projectForms: [],
            }
        },

        computed: {
            anyProcessing: function() {
                return this.projectForms.some(x => x.processing == true);
            }
        },

        mounted() {

            axios.get(rootUrl+'/projects/'+this.project.slug+'/projectxlsforms')
            .then((response) => {
                this.projectForms = response.data
            })

            // Listen for the 'NewBlogPost' event in the 'team.1' private channel
            this.$echo.private('App.User.'+this.userId)
            .listen('KoboDeploymentReturnedSuccess', (payload) => {

                console.log("BOOM!");

                this.projectForms = this.projectForms.map( projectForm => {
                    if(projectForm.id === payload.form.id) {
                        return payload.form;
                    }
                    return projectForm
                })
            })

            .listen('KoboGetDataReturnedSuccess', (payload) => {

                console.log("BOOM!", payload);



                axios.post(rootUrl+'/projectxlsforms/'+payload.form.id+'/getdata')
                .then((response) => {
                    const index = this.projectForms.findIndex(x => x.id === payload.form.id);
                    this.projectForms[index]['records'] = response.data.length;
                    this.projectForms[index]['processing'] = false;
                })
            });
        },

        methods: {
            deployForm(index) {
                this.projectForms[index].processing = true;

                axios.post(rootUrl+'/projectxlsforms/'+this.projectForms[index]['id']+'/deploytokobo/')
                .then((response) => {
                    console.log(response);
                })
            },

            getData() {

                this.projectForms.forEach((projectForm, index) => {

                    if(projectForm.kobo_id) {

                        this.projectForms[index]['processing'] = true;

                        axios.post(rootUrl+'/projectxlsforms/'+projectForm.id+'/syncdata')

                    }

                });
            }
        }
    }
</script>
