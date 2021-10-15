<template>
    <div class="container-fluid mt--6">

        <div class="row">
            <div class="col">

                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-7">
                                <h3 class="mb-0">Invoice List</h3>

                            </div>

                            <div class="col-3">
                                <search-filter-component @searchFilter="s_f_query=$event, fetchData()"></search-filter-component>
                            </div>

                            <!--                            Calling the filter Component-->

                            <div class="col-2 text-right">
                                <filter-component :columns="columns" :route="'/invoices_api'" @applyFilter="rows=$event, fetchData()"></filter-component>
                            </div>
                        </div>

                        <!--                        Calling The Confirmation Modal Component-->

                        <confirmation-modal>
                            <template slot="title">
                                Are you sure you want to delete this invoice?!
                            </template>
                            <template slot="actionButton">
                                <button @click="deleteInvoice(id, index)" class="btn btn-danger" data-dismiss="modal"
                                        type="button">Delete
                                </button>
                            </template>
                        </confirmation-modal>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-flush table-sm ">
                            <div v-if="loading" class="loader"></div>
                            <thead class="thead-light">
                            <tr>
                                <th class="sort" data-sort="" scope="col"><h5>Invoice No #</h5></th>
                                <th class="sort" data-sort="" scope="col"><h5>Issued By</h5></th>
                                <th class="sort" data-sort="" scope="col"><h5>Client</h5></th>
                                <th class="sort" data-sort="" scope="col"><h5>Bill Amount</h5></th>
                                <th class="sort" data-sort="" scope="col"><h5>Status</h5></th>
                                <th class="sort" data-sort="" scope="col"><h5>Date</h5></th>
                                <th class="sort" data-sort="" scope="col"><h5>Actions</h5></th>
                            </tr>
                            </thead>
                            <tbody :class="loading?'blur list':'list'"  v-if="invoices">
                            <tr v-for="(invoice, index) in invoices.data">
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm"><a
                                                :href="`/invoices/${invoice.invoice_number}`">{{invoice.invoice_number}}</a></span>
                                        </div>
                                    </div>
                                </th>
                                <td style="word-wrap: break-word;white-space:normal;max-width: 160px;">
                                    {{invoice.company?invoice.company.company_name:"--"}}
                                </td>
                                <td style="word-wrap: break-word;white-space:normal;max-width: 160px;">
                                    {{invoice.client?invoice.client.client_name:"--"}}
                                </td>
                                <td>
                                    {{'BDT '+(invoice.net_amount-invoice.discount-invoice.advance_paid).toFixed(2)}}
                                </td>
                                <td>
                                    <span class="badge-pill badge-success">Paid</span>
                                </td>
                                <td>
                                    {{invoice.date}}
                                </td>
                                <td class="text-center">
                                    <a :href="`/invoices/${invoice.invoice_number}`"
                                       class="badge badge-circle badge-floating badge-success ml-0 mr-2"
                                       data-placement="top"
                                       data-toggle="tooltip" title="Make Payments">
                                        <i class="far fa-money-bill-alt"></i>
                                    </a>
                                    <a @click="printInvoice(invoice.invoice_number)"
                                       class="badge badge-circle badge-floating badge-info mr-2" data-placement="top"
                                       data-toggle="tooltip"
                                       href="#" title="Print">
                                        <i class="fas fa-print"></i>
                                    </a>

                                    <div class="dropdown ">
                                        <a aria-expanded="false" aria-haspopup="true"
                                           class="btn btn-sm btn-icon-only text-light"
                                           data-toggle="dropdown" href="#" id="dropdownMenuButton"
                                           type="button">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div
                                            class="dropdown-menu p-2 dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                                            <div class="d-flex justify-content-center">
                                                <a :href="`/invoices/${invoice.invoice_number}`"
                                                   class="btn rounded-0 btn-sm btn-primary m-2" data-placement="top"
                                                   data-toggle="tooltip" title="Show">
                                                    <i class="far fa-eye"></i>
                                                    <span>Show</span>
                                                </a>
                                                <a class="btn rounded-0 btn-sm btn-info m-2"
                                                   data-placement="top" data-toggle="tooltip" href="#" title="Edit">
                                                    <i class="far fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>

                                            </div>
                                            <div class="d-flex text-center justify-content-center">
                                                <a @click.prevent="downloadInvoice(invoice.invoice_number)"
                                                   class="btn rounded-0 btn-sm btn-success m-2" data-placement="top"
                                                   data-toggle="tooltip" href="#" title="Download">
                                                    <i class="fas fa-download"></i>
                                                    <span>Download</span>
                                                </a>

                                                <a @click="deleteConfirmation(invoice.id, index)"
                                                   class="btn rounded-0 btn-sm btn-danger m-2"
                                                   data-placement="top" data-toggle="tooltip"
                                                   href="#" title="Delete" type="button">
                                                    <i class="far fa-trash-alt"></i>
                                                    <span>Delete</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <pagination :limit="2" :data="invoices" @pagination-change-page="fetchData($event)"></pagination>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ConfirmationModal from "./ConfirmationModal";
    import FilterComponent from "./FilterComponent";
    import qs from 'qs';
    import SearchFilterComponent from "./SearchFilterComponent";

    export default {
        name: "InvoiceManageComponent",
        components: {SearchFilterComponent, FilterComponent, ConfirmationModal},
        data() {
            return {
                invoices: {},
                index: null,
                id: null,
                columns: {},
                rows:[],
                loading: false,
                s_f_query:"",

            }
        },
        created() {

            this.fetchData();
        },
        methods: {
            fetchData(page) {
                this.loading = true;
                // console.log(qs.stringify(advance_query));
                console.log(this.rows??"null");
                if(!page){
                    page=1
                }
                console.log(page);
                try {
                    this.axios.get("/invoices_api?page=" + page +"&s_f_query=" + this.s_f_query , {
                            params:{
                                inputs:this.rows??""
                            },
                            paramsSerializer: (params) => {
                                return qs.stringify(params)
                            },
                        })
                        .then((response) => {
                        this.invoices = response.data.invoices;
                        this.columns = response.data.columns;
                        setTimeout(()=>
                            this.loading = false, 500
                        )


                    })
                } catch (e) {
                    console.log(e.data);
                    this.loading = false;
                }
            },
            printInvoice(id) {
                window.open(window.location.origin + '/invoices/' + id + '/print', "_blank");
            },
            downloadInvoice(id) {
                window.location.href = window.location.origin + '/invoices/' + id + '/download';
            },
            deleteInvoice(id, index) {
                try {
                    this.axios.delete("/invoices/" + id).then((response) => {
                        console.log(response.data);
                        this.invoices.splice(index, 1);
                        this.index = null;
                        this.id = null;
                    })
                } catch (e) {
                    console.log(e.data);
                    this.index = null;
                    this.id = null;
                }
            },
            deleteConfirmation(id, index) {
                this.id = id;
                this.index = index;
                $('#modal-notification').modal('show');
            }
        }
    }
</script>

<style scoped>
    .blur{
        filter: blur(4px);
    }
    .loader {
        color: #565656;
        font-size: 6px;
        margin: 3px auto;
        text-align: right;
        width: 1em;
        height: 1em;
        border-radius: 50%;
        position: absolute;
        top:50%;
        left: 50%;
        text-indent: -9999em;
        -webkit-animation: load4 0.9s infinite linear;
        animation: load4 0.9s infinite linear;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    @-webkit-keyframes load4 {
        0%,
        100% {
            box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
        }
        12.5% {
            box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        25% {
            box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        37.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        50% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        62.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
        }
        75% {
            box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
        }
        87.5% {
            box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
        }
    }

    @keyframes load4 {
        0%,
        100% {
            box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
        }
        12.5% {
            box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        25% {
            box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
        }
        37.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        50% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
        }
        62.5% {
            box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
        }
        75% {
            box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
        }
        87.5% {
            box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
        }
    }

</style>
