<template>
<div>
    <div class="container mt-4">
        {{ __("vue.samples-count") }}: <b> {{ samples.length }}</b>
    </div>
    <div class="row">
        <div class="col-md-11">
            <table class="table table-striped table-bordered w-100">
                <tr>
                    <th rowspan="2">{{ __("vue.Sample ID") }}</th>

                    <th
                        v-for="identifier in project.identifiers"
                        :key="identifier.name"
                        rowspan="2">
                        {{ identifier.label }}
                    </th>


                    <th rowspan="2">
                        {{ __("vue.POXC Value") }}
                        <br/>({{ __("vue.POXC Units")}})
                    </th>
                    <th rowspan="2">
                        {{ __("vue.p Value") }}
                        <br/>({{ __("vue.P Units")}})
                    </th>
                    <th rowspan="2">{{ __("vue.pH Value") }}</th>
                    <th rowspan="2" style="border-right: 1px solid darkgray">{{__("vue.POM Value") }}</th>
                    <th colspan="3" style="border-left: 1px solid darkgray">{{__("vue.Stable Aggregates") }}</th>
                </tr>
                <tr class="w-100">
                    <th class="font-weight-normal">2mm</th>
                    <th style="border-right: 1px solid lightgray" class="font-weight-normal">250μm</th>
                    <th style="border-left: 1px solid lightgray">{{ __("vue.Total") }}</th>
                </tr>

                <tr v-for="sample in samplesDisplay" :key="sample.id">
                    <td>{{ sample.id }}</td>

                    <div v-if="sample.identifiers">
                        <td
                            v-for="identifier in project.identifiers"
                            :key="identifier.name"
                            rowspan="2">
                            {{ sample.identifiers[identifier.name] }}
                        </td>
                    </div>

                    <td>{{ sample.poxc_result }} </td>
                    <td>{{ sample.p_result }} </td>
                    <td>{{ sample.ph_result }}</td>
                    <td style="border-right: 1px solid darkgray">{{ sample.pom_result }}</td>
                    <td style="border-left: 1px solid darkgray">{{ sample.twomm_aggreg_pct_result }} <span v-if="sample.twomm_aggreg_pct_result">%</span></td>
                    <td style="border-right: 1px solid lightgray">{{ sample.twofiftymicron_aggreg_pct_result }} <span v-if="sample.twofiftymicron_aggreg_pct_result">%</span></td></td>
                    <td style="border-left: 1px solid lightgray">{{ sample.total_stableaggregates }} <span v-if="sample.total_stableaggregates">%</span></td></td>
                </tr>
            </table>

        </div>
    </div>
</div>
</template>
<script>
export default {
    props: ['project','userId','samples'],

    data() {
        return {
            samplesDisplay: [],
        }
    },
    mounted: function(){

        console.log(this.project.identifiers)

        // round things for display
        this.samplesDisplay = this.samples.map((sample) => {
            console.log("sample:", sample);
            if(sample.poxc_result) {
                sample.poxc_result = sample.poxc_result.toFixed(2);
            }
            if(sample.p_result) {
                sample.p_result = sample.p_result.toFixed(2);
            }
            if(sample.ph_result) {
                sample.ph_result = sample.ph_result.toFixed(2);
            }
            if(sample.total_stableaggregates) {
                sample.total_stableaggregates = sample.total_stableaggregates.toFixed(1);
            }

            return sample;

        })
    }


}
</script>