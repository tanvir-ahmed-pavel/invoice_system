<template>
        <div class="dropdown">
            <button class="btn btn-sm btn-secondary dropdown-toggle pl-2 pr-2 pt-1 pb-1" type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <span v-if="filterCount" class="badge badge-primary ml-0">{{filterCount}}</span>
                <span>
                    <i class="fas fa-cogs"></i>
                    Advance Filter
                </span>

            </button>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="min-width: 500px;">
                <div class="dropdown-item m-0 disabled">
                    <form action="" method="GET">
                        <div class="card mb-0">
                            <div class="row card-header justify-content-between border-bottom">

<!--                                Add New Filter-->

                                <div class="col-md">
                                    <button class="btn btn-sm btn-primary" @click="addRow()" name="add" type="button">
                                        <i class="tim-icons icon-simple-add"></i>
                                        Add Filter
                                    </button>
                                </div>

<!--                                Reset Filter-->

                                <div class="col-md">
                                    <button type="button" @click="clearFilter()" class="btn btn-sm btn-danger ">
                                        <i class="tim-icons icon-simple-remove"></i>
                                        Clear Filter
                                    </button>
                                </div>

<!--                                Apply Filter-->

                                <div class="col-md">
                                    <button type="submit" @click.prevent="evnt_applyFilter()" class="btn btn-sm btn-success">
                                        <i class="tim-icons icon-check-2"></i>
                                        Apply Filter
                                    </button>
                                </div>
                            </div>

<!--                            Remove Filter-->

                            <div class="card-body">
                                <div v-if="index!=0" class="row justify-content-center" v-for="(row, index) in rows">

                                    <div class="col-md-1 p-0 pr-1">
                                        <button type="button" @click="removeRow(index)"
                                                class="btn pl-2 pr-2 btn-danger btn-sm">
                                            <i class="ni ni-fat-delete"></i>
                                        </button>
                                    </div>

                                    <!--                                        Column-->

                                    <div class="col-md-4 form-group p-0">
                                        <select v-model="row.column" :name="'inputs['+  index + '][column]'"
                                                class="custom-select custom-select-sm custom-select text-dark">
                                            <option value="" disabled hidden selected>Choose Fields...</option>

                                            <option v-for="column in columns" :value="column">
                                                {{column.replace(/_/g, ' ').toUpperCase()}}
                                            </option>
                                        </select>
                                    </div>

                                    <!--                                    Operator-->

                                    <div class="col-md-3 form-group p-0 pl-1 pr-1">
                                        <select v-model="row.operator" :name="'inputs['+  index + '][operator]'"
                                                class="custom-select custom-select-sm custom-select text-dark">
                                            <option value="" disabled selected hidden>Choose Operator...</option>
                                            <option value="=">Equals</option>
                                            <option value="!=">Not Equals</option>
                                            <option value="like">Like</option>
                                            <option value="not like">Not Like</option>
                                            <option value=">">Greater Than</option>
                                            <option value="<">Less Than</option>

                                        </select>
                                    </div>
                                    <div class="col-md-4 form-group p-0 pl-1">
                                        <input type="text" @input="evnt_applyFilter" v-model="row.value" :name="'inputs['+  index + '][value]'"
                                               class="form-control form-control-sm form-control border-1" placeholder="Enter Value">
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
</template>

<script>
    import qs from 'qs';
    export default {
        name: "FilterComponent",
        props: ['columns'],
        data() {
            return {
                rows: [
                    {}
                ],
                filterCount:0,
                status:true,
                interval:setInterval(() => {
                    this.status= true;
                }, 150)
            }
        },
        methods: {
            addRow() {

                this.rows.push(
                    {
                        column: '',
                        operator: '',
                        value: null,
                    }
                );
                this.filterCount++;
            },

            removeRow(index) {
                this.rows.splice(index, 1);
                this.filterCount--;
                this.evnt_applyFilter();
                // if (this.rows.length=1);
            },

            clearFilter(){
                this.rows.splice(1);
                this.filterCount=0;
                this.evnt_applyFilter();
            },

            evnt_applyFilter(){
                if(this.status){
                    this.$emit('applyFilter', this.rows);
                    this.status=false;
                }

            }
        }
    }
</script>

<style scoped>

</style>
