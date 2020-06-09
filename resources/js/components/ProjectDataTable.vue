<template>
<div>
    <div class="container mt-4">
        Number of soil samples in database: <b> {{ samples.length }}</b>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Sample Id</th>
                    <th>POXC Value</th>
                    <th>P Value</th>
                    <th>pH Value</th>
                    <th>POM Value</th>
                </tr>
                <tr v-for="sample in samples" :key="sample.id">
                    <td>{{ sample.id }}</td>
                    <td>{{ sample.poxc_result }}</td>
                    <td>{{ sample.p_result }}</td>
                    <td>{{ sample.ph_result }}</td>
                    <td>{{ sample.pom_result }}</td>
                </tr>
            </table>

        </div>
    </div>
</div>
</template>
<script>
export default {
    props: ['project','userId','samples'],

}
</script>