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
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort=""><h5>Invoice No #</h5></th>
                                <th scope="col" class="sort" data-sort=""><h5>Issued By</h5></th>
                                <th scope="col" class="sort" data-sort=""><h5>Client</h5></th>
                                <th scope="col" class="sort" data-sort=""><h5>Payable Amount</h5></th>
                                <th scope="col" class="sort" data-sort=""><h5>Date</h5></th>
                                <th scope="col" class="sort" data-sort=""><h5>Actions</h5></th>
                            </tr>
                            </thead>
                            <tbody class="list" v-if="invoices">
                            <tr v-for="(invoice, index) in invoices">
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <span class="name mb-0 text-sm"><a :href="`/invoices/${invoice.invoice_number}`">{{invoice.invoice_number}}</a></span>
                                        </div>
                                    </div>
                                </th>
                                <td class="">
                                    {{invoice.company.company_name}}
                                </td>
                                <td>
                                    {{invoice.client.client_name}}
                                </td>
                                <td>
                                    {{'BDT '+(invoice.net_amount-invoice.discount-invoice.advance_paid).toFixed(2)}}
                                </td>
                                <td>
                                    {{invoice.date}}
                                </td>
                                <td class="text-center">
                                    <a class="badge badge-circle badge-floating badge-primary ml-0 mr-2" :href="`/invoices/${invoice.invoice_number}`" data-toggle="tooltip" data-placement="top" title="Show">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a class="badge badge-circle badge-floating badge-warning mr-2" @click="printInvoice(invoice.invoice_number)" href="#" data-toggle="tooltip" data-placement="top" title="Print">
                                        <i class="fas fa-print"></i>
                                    </a>
                                    <a class="badge badge-circle badge-floating badge-success m-2" @click="downloadInvoice(invoice.invoice_number)" href="#" data-toggle="tooltip" data-placement="top" title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
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
        data(){
          return {
              invoices:{},
          }
        },
        created() {
            this.fetchData();
        },
        methods:{
            fetchData(){
                try {
                    this.axios.get("/invoices_api").then((response) => {
                        this.invoices = response.data;
                    })
                } catch (e) {
                    console.log(e.data);
                }
            },
            printInvoice(id) {
                window.open(window.location.origin+'/invoices/' + id + '/print', "_blank");
            },
            downloadInvoice(id){
                window.location.href = window.location.origin+'/invoices/' + id + '/download';
            }
        }
    }
</script>

<style scoped>

</style>
