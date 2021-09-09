<template>
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Invoice List</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
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
                            <tbody class="list" v-if="invoices">
                            <tr v-for="(invoice, index) in invoices">
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
                                       class="badge badge-circle badge-floating badge-success ml-0 mr-2" data-placement="top"
                                       data-toggle="tooltip" title="Make Payments">
                                        <i class="far fa-money-bill-alt"></i>
                                    </a>
                                    <a @click="printInvoice(invoice.invoice_number)"
                                       class="badge badge-circle badge-floating badge-info mr-2" data-placement="top" data-toggle="tooltip"
                                       href="#" title="Print">
                                        <i class="fas fa-print"></i>
                                    </a>

                                    <div class="dropdown ">
                                        <a aria-expanded="false" aria-haspopup="true" class="btn btn-sm btn-icon-only text-light"
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
                                                <a @click.prevent="deleteInvoice(invoice.id, index)"
                                                   class="btn rounded-0 btn-sm btn-danger m-2 " data-placement="top"
                                                   data-toggle="tooltip" href="#" title="Delete">
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
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">
                                        <i class="fas fa-angle-left"></i>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">
                                        <i class="fas fa-angle-right"></i>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InvoiceManageComponent",
        data() {
            return {
                invoices: {},
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                try {
                    this.axios.get("/invoices_api").then((response) => {
                        this.invoices = response.data;
                    })
                } catch (e) {
                    console.log(e.data);
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
                    })
                } catch (e) {
                    console.log(e.data);
                }
            }
        }
    }
</script>

<style scoped>

</style>
