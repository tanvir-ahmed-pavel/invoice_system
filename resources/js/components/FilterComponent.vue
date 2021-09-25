<template>
        <div class="dropdown">
            <button class="btn btn-sm btn-secondary dropdown-toggle pl-2 pr-2 pt-1 pb-1" type="button"
                    id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="tim-icons icon-vector"></i>
                <span v-if="active" class="badge badge-primary ml-0">{{active}}</span>
                <span>Filter</span>

            </button>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="min-width: 500px;">
                <div class="dropdown-item m-0 disabled">
                    <form action="" method="GET">
                        <div class="card mb-0">
                            <div class="row card-header justify-content-between border-bottom">
                                <div class="col-md">
                                    <button class="btn btn-sm btn-primary" @click="addRow()" name="add" type="button">
                                        <i class="tim-icons icon-simple-add"></i>
                                        Add Filter
                                    </button>
                                </div>
                                <div class="col-md">
                                    <button type="button" @click="clearFilter()" class="btn btn-sm btn-danger ">
                                        <i class="tim-icons icon-simple-remove"></i>
                                        Clear Filter
                                    </button>
                                </div>
                                <div class="col-md">
                                    <button type="submit" @click.prevent="applyFilter()" class="btn btn-sm btn-success">
                                        <i class="tim-icons icon-check-2"></i>
                                        Apply Filter
                                    </button>
                                </div>
                            </div>
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

                                            <option v-for="column in Columns" :value="column">
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
                                        <input type="text" v-model="row.value" :name="'inputs['+  index + '][value]'"
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
    export default {
        name: "FilterComponent",
        props: ['Columns'],
        data() {
            return {
                rows: [
                    {}
                ],
                active:0,
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
                this.active++;
            },

            removeRow(index) {
                this.rows.splice(index, 1);
                this.active--;
                // if (this.rows.length=1);
            },

            clearFilter(){
                this.rows.splice(1);
                this.active=0;
            },

            applyFilter(){
                this.axios.get(this.Route, this.rows);
            }
        }
    }
</script>

<style scoped>

</style>
